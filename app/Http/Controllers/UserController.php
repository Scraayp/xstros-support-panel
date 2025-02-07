<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{

    public function view(): View
    {

        if (Auth::user()->role !== 'Admin') {
            abort(403);
        }
        $users = User::all();
        return view('user.view', ['users' => $users]);
    }

    public function new(): View
    {
        if (Auth::user()->role !== 'Admin') {
            abort(403);
        }
        return view('user.new');
    }

    public function create(UserCreateRequest $request): RedirectResponse
    {
        // Only Admin users can update the profile.
        if (Auth::user()->role !== 'Admin') {
            abort(403);
        }

        // Get the validated data.
        $data = $request->validated();

        // Create the user
        $user = User::create($data);

        // Return redirect to the user edit page
        return Redirect::route('user.edit', $user)->with('status', 'user-created');
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        // Only Admin users can update the profile.
        if (Auth::user()->role !== 'Admin') {
            abort(403);
        }

        // Get the validated data.
        $data = $request->validated();

        // If a new password is provided, hash it; otherwise, remove it so it isn’t overwritten.
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Check if email is changing, then reset the email_verified_at field
        if ($data['email'] !== $user->email) {
            // Email is changing, so set email_verified_at to null
            $data['email_verified_at'] = null;
        }

        // Handle the 'email_verified_at' from the form select box (set to current time if 'Yes' is selected)
        if (isset($data['email_verified']) && $data['email_verified'] == 1) {
            $data['email_verified_at'] = Carbon::now(); // Set to current time
        }

        // Only update the name and email if they are different
        if ($data['name'] === $user->name) {
            unset($data['name']);
        }

        if ($data['email'] === $user->email) {
            unset($data['email']);
        }

        // Update user
        $user->update($data);

        // If email_verified_at was not set directly, save the updated value
        if (!isset($data['email_verified_at'])) {
            $user->email_verified_at = null; // In case email_verified was not selected
        }

        $user->save(); // Save the final changes

        // Return redirect to the user edit page
        return Redirect::route('user.edit', $user)->with('status', 'user-updated');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, User $user): View
    {
        if (Auth::user()->role !== 'Admin') {
            abort(403);
        }
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== "Admin") {
            abort(403);
        }

        // Fix: Use 'user_id' instead of 'id'
        $toDeleteUser = User::find($request->user_id);

        if (!$toDeleteUser) {
            return Redirect::route('user.list')->with('status', 'user-not-found');
        }

        $toDeleteUser->delete();

        return Redirect::route('user.list')->with('status', 'user-deleted');
    }

}
