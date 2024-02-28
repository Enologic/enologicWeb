<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller{
   
    public function create(Request $request){
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

        return view('layouts.add');   
     }

    public function delete($id){
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return view('layouts.add'); 
       }

    
    public function increaseUses($id) {
        $coupon = Coupon::findOrFail($id);
        $coupon->increment('uses');

        return view('layouts.add');   
      }

}
