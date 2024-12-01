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
use Illuminate\View\View;

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
