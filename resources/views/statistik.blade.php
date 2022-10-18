<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E Vanili</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #FAF3E3;
        }
    </style>
</head>

<body class="antialiased client">
    @include('sweetalert::alert')

    <div class="landing">
        <div class="client-header">
            <h2>E. Vanili</h2>
            <div style="display: flex; align-items: center; justify-content: center;">
                <div class="client-navbar" style="width: 330px; margin-right: 80px;">
                    <ul>
                        <a href="">Statistik</a>
                        <a href="">Pesanan</a>
                        <a href="">Konfirmasi</a>
                    </ul>
                </div>
                <div class="client-title">
                    <h5 style="color: black;">{{ Auth::user()->nama }}</h5>
                    <div class="dropdown" style="margin-left: 30px;">
                        <a class="btn dropdown-toggle" style="background-color: #212529; color: white;" href="#"
                            role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>


                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                href="" onclick="event.preventDefault();">
                                Logout
                            </a>


                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container home-menu" style="padding: 0 40px;" id="home">
            <div class="row">
                <div class="col">
                    <div id="carouselExampleIndicators" style="height: 300px; width: 800px; margin: 0 auto;"
                        class="carousel slide home-slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div style="height: 300px;" class="carousel-inner">
                            <div class="carousel-item active">
                                <img style="border-radius: 10px;" src="{{ asset('images/carousel_1.png') }}"
                                    class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img style="border-radius: 10px;" src="{{ asset('images/carousel_2.png') }}"
                                    class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img style="border-radius: 10px;" src="{{ asset('images/carousel_3.png') }}"
                                    class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Statistik --}}
            <div class="row" style="margin-top: 150px;" id="produk">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center;">Statistik Website</h3>
                <div class="row" style="margin-top: 30px; display:flex; justify-content: space-between;">
                    <div class="col">
                        <canvas id="chartHarian" height="100px"></canvas>
                    </div>

                    <div class="col">
                        <canvas id="chartBulanan" height="100px"></canvas>
                    </div>
                </div>
            </div>
            {{-- Statistik --}}

            {{-- Products --}}
            <div class="row" style="margin-top: 150px;" id="produk">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center;">Products</h3>
                <div class="row" style="margin-top: 30px; display:flex; justify-content: space-between;">
                    @foreach ($products as $product)
                        <div class="card" style="width: 18rem; background-color: #71EFA3; margin-top: 40px;">
                            <img src="{{ asset('images/' . $product->img) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->nama }}</h5>
                                <p style="margin: 0;">{{ $product->deskripsi_harga }} Rp. {{ $product->harga }}</p>
                                <p>Stok : {{ $product->stok }}</p>
                                @can('petani')
                                    <a data-bs-toggle="modal" data-bs-target="#updateStokModal-{{ $product->id }}"
                                        href="" onclick="event.preventDefault();" class="btn btn-primary">
                                        Update Stok</a>
                                @endcan
                                @can('admin')
                                    <a data-bs-toggle="modal" data-bs-target="#editProduk-{{ $product->id }}"
                                        href="" onclick="event.preventDefault();" class="btn btn-primary">
                                        Edit</a>
                                    <a data-bs-toggle="modal" data-bs-target="#hapusProduk-{{ $product->id }}"
                                        href="" onclick="event.preventDefault();" class="btn btn-primary">
                                        Hapus</a>
                                @endcan
                            </div>
                        </div>
                        <div class="modal fade" id="updateStokModal-{{ $product->id }}" tabindex="-1"
                            aria-labelledby="updateStokModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateStokModal">Update Stok</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST"
                                            action="{{ route('product.stok.update', $product->id) }}"
                                            id="update-stok-form-{{ $product->id }}">
                                            @csrf
                                            @method('POST')
                                            <div class="row mb-3">
                                                <div class="col" style="display: flex; align-items: center;">
                                                    <h6 style="width: 120px;">{{ $product->nama }}</h6>

                                                    <input type="text" hidden name="id_product"
                                                        value="{{ $product->id }}">
                                                    <input style="width: 80px;" id="stok" type="number"
                                                        class="form-control @error('stok') is-invalid @enderror"
                                                        name="stok" value="{{ $product->stok }}" required
                                                        autocomplete="stok">

                                                    @error('stok')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn1"
                                            onclick="document.getElementById('update-stok-form-{{ $product->id }}').submit();">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('admin')
                            <div class="modal fade" id="hapusProduk-{{ $product->id }}" tabindex="-1"
                                aria-labelledby="hapusProduk" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusProduk">Hapus Produk {{ $product->nama }}?
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('product.delete', $product->id) }}"
                                                id="delete-product-form-{{ $product->id }}">
                                                @csrf
                                                @method('POST')
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn1"
                                                onclick="document.getElementById('delete-product-form-{{ $product->id }}').submit();">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('admin')
                            <div class="modal fade" id="editProduk-{{ $product->id }}" tabindex="-1"
                                aria-labelledby="editProduk" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProduk">Edit Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" enctype="multipart/form-data"
                                                action="{{ route('product.edit', $product->id) }}"
                                                id="edit-produk-form-{{ $product->id }}">
                                                @csrf
                                                @method('POST')
                                                <div class="row mb-3">
                                                    <div class="col" style="display: flex; align-items: center;">

                                                        <input type="text" hidden name="id_product"
                                                            value="{{ $product->id }}">
                                                        <div style="width: 100%;">
                                                            <label style="font-weight: bold;" for="nama_produk">Nama
                                                                Produk</label>
                                                            <input style="width: 100%;" id="nama_produk" type="text"
                                                                class="form-control @error('nama_produk') is-invalid @enderror"
                                                                name="nama_produk" value="{{ $product->nama }}" required
                                                                autocomplete="nama_produk">

                                                            <br>
                                                            <label style="font-weight: bold;" for="harga">Harga</label>
                                                            <input style="width: 100%;" id="harga" type="number"
                                                                class="form-control @error('harga') is-invalid @enderror"
                                                                name="harga" value="{{ $product->harga }}" required
                                                                autocomplete="harga">

                                                            <br>
                                                            <label style="font-weight: bold;"
                                                                for="deskripsi_harga">Deskripsi deskripsi_harga</label>
                                                            <input style="width: 100%;" id="deskripsi_harga"
                                                                type="text"
                                                                class="form-control @error('deskripsi_harga') is-invalid @enderror"
                                                                name="deskripsi_harga"
                                                                value="{{ $product->deskripsi_harga }}" required
                                                                autocomplete="deskripsi_harga">

                                                            <br>
                                                            <label style="font-weight: bold;" for="img">Foto Produk
                                                                (opsional)
                                                            </label>
                                                            <input style="width: 100%;" id="img" type="file"
                                                                class="form-control @error('img') is-invalid @enderror"
                                                                name="img" value="{{ $product->img }}" required
                                                                autocomplete="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn1"
                                                onclick="document.getElementById('edit-produk-form-{{ $product->id }}').submit();">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    @endforeach

                </div>
                @can('admin')
                    <div style="text-align: center;">
                        <a data-bs-toggle="modal" style="margin-top: 30px; width: 180px;" data-bs-target="#tambahProduk"
                            href="" onclick="event.preventDefault();" class="btn1">
                            Tambah Produk</a>
                    </div>
                @endcan
                @can('admin')
                    <div class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="tambahProduk"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahProduk">Tambah Produk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('product.create', $product->id) }}" id="create-product-form">
                                        @csrf
                                        @method('POST')
                                        <div class="row mb-3">
                                            <div class="col" style="display: flex; align-items: center;">

                                                <input type="text" hidden name="id_product"
                                                    value="{{ $product->id }}">
                                                <div style="width: 100%;">
                                                    <label style="font-weight: bold;" for="nama_produk">Nama
                                                        Produk</label>
                                                    <input style="width: 100%;" id="nama_produk" type="text"
                                                        class="form-control @error('nama_produk') is-invalid @enderror"
                                                        name="nama_produk" required autocomplete="nama_produk">

                                                    <br>
                                                    <label style="font-weight: bold;" for="harga">Harga</label>
                                                    <input style="width: 100%;" id="harga" type="number"
                                                        class="form-control @error('harga') is-invalid @enderror"
                                                        name="harga" required autocomplete="harga">

                                                    <br>
                                                    <label style="font-weight: bold;" for="deskripsi_harga">Deskripsi
                                                        deskripsi_harga</label>
                                                    <input style="width: 100%;" id="deskripsi_harga" type="text"
                                                        class="form-control @error('deskripsi_harga') is-invalid @enderror"
                                                        name="deskripsi_harga" required autocomplete="deskripsi_harga">

                                                    <br>
                                                    <label style="font-weight: bold;" for="img">Foto Produk
                                                        (opsional)</label>
                                                    <input style="width: 100%;" id="img" type="file"
                                                        class="form-control @error('img') is-invalid @enderror"
                                                        name="img" required autocomplete="img">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn1"
                                        onclick="document.getElementById('create-product-form').submit();">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            {{-- Products --}}

            {{-- Pesanan --}}
            <div class="row" style="margin-top: 150px;">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center;">Pesanan</h3>
                <div style="margin-top: 20px;" class="col content">
                    @if (count($orders) < 1)
                        <h3 style="color: #3b3b3b;font-weight: bold; margin-top: 60px; text-align: center;">Tidak Ada
                            Pesanan</h3>
                    @else
                        <table class="table">
                            @php
                                $i = 0;
                            @endphp
                            <thead class="bg-4" style="color: white; background-color: #50CB93;">
                                <tr>
                                    <th scope="col" style="color: #3b3b3b;">No.</th>
                                    <th scope="col" style="color: #3b3b3b;">Nama Pembeli</th>
                                    <th scope="col" style="color: #3b3b3b; width: 180px;">Alamat</th>
                                    <th scope="col" style="color: #3b3b3b;">No Whatsapp</th>
                                    <th scope="col" style="color: #3b3b3b;">Total Pembelian</th>
                                    <th scope="col" style="color: #3b3b3b;">Status Pesanan</th>
                                    <th scope="col" style="color: #3b3b3b;">Detail</th>
                                    @can('admin')
                                        <th scope="col" style="color: #3b3b3b;">Konfirmasi</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody style="background-color: white;">
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $order->nama }}</td>
                                        <td>{{ $order->alamat }}</td>
                                        <td>{{ $order->no_whatsapp }}</td>
                                        <td>Rp. {{ number_format($order->total) }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#konfirmasiPesanan-{{ $order->id }}"
                                                href="" onclick="event.preventDefault();"
                                                class="btn btn-primary">
                                                Detail</a>
                                        </td>
                                        @can('admin')
                                            <td>
                                                <a target="_blank"
                                                    href="https://wa.me/{{ $order->no_whatsapp }}?text={{ urlencode('Halo ' . $order->nama . ' pesanan anda dengan total Rp. ' . $order->total . ' dalam status ' . $order->status) }}"
                                                    class="btn btn-primary">
                                                    Konfirmasi</a>
                                            </td>
                                        @endcan
                                    </tr>
                                    <div class="modal fade" id="konfirmasiPesanan-{{ $order->id }}"
                                        tabindex="-1" aria-labelledby="konfirmasiPesanan" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="konfirmasiPesanan">Detail Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('petani.konfirmasi', $order->id) }}"
                                                        id="konfirmasi-pesanan-form-{{ $order->id }}">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="row mb-3">
                                                            <div class="col"
                                                                style="display: flex; align-items: center;">

                                                                <div style="width: 100%;">
                                                                    <div style="display: flex; width: 100%;">
                                                                        <p style="width: 200px; font-weight: bold;">
                                                                            Nama Produk</p>
                                                                        <p style="width: 200px; font-weight: bold;">
                                                                            Jumlah</p>
                                                                        <p style="width: 200px; font-weight: bold;">
                                                                            Harga</p>
                                                                        <p style="width: 200px; font-weight: bold;">
                                                                            Total</p>
                                                                    </div>
                                                                    @foreach ($detail_orders as $detail)
                                                                        @if ($detail->id_order === $order->id)
                                                                            <div style="display: flex; width: 100%;">
                                                                                <p style="width: 200px;">
                                                                                    {{ $detail->nama }}</p>
                                                                                <p style="width: 200px;">
                                                                                    {{ $detail->jumlah }}</p>
                                                                                <p style="width: 200px;">Rp.
                                                                                    {{ number_format($detail->harga) }}
                                                                                </p>
                                                                                <p style="width: 200px;">Rp.
                                                                                    {{ number_format($detail->total) }}
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                @error('catatan')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div style="display: flex; width: 100%;">
                                                                <h5 style="width: 200px;">Total</h5>

                                                                <h5 style="width: 200px; color: white;">Rp.
                                                                    sadfsdf</h5>
                                                                <h5 style="width: 200px; color: white;">Rp.
                                                                    asdfsadf</h5>
                                                                <h5 style="width: 200px;">Rp.
                                                                    {{ number_format($order->total) }}</h5>
                                                            </div>
                                                        </div>

                                                        @can('petani')
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <select class="form-select"
                                                                        aria-label="Default select example"
                                                                        name="status">
                                                                        <option selected>Status Pesanan</option>
                                                                        <option value="PESANAN DIPROSES">PESANAN DIPROSES
                                                                        </option>
                                                                        <option value="PESANAN SELESAI">PESANAN SELESAI
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endcan
                                                    </form>
                                                </div>
                                                @can('petani')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn2"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="button" class="btn1"
                                                            onclick="document.getElementById('konfirmasi-pesanan-form-{{ $order->id }}').submit();">Konfirmasi</button>
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            {{-- Pesanan --}}

            {{-- Footer --}}
            <div class="row" style="margin-top: 150px;" id="footer">
                <div style="margin-top: 30px; display:flex; justify-content: space-between;">
                    <div class="item">
                        <h5 style="font-weight: bold;">Follow Us</h5>
                        <div style="display: flex; align-items: center;">
                            <a target="_blank" style=" margin-right: 10px;"
                                href="https://www.instagram.com/vanili_banyuwangi/">
                                <img style="width: 30px;" src="{{ asset('icons/ic_instagram.svg') }}"
                                    alt="">
                            </a>
                            <a target="_blank" href="https://www.facebook.com/Vanili-Banyuwangi-104504499059174/">
                                <img style="width: 30px;" src="{{ asset('icons/ic_facebook.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <h5 style="font-weight: bold;">Company</h5>
                        <p>About Us</p>
                    </div>
                    <div class="item">
                        <h5 style="font-weight: bold;">Products</h5>
                        <p>Vanili</p>
                        <p>Statistik</p>
                    </div>
                    <div class="item">
                        <h5 style="font-weight: bold;">Contact Us</h5>
                        <p>0123456789</p>
                        <p>vanilisingojuruh@gmail.com</p>
                    </div>
                </div>
            </div>
            {{-- Footer --}}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Logout sekarang?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn2" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn1"
                        onclick="document.getElementById('logout-form').submit();">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">
        var labelsHari = {{ Js::from($labels_hari) }};
        var dataHari = {{ Js::from($data_hari) }};
        var labelsBulan = {{ Js::from($labels_bulan) }};
        var dataBulan = {{ Js::from($data_bulan) }};

        const statistikHarian = {
            labels: labelsHari,
            datasets: [{
                label: 'Kunjungan Harian',
                backgroundColor: '71EFA3',
                borderColor: '#71EFA3',
                data: dataHari,
            }]
        };
        const statistikBulanan = {
            labels: labelsBulan,
            datasets: [{
                label: 'Kunjungan Bulanan',
                backgroundColor: '71EFA3',
                borderColor: '#71EFA3',
                data: dataBulan,
            }]
        };

        const configStatistikHarian = {
            type: 'line',
            data: statistikHarian,
            options: {}
        };
        const configStatistikBulanan = {
            type: 'line',
            data: statistikBulanan,
            options: {}
        };

        const myChartHarian = new Chart(
            document.getElementById('chartHarian'),
            configStatistikHarian
        );
        const myChartBulanan = new Chart(
            document.getElementById('chartBulanan'),
            configStatistikBulanan
        );
    </script>
</body>

</html>
