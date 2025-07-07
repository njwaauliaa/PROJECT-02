<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:500',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $user = $request->user();
        $user->alamat = $request->alamat;
        $user->save();

        Alert::success('Berhasil!', 'Alamat Anda telah diperbarui.');

        return redirect()->route('profile.edit')->with('status', 'address-updated');
    }

    public function upgradeToSeller(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'pembeli') {
            $user->role = 'penjual';
            $user->save();

            Alert::success('Selamat!', 'Akun Anda telah di-upgrade menjadi Penjual.');
        }

        return redirect()->route('profile.edit');
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
