<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AddressController extends Controller
{
    public function saveAddress(Request $request)
    {
        try {
            // Iniciamos una transacción en la base de datos
            DB::beginTransaction();
    
            // Validamos los datos recibidos del formulario
            $request->validate([
                'street' => 'required|string',
                'country' => 'required|string',
                'state' => 'required|string',
                'zipcode' => 'required|string',
            ]);
    
            // Recogemos los datos del formulario
            $street = $request->input('street');
            $country = $request->input('country');
            $city = $request->input('city');
            $state = $request->input('state');
            $zipcode = $request->input('zipcode');
    
            // Aquí obtenemos el ID del usuario actualmente autenticado
            $userId = Auth::id();
    
            // Creamos y guardamos la nueva dirección en la base de datos
            $address = new Address([
                'street' => $street,
                'country' => $country,
                'city' => $city,
                'state' => $state,
                'zipcode' => $zipcode,
                'user_id' => $userId, // Establecemos el ID del usuario
            ]);
            $address->save();
    
            // Confirmamos la transacción si todo está bien
            DB::commit();
    
            // Retornamos a la página del carrito
            return redirect()->route('viewCart')->with('success', 'Address added successfully');
    
        } catch (\Exception $e) {
            // Si ocurre una excepción, realizamos rollback
            DB::rollBack();
    
            // Manejamos cualquier excepción capturada
            \Log::error('Error saving address: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error saving address: ' . $e->getMessage());
        }
    }
}
