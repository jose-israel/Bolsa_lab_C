<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Si el usuario es administrador, permitir el acceso sin verificar la aprobación
            if ($user->rol === 'admin') {
                return redirect()->intended('/dashboard');
            }

            // Verificar si el usuario está aprobado
            if (!$user->is_approved) {
                Auth::logout();
                return redirect()->route('approval.wait')->with('message', 'Tu cuenta está en espera de aprobación.');
            }

            // Redirigir al dashboard si el usuario está aprobado
            return redirect()->intended('/dashboard');
        }
        

        // Redirigir de nuevo con un mensaje de error si la autenticación falla
        return redirect()->back()->withErrors(['email' => 'Las credenciales no son correctas.']);
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}
