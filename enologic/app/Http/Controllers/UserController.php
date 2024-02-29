<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
    $addresses = $user->address;

    // Devolver los datos del usuario y la dirección
   return view('layouts.profile', compact('user', 'addresses'));
}
public function editUser(Request $request)
{
    try {
        
        $user = Auth::user();
        // Iniciamos una transacción en la base de datos
        DB::beginTransaction();

        // Validamos los datos recibidos del formulario
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'name' => 'required|string',
        ]);

        // Recogemos los datos del formulario
        $username = $request->input('username');
        $phone = $request->input('phone');
        $name = $request->input('name');

        // Obtenemos el usuario actualmente autenticado
        $user = Auth::user();

        // Verificamos si el usuario existe
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Actualizamos los campos del perfil
        $user->username = $username;
        $user->phone = $phone;
        $user->name = $name;
        $user->save();

        // Confirmamos la transacción si todo está bien
        DB::commit();

        // Redirigir al perfil del usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Profile updated successfully');

    } catch (\Exception $e) {
        // Si ocurre una excepción, realizamos rollback
        DB::rollBack();

        // Manejamos cualquier excepción capturada
        \Log::error('Error editing profile: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error editing profile: ' . $e->getMessage());
    }
}



}
