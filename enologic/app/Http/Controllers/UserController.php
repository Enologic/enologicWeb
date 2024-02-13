<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewProfile()
{
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Verificar si el usuario existe
    if (!$user) {
        // Puedes manejar la lógica si el usuario no está autenticado, por ejemplo, redireccionar a una página de inicio de sesión
        return redirect()->route('login')->with('error', 'Usuario no autenticado.');
    }

    // Obtener la dirección del usuario
    $address = $user->address;

    // Devolver los datos del usuario y la dirección
    return view('layouts.profile', compact('user', 'address'));
}

}
