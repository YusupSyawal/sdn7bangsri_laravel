<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Show the forgot password form
     */
    public function showResetForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'secret_key' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Sandi baru harus diisi.',
            'password.min' => 'Sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi sandi tidak cocok.',
            'secret_key.required' => 'Kunci rahasia harus diisi.',
        ]);

        // Verify secret key (simple security for school project)
        $validSecretKey = env('ADMIN_SECRET_KEY', 'admin123');
        
        if ($request->secret_key !== $validSecretKey) {
            return back()->withErrors(['secret_key' => 'Kunci rahasia salah.'])->withInput();
        }

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.'])->withInput();
        }

        // Check if user is admin
        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Hanya admin yang dapat mereset sandi melalui halaman ini.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Sandi berhasil direset! Silakan login dengan sandi baru Anda.');
    }
}
