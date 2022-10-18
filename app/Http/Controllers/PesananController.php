<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Pembeli;
use App\Models\Products;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function buatPesanan(Request $request)
    {
        $pembeli = Pembeli::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_whatsapp' => $request->whatsapp
        ]);

        $order = Order::create([
            'pembeli_id' => $pembeli->id,
            'status' => 'MENUNGGU KONFIRMASI',
            'total' => 0,
            'tanggal_pemesanan' => time()
        ]);

        $total = 0;

        for ($i = 1; $i < 4; $i++) {
            $harga = Products::find($i)->harga;

            if ($request["$i"] !== '0') {
                DetailOrder::create([
                    'order_id' => $order->id,
                    'product_id' => $i,
                    'jumlah' => (int)$request["$i"],
                    'total' => (int)$request["$i"] * $harga,
                ]);
                $total += (int)$request["$i"] * $harga;
            }
        }

        $order->update([
            'total' => $total
        ]);


        Alert::success('info', 'Pemesanan berhasil, silahkan tunggu konfirmasi melalui whatsapp');
        return redirect('/');
    }
}
