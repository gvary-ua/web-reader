<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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
        return view('profile.index', ['user' => $request->user()]);
    }

    public function show(User $user): View
    {
        return view('profile.index', ['user' => $user]);
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
}
