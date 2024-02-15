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
                'city' => 'required|string',
                'zipcode' => 'required|string',
                'action' => 'required|string',
            ]);
    
            // Recogemos los datos del formulario
            $street = $request->input('street');
            $country = $request->input('country');
            $city = $request->input('city');
            $zipcode = $request->input('zipcode');
            $action = $request->input('action');

            // Aquí obtenemos el ID del usuario actualmente autenticado
            $userId = Auth::id();
    
            // Creamos y guardamos la nueva dirección en la base de datos
            $address = new Address([
                'street' => $street,
                'country' => $country,
                'city' => $city,
                'zipcode' => $zipcode,
                'user_id' => $userId, // Establecemos el ID del usuario
            ]);
            $address->save();
    
            // Confirmamos la transacción si todo está bien
            DB::commit();
    
           
            // Redirigir según el valor del campo "action"
        if ($action === 'redirect_here') {
            return redirect()->back()->with('success', 'Address added successfully');
        } else {
            return redirect()->route('viewCart')->with('success', 'Address added successfully');
        }
    
        } catch (\Exception $e) {
            // Si ocurre una excepción, realizamos rollback
            DB::rollBack();
    
            // Manejamos cualquier excepción capturada
            \Log::error('Error saving address: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error saving address: ' . $e->getMessage());
        }
    }

public function editAddress(Request $request)
{
    try {
        // Iniciamos una transacción en la base de datos
        DB::beginTransaction();

        // Validamos los datos recibidos del formulario
        $request->validate([
            'street' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'zipcode' => 'required|string',
            'action' => 'required|string',
        ]);

        // Recogemos los datos del formulario
        $street = $request->input('street');
        $country = $request->input('country');
        $city = $request->input('city');
        $zipcode = $request->input('zipcode');
        $action = $request->input('action');

        // Aquí obtenemos el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Buscamos la dirección del usuario actual
        $address = Address::where('user_id', $userId)->first();

        // Verificamos si el usuario tiene una dirección guardada
        if (!$address) {
           // return redirect()->back()->with('error', 'Address not found.');
        }

        // Actualizamos los campos de la dirección
        $address->street = $street;
        $address->country = $country;
        $address->city = $city;
        $address->zipcode = $zipcode;
        $address->save();

        // Confirmamos la transacción si todo está bien
        DB::commit();

        // Redirigir según el valor del campo "action"
        if ($action === 'redirect_here') {
            return redirect()->back()->with('success', 'Address edited successfully');
        } else {
            return redirect()->route('viewCart')->with('success', 'Address edited successfully');
        }

    } catch (\Exception $e) {
        // Si ocurre una excepción, realizamos rollback
        DB::rollBack();

        // Manejamos cualquier excepción capturada
        \Log::error('Error editing address: ' . $e->getMessage());
        echo($e);
       // return redirect()->back()->with('error', 'Error editing address: ' . $e->getMessage());
    }
}


}
