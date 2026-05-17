<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private array $validationMessages = [
        'name.required' => 'Nama lengkap wajib diisi gaboleh kosong.',
        'name.min' => 'Nama lengkap minimal 3 karakter.',
        'email.required' => 'Email wajib diisi gaboleh kosong.',
        'email.email' => 'Email wajib menggunakan tanda @.',
        'email.unique' => 'Email sudah terdaftar.',
        'phone.required' => 'Nomor telepon wajib diisi gaboleh kosong.',
        'phone.regex' => 'Nomor telepon wajib diawali 08.',
        'password.required' => 'Password wajib diisi gaboleh kosong.',
        'password.regex' => 'Password wajib minimal 8 karakter angka atau huruf.',
        'password.confirmed' => 'Ulangi password harus sama dengan password.',
    ];

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi gaboleh kosong.',
            'email.email' => 'Email wajib menggunakan tanda @.',
            'password.required' => 'Password wajib diisi gaboleh kosong.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->status === 'banned') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->with('danger', 'Akun anda telah tersuspend, hubungi kontak kami kelompok6@gmail.com');
            }

            return redirect()->route('home')->with('success', 'Login berhasil.');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'regex:/^08[0-9]{8,13}$/'],
            'password' => ['required', 'regex:/^[A-Za-z0-9]{8,}$/', 'confirmed'],
        ], $this->validationMessages);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat.');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function forgotSent(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email wajib diisi gaboleh kosong.',
            'email.email' => 'Email wajib menggunakan tanda @.',
        ]);

        return view('auth.forgot-sent', ['email' => $request->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Keluar akun.');
    }
}
