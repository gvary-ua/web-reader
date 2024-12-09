<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Cover;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $myLiked = $this->getMyLikedCovers($request->user()->user_id);
        $myCovers = $this->getMyCovers($request->user()->user_id);

        $myLikedDto = $this->toDto($myLiked);
        $myCoversDto = $this->toDto($myCovers);

        return view('profile.index', [
            'user' => $request->user(),
            'my_covers' => $myCoversDto,
            'liked_covers' => $myLikedDto,
        ]);
    }

    public function show(User $user): View
    {
        $myLiked = $this->getMyLikedCovers($user->user_id);
        $myCovers = $this->getMyCovers($user->user_id);

        $myLikedDto = $this->toDto($myLiked);
        $myCoversDto = $this->toDto($myCovers);

        return view('profile.index', [
            'user' => $user,
            'my_covers' => $myCoversDto,
            'liked_covers' => $myLikedDto,
        ]);
    }

    public function editProfile(Request $request, User $user): View
    {
        Gate::authorize('update', $user);

        return view('settings.profile', ['user' => $user]);
    }

    public function editAccount(Request $request, User $user): View
    {
        Gate::authorize('update', $user);

        return view('settings.account', ['user' => $user]);
    }

    public function editSecurity(Request $request, User $user): View
    {
        Gate::authorize('update', $user);

        return view('settings.security', ['user' => $user]);
    }

    public function uploadAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        $user = Auth::user();

        // if user had previous image -> delete it
        if ($user->profile_img_key) {
            $result = Storage::delete('public/'.$user->profile_img_key);
            if (! $result) {
                error_log('Something went wrong while deleting profile photo! '.$user->user_id);
            }
        }

        $image = $request->file('avatar');

        // Resize, convert, and compress the image
        $processedImage = Image::read($image)
            ->resize(288, 288)
            ->encode(new WebpEncoder(quality: 65));

        // Create img key
        $random_hash = strtr(base64_encode(random_bytes(6)), '+/=', '-_.');
        $key = $user->user_id.'/profile-'.$random_hash.'.webp';

        // Upload and save in db
        $result = Storage::put('public/'.$key, $processedImage);
        if (! $result) {
            error_log('Something went wrong while uploading profile photo! '.$user->user_id);
        }
        $user->profile_img_key = $key;
        $user->save();

        return Redirect::route('profile.show', ['user' => $user])
            ->with('status', 'Profile photo updated!');
    }

    public function updateProfile(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('update', $user);

        $user->fill($request->validated());
        $user->save();

        return Redirect::route('settings.profile', ['user' => $user])
            ->with('status', 'Profile updated!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function getMyLikedCovers(int $userId)
    {
        return Cover::select(['covers.cover_id', 'cover_type_id', 'title', 'img_key'])
            ->selectRaw('COUNT(DISTINCT user_liked_cover.user_id) as likes')
            ->join('user_liked_cover', 'covers.cover_id', '=', 'user_liked_cover.cover_id')
            ->where('user_liked_cover.user_id', '=', $userId)
            ->groupBy('covers.cover_id')
            ->orderByDesc('likes')
            ->take(10)
            ->get();
    }

    private function getMyCovers(int $userId)
    {
        return Cover::select(['covers.cover_id', 'cover_type_id', 'title', 'img_key'])
            ->join('authors', 'authors.cover_id', '=', 'covers.cover_id')
            ->where('public', '=', true)
            ->where('authors.user_id', '=', $userId)
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

    }

    private function toDto(Collection $covers)
    {
        $dtos = [];
        foreach ($covers as &$cover) {

            $author = $cover->authors()->first(['users.user_id', 'pen_name', 'first_name', 'last_name', 'login']);

            $type = $cover->coverType()->first(['label'])['label'];

            $dto = [
                'id' => $cover['cover_id'],
                'user' => $author,
                'title' => $cover['title'],
                'type' => $type,
                'imgSrc' => $cover['img_key'],
            ];

            array_push($dtos, $dto);
        }

        return $dtos;
    }
}
