<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use App\Models\Statistik;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $statistiks = Statistik::all();

        $hari = [
            'Senin' => 0,
            'Selasa' => 0,
            'Rabu' => 0,
            'Kamis' => 0,
            'Jumat' => 0,
            'Sabtu' => 0,
            'Minggu' => 0
        ];

        $bulan = [
            'Januari' => 0,
            'Februari' => 0,
            'Maret' => 0,
            'April' => 0,
            'Mei' => 0,
            'Juni' => 0,
            'Juli' => 0,
            'Agustus' => 0,
            'September' => 0,
            'Oktober' => 0,
            'November' => 0,
            'Desember' => 0,
        ];

        foreach ($statistiks as $statistik) {
            foreach ($hari as $key => $item) {
                if ($this->timestampToDay($statistik->tanggal_kunjungan) === $key) {
                    $hari[$key] = $hari[$key] += 1;
                }
            }
        }

        foreach ($statistiks as $statistik) {
            foreach ($bulan as $key => $item) {
                if ($this->timestampToBulan($statistik->tanggal_kunjungan) === $key) {
                    $bulan[$key] = $bulan[$key] += 1;
                }
            }
        }

        $products = Products::all();

        $orders = DB::table('orders')
            ->join('pembelis', 'orders.pembeli_id', '=', 'pembelis.id')
            ->select(
                'orders.id',
                'orders.total',
                'orders.status',
                'pembelis.nama',
                'pembelis.alamat',
                'pembelis.no_whatsapp'
            )
            ->get();

        $detail_orders = DB::table('detail_orders')
            ->join('orders', 'detail_orders.order_id', '=', 'orders.id')
            ->join('products', 'detail_orders.product_id', '=', 'products.id')
            ->select(
                'orders.id as id_order',
                'products.nama',
                'products.harga',
                'detail_orders.total',
                'detail_orders.jumlah'
            )
            ->get();



        $labels_hari = array_keys($hari);
        $data_hari = array_values($hari);

        $labels_bulan = array_keys($bulan);
        $data_bulan = array_values($bulan);

        return view('statistik', compact(
            'labels_hari',
            'data_hari',
            'labels_bulan',
            'data_bulan',
            'products',
            'orders',
            'detail_orders'
        ));
    }

    public function tambahProduk(Request $request)
    {
        $fileName = $request->img->getClientOriginalName();
        $path_foto_produk = public_path() . "/images";
        $request->img->move($path_foto_produk, $fileName);

        $produk = Products::create([
            'nama'  => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi_harga' => $request->deskripsi_harga,
            'img' => $fileName
        ]);

        Alert::success('info', "Produk $produk->nama berhasil ditambahkan");
        return redirect()->route('admin.statistik');
    }

    public function editProduk(Request $request, $id)
    {
        $produk = Products::find($id);
        if ($request->img) {
            $fileName = $request->img->getClientOriginalName();
            $path_foto_produk = public_path() . "/images";
            $request->img->move($path_foto_produk, $fileName);

            $produk->update([
                'nama'  => $request->nama_produk,
                'harga' => $request->harga,
                'deskripsi_harga' => $request->deskripsi_harga,
                'img' => $fileName
            ]);

            Alert::success('info', "Produk berhasil di update");
            return redirect()->route('admin.statistik');
        }

        $produk->update([
            'nama'  => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi_harga' => $request->deskripsi_harga,
            'img' => $produk->img
        ]);

        Alert::success('info', "Produk berhasil di update");
        return redirect()->route('admin.statistik');
    }

    public function hapusProduk($id)
    {
        $product = Products::find($id);

        $product->delete();

        Alert::success('info', "Produk $product->nama berhasil di hapus");
        return redirect()->route('admin.statistik');
    }

    public function updateStok(Request $request, $id)
    {
        $product = Products::find($id);

        $product->update([
            'stok' => $request->stok
        ]);

        Alert::success('info', "Stok produk $product->nama berhasil diupdate");
        return redirect()->route('petani.statistik');
    }

    public function konfirmasiPesanan(Request $request, $id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => $request->status
        ]);

        Alert::success('info', "Pesanan berhasil di konfirmasi");
        return redirect()->route('petani.statistik');
    }


    // Helper Function
    public function timestampToDay($date)
    {
        $tanggal = Carbon::createFromTimestamp(
            $date
        )->locale('id')->translatedFormat('l');

        return $tanggal;
    }

    public function timestampToBulan($date)
    {
        $tanggal = Carbon::createFromTimestamp(
            $date
        )->locale('id')->translatedFormat('F');

        return $tanggal;
    }
}
