<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function saveAddress(Request $request)
    {
        try {
            // Validar los datos recibidos del formulario
            $request->validate([
                'street' => 'required|string',
                'country' => 'required|string',
                'state' => 'required|string',
                'zipcode' => 'required|string',
            ]);

            // Recoger los datos del formulario
            $street = $request->input('street');
            $country = $request->input('country');
            $city = $request->input('city');
            $state = $request->input('state');
            $zipcode = $request->input('zipcode');

            // Aquí obtienes el ID del usuario actualmente autenticado
            $userId = Auth::id();

            // Crear y guardar la nueva dirección en la base de datos
            $address = new Address([
                'street' => $street,
                'country' => $country,
                'city' => $city,
                'state' => $state,
                'zipcode' => $zipcode,
                'user_id' => $userId, // Establecer el ID del usuario
            ]);
            $address->save();

            // Retorna a la página del carrito
            return redirect()->route('viewCart')->with('success', 'Address added successfully');

        } catch (\Exception $e) {
            // Manejar cualquier excepción capturada
            \Log::error('Error saving address: ' . $e->getMessage());
            echo($e->getMessage());
        }
    }
}
