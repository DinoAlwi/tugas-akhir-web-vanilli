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
            <div style="display: flex;">
                <div class="client-navbar">
                    <ul>
                        <a href="">Home</a>
                        <a href="">Products</a>
                        <a href="">About Us</a>
                        <a data-bs-toggle="modal" data-bs-target="#modalLogin" href=""
                            onclick="event.preventDefault();">
                            Statistik
                        </a>
                    </ul>
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
            <div class="row" style="margin-top: 150px;">
                <div class="col" style="display: flex;">
                    <img style="width: 260px; border-radius: 10px; margin-right: 60px;"
                        src="{{ asset('images/vanili-home.jpg') }}" alt="">
                    <div>
                        <h3 style="color: #3b3b3b;font-weight: bold; text-align: start;">Tanaman Vanili</h3>
                        <p>Vanili (Vanilla Planifolia) adalah tanaman penghasil bubuk vanili yang biasa dijadkan
                            pengharum makanan. Bubuk ini dihasilkan dari buahnya yang berbentuk polong.</p>
                        <p>Tanaman Vanili dikenal pertama kali oleh orang-orang Indian Meksiko, negara asal tanaman
                            tersebut. Nama daerah vanili adalah Paneli atau Pernelli</p>
                    </div>
                </div>

            </div>

            {{-- Produk start --}}
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
                                <a data-bs-toggle="modal" data-bs-target="#modalCheckout" href=""
                                    onclick="event.preventDefault();" class="btn btn-primary">
                                    Pesan</a>
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
                    @endforeach


                </div>
            </div>
            <div class="row" style="margin-top: 150px;" id="manfaat">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center;">Manfaat</h3>
                <div style="margin-top: 30px; display:flex; justify-content: space-between;">
                    <div class="benefit-item">
                        <img style="width: 70px;" src="{{ asset('icons/ic_eat.svg') }}" alt="">
                        <ul>
                            <li>Menambah cita rasa makanan</li>
                            <li>Menambah aroma makanan</li>
                            <li>Menjadi bahan pengawet alami pada makanan</li>
                        </ul>
                    </div>
                    <div class="benefit-item">
                        <img style="width: 70px;" src="{{ asset('icons/ic_person.svg') }}" alt="">
                        <ul>
                            <li>Memiliki mineral yang baik untuk tubuh seperti magnesium dan potasium</li>
                        </ul>
                    </div>
                    <div class="benefit-item">
                        <img style="width: 70px;" src="{{ asset('icons/ic_brain.svg') }}" alt="">
                        <ul>
                            <li>Vanili yang diekstrak dapat menghasilkan antidepresan yang baik bagi imunitas serta
                                perasaan manusia</li>
                        </ul>
                    </div>
                    <div class="benefit-item">
                        <img style="width: 70px;" src="{{ asset('icons/ic_shield.svg') }}" alt="">
                        <ul>
                            <li>Kandungan zat pada vanili dapat menjadi antibakterial pada manusia</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- Produk End --}}


            {{-- About start --}}
            <div class="row" style="margin-top: 150px;" id="about">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center; margin-bottom: 20px;">About Us</h3>
                <div class="left elev">
                    <img src="{{ asset('images/about_1.png') }}" class="about_img first">
                    <img src="{{ asset('images/about_2.png') }}" class="about_img second">
                    <img src="{{ asset('images/about_3.png') }}" class="about_img third">
                    <img src="{{ asset('images/about_4.png') }}" class="about_img fourth">
                </div>

                <div class="right">
                    <p style="text-align: center; margin-top: 30px;">Profil usaha ini tercetus pada kelompok tani yang
                        berada pada
                        Kecamatan Singojuruh Dusun Kemiri
                        Kabupaten Banyuwangi Jawa Timur. Para petani ini memulai usaha dalam bidang pertanian Vanili ini
                        sudah cukup lama, dan sangat berkembang karena peminat dari tanaman vanili ini banyak. Dalam
                        usaha ini terdiri dari ketua kelompok tani yaitu Bapak Dwiki</p>
                    <div class="visi">
                        <h4>Visi</h4>
                        <p style="text-align: center; margin-top: 10px;">Dapat mempromosikan dan memasarkan produk
                            tanaman vanili pada Pasar yang lebih besar dan variatif</p>
                    </div>
                    <div class="misi">
                        <h4>Misi</h4>
                        <ul style="text-align: center; margin-top: 10px;">
                            <li>- Membuat wadah promosi untuk tanaman vanilli pada layanan internet.</li>
                            <li>- Membuat konten yang menarik pada layanan internet atau website</li>
                            <li>- Membuat fitur yang dapat membantu calon pelanggan dalam pemeliharaan produk</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- About end --}}

            {{-- Our Program Start --}}
            <div class="row" style="margin-top: 150px;" id="program">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center; margin-bottom: 20px;">Our Program</h3>
                <div class="program-image">
                    <div class="program-left">
                        <img src="{{ asset('images/program_3.png') }}" class="program_img first">
                    </div>
                    <div class="program-center">
                        <div class="top">
                            <img src="{{ asset('images/program_1.png') }}" class="program_img second">
                            <img src="{{ asset('images/program_2.png') }}" class="program_img third">
                        </div>
                        <div class="bottom" style="margin-top: 40px;">
                            <img src="{{ asset('images/program_4.png') }}" class="program_img fourth">
                            <img src="{{ asset('images/program_5.png') }}" class="program_img fifth">
                        </div>
                    </div>
                    <div class="program-right">
                        <img src="{{ asset('images/program_6.png') }}" class="program_img">
                    </div>
                </div>
            </div>
            {{-- Our Program End --}}

            {{-- Article Start --}}
            <div class="row" style="margin-top: 150px;" id="article">
                <h3 style="color: #3b3b3b;font-weight: bold; text-align: center; margin-bottom: 20px;">Related Article
                </h3>
                <div style="display: flex; justify-content: space-evenly;">
                    <div class="card" style="max-width: 300px; height: 280px; margin-right: 10px;">
                        <div class="card-body">
                            <h5
                                class="card-title"style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;max-width: 250px;">
                                Update Harga Buah Vanili Kering dan Basah di Pasaran</h5>
                            <p class="card-text"
                                style="white-space:wrap;overflow: hidden; text-overflow: ellipsis;max-height: 150px;">
                                Vanili, nama
                                ini mungkin sudah tidak asing lagi bagi banyak orang, terutama ibu-ibu rumah tangga.
                                Ini adalah buah yang biasa digunakan sebagai bumbu dan pewangi makanan, termasuk
                                roti, kue, dan lain-lain. Buah vanili sendiri sering disebut sebagai ‘si emas hijau’
                                merujuk harganya yang tergolong mahal. Di pasaran, harga buah vanili kering per kg
                                bisa menembus angka jutaan rupiah.</p>
                            <a href="https://harga.web.id/harga-buah-vanili-kering-dan-basah.info" target="_blank"
                                style="font-style: italic">Baca selengkapnya</a>
                        </div>
                    </div>
                    <div class="card" style="max-width: 300px; height: 280px; margin-right: 10px;">
                        <div class="card-body">
                            <h5
                                class="card-title"style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;max-width: 250px;">
                                Ini 8 Manfaat Tanaman Vanili Bagi Kesehatan</h5>
                            <p class="card-text"
                                style="white-space:wrap;overflow: hidden; text-overflow: ellipsis;max-height: 150px;">
                                Banyak yang belum tahu manfaat tanaman vanili. Padahal, tanaman yang satu ini memiliki
                                khasiat yang tidak boleh disepelekan baik untuk mengatasi masalah kesehatan dan
                                kecantikan. Jangan anggap sepele tanaman tersebut karena memiliki manfaat yang tak
                                diragukan. Bahkan, di sejumlah daerah di Indonesia, tanaman ini dibudidayakan dengan
                                nilai ekonomi yang tinggi.</p>
                            <a href="https://www.99.co/blog/indonesia/manfaat-tanaman-vanili/" target="_blank"
                                style="font-style: italic">Baca selengkapnya</a>
                        </div>

                    </div>
                    <div class="card" style="max-width: 300px; height: 280px; margin-right: 10px;">
                        <div class="card-body">
                            <h5
                                class="card-title"style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;max-width: 250px;">
                                Produk Olahan Vanili Dari Produk Spa hingga Cita Rasa pada Makanan</h5>
                            <p class="card-text"
                                style="white-space:wrap;overflow: hidden; text-overflow: ellipsis;max-height: 150px;">
                                Selama ini vanili banyak dimanfaatkan untuk industri kuliner. Vanili dengan aromanya
                                yang enak, memberikan cita rasa yang nikmat pada produk kuliner. “Vanili memang identik
                                dengan bahan pembuatan kue. Meski penggunaannya sangat sedikit, bisa menambah cita rasa
                                pada kue yang dibuat,” tutur Veni, penjual bahan pembuat kue.</p>
                            <a href="http://bisnisbali.com/produk-olahan-vanili-dari-produk-spa-hingga-cita-rasa-pada-makanan/"
                                target="_blank" style="font-style: italic">Baca selengkapnya</a>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Article End --}}

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
        </div>
    </div>

    {{-- Modal Checkout --}}
    <div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckout" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCheckout">Pesan Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('order.buat') }}" id="pesan-form">
                        @csrf
                        @method('POST')

                        <h4 style="margin-bottom: 30px;">Detail Pesanan</h4>
                        <div class="row mb-3">
                            <div class="col" style="display: flex; align-items: center;">
                                <h6 style="width: 120px;">{{ $products[0]->nama }}</h6>

                                <input style="width: 80px;" id="jumlah_bibit_vanili" type="number"
                                    class="form-control @error('jumlah_bibit_vanili') is-invalid @enderror"
                                    name="1" value="0" required autocomplete="jumlah_bibit_vanili">

                                @error('jumlah_bibit_vanili')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col" style="display: flex; align-items: center;">
                                <h6 style="width: 120px;">{{ $products[1]->nama }}</h6>

                                <input style="width: 80px;" id="jumlah_vanili_kering" type="number"
                                    class="form-control @error('jumlah_vanili_kering') is-invalid @enderror"
                                    name="2" value="0" required autocomplete="jumlah_vanili_kering">

                                @error('jumlah_vanili_kering')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col" style="display: flex; align-items: center;">
                                <h6 style="width: 120px;">{{ $products[2]->nama }}</h6>

                                <input style="width: 80px;" id="jumlah_vanili_basah" type="number"
                                    class="form-control @error('jumlah_vanili_basah') is-invalid @enderror"
                                    name="3" value="0" required autocomplete="jumlah_vanili_basah">

                                @error('jumlah_vanili_basah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <h4 style="margin: 30px 0;">Detail Pembeli</h4>
                        <div class="row mb-3">
                            <div class="col">
                                <input id="nama" type="text"
                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                    value="{{ old('nama') }}" placeholder="Nama Pembeli" required
                                    autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="alamat" type="text"
                                    class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                    value="{{ old('alamat') }}" placeholder="Alamat" required autocomplete="alamat">

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="whatsapp" type="number"
                                    class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp"
                                    value="{{ old('whatsapp') }}" placeholder="No Whatsapp" required
                                    autocomplete="whatsapp">

                                @error('whatsapp')
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
                        onclick="document.getElementById('pesan-form').submit();">Pesan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLogin">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.login.auth') }}" id="login-form">
                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" placeholder="Username" required
                                    autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Password">

                                @error('password')
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
                        onclick="document.getElementById('login-form').submit();">Login</button>
                </div>
            </div>
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
</body>

</html>
