<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Statistik;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        Statistik::create([
            'ip_address' => $request->ip(),
            'tanggal_kunjungan' => time()
        ]);

        $products = Products::all();
        
        return view('welcome', compact('products'));
    }
}
