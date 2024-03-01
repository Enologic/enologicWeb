<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{

    public function viewCoupons(){
        try {
            // Obtener todos los cupones
            $coupons = Coupon::all();
    
            // Devolver la vista con los cupones
            return view('layouts.coupons', compact('coupons'));
        } catch (\Exception $e) {
            // Maneja adecuadamente la excepción, por ejemplo, mostrando un mensaje de error
            return view('layouts.coupons')->with('error', 'Error al cargar la lista de cupones: ' . $e->getMessage());
        }
    }
    
  
    public function save(Request $request){
        $request->validate([
            'name' => 'required|string|unique:coupons,name',
            'percentage' => 'required|numeric|min:0|max:100',
            'uses' => 'required|integer|min:0',
        ]);

        $coupon = Coupon::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'uses' => $request->uses,
        ]);

         $coupons = Coupon::all();

         return back()->with('coupons', $coupons)->with('success', 'Coupon added successfully');
    }

   
public function delete(Request $request)
{
    try {
        $couponId = $request->input('coupon_id');
        $coupon = Coupon::findOrFail($couponId);
        $coupon->delete();

        // Obtener todos los cupones después de eliminar uno
        $coupons = Coupon::all();

        // Redirigir a la página anterior con los cupones actualizados
        return back()->with('coupons', $coupons)->with('success', 'Coupon deleted successfully');
    } catch (\Exception $e) {
        // Maneja adecuadamente la excepción, por ejemplo, mostrando un mensaje de error
        return back()->with('error', 'Error deleting coupon: ' . $e->getMessage());
    }
}
    

    public function increaseUses($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->increment('uses');

        return view('layouts.add');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);
    
        $couponCode = $request->coupon_code;
        $coupon = Coupon::where('name', $couponCode)->first();
    
        if ($coupon) {

            $discountPercentage = $coupon->percentage;
    
            return response()->json(['message' => 'Cupón aplicado correctamente', 'discount_percentage' => $discountPercentage], 200);
        } else {
            return response()->json(['message' => 'El cupón no existe'], 200);
        }
    }
    


}