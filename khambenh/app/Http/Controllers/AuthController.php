<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // ==== Đăng ký (chỉ bệnh nhân) ====
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Tạo user với role patient
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient',
        ]);

        // Tạo bản ghi patient
        Patient::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // ==== Đăng nhập ====
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        switch ($user->role) {
            case 'patient':
                return redirect()->route('dashboard.patient', ['id' => $user->id]);
            case 'doctor':
                return redirect()->route('dashboard.doctor', ['id' => $user->id]);
            case 'staff':
                return redirect()->route('dashboard.staff', ['id' => $user->id]);
            case 'admin':
                return redirect()->route('dashboard.admin', ['id' => $user->id]);
        }
    }

    return back()->withErrors([
        'email' => 'Email hoặc mật khẩu không đúng!',
    ]);
}



    // ==== Đăng xuất ====
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Đăng xuất thành công!');
}

    

    // ==== Quên mật khẩu ====
    public function showForgotPassword()
    {
        return view('auth.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Đã gửi link khôi phục mật khẩu qua email!')
            : back()->withErrors(['email' => 'Không gửi được link, thử lại sau.']);
    }
}
