
<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Sepatu</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">CIBADUYUT SHOES</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
        @if(session('user'))
        <span class="text-white me-3">
            {{ session('user')}}
        </span>
        <a href="{{ route( 'logout') }}" class="btn btn-danger btn-sm">Logout</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-warning btn-sm">Login</a>
        @endif
          <button id="btn-wishlist-nav" class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#whislistModal">
            ⭐ Wishlist (<span id="wishlist-count">0</span>)
          </button>
          <button id="btn-theme" class="btn btn-outline-light btn-sm">
            Mode Gelap
          </button>
        </div>
      </div>
    </nav>

    <div class="hero text-center text-white d-flex align-items-center">
      <div class="container">
        <h1>Sistem Manajemen Sepatu</h1>
        <p>Kelola Data sepatu dengan Mudah</p>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row text-center">
        <div class="col-md-4 mb-3">
          <div class="card dashboard-card">
            <div class="card-body">
              <h5>Total Produk</h5>
              <h2>12</h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card dashboard-card">
            <div class="card-body">
              <h5>Stok Tersedia</h5>
              <h2>85</h2>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card dashboard-card">
            <div class="card-body">
              <h5>Kategori</h5>
              <h2>3</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <h3 class="mb-4">Daftar Sepatu</h3>
      <div class="row" id="container-barang">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="{{ asset( 'assets/SEPATU_1.jpg')}}" class="card-img-top" alt="Sepatu 1" />
            <div class="card-body">
              <h5 class="card-title">Kalpji Run (Decathlon)</h5>
              <p class="card-text">Harga: Rp 1.429.000</p>
              <p class="card-text stok-text">Stok: 10</p>
              <div class="d-flex justify-content-between">
                <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                <button class="btn btn-outline-danger btn-wishlist w-50">♥ Wishlist</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="{{ asset('assets/SEPATU_2.jpg')}}" class="card-img-top" alt="Sepatu 2" />
            <div class="card-body">
              <h5 class="card-title">Chunky Sneakers / "Dad Shoes"</h5>
              <p class="card-text">Harga: Rp 1.529.000</p>
              <p class="card-text stok-text">Stok: 7</p>
              <div class="d-flex justify-content-between">
                <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                <button class="btn btn-outline-danger btn-wishlist w-50">♥ Wishlist</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="{{ asset('assets/SEPATU_3.jpg') }}" class="card-img-top" alt="Sepatu 3" />
            <div class="card-body">
              <h5 class="card-title">Vans Style 36 (Gum Sole)</h5>
              <p class="card-text">Harga: Rp 1.729.000</p>
              <p class="card-text stok-text">Stok: 10</p>
              <div class="d-flex justify-content-between">
                <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                <button class="btn btn-outline-danger btn-wishlist w-50">♥ Wishlist</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="whislistModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Daftar Wishlist Saya</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="list-group" id="daftar-items">
                </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-danger" onclick="hapusWishlist()">Kosongkan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5 mb-5">
      <h3 class="mb-4">Tambah Sepatu</h3>
      <div class="card p-4">
        <form id="form-tambah">
          <div class="mb-3">
            <label class="form-label">Nama Sepatu</label>
            <input type="text" class="form-control" placeholder="Masukkan nama sepatu" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" class="form-control" placeholder="Masukkan harga" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control" placeholder="Masukkan stok" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-select">
              <option>Running</option>
              <option>Basket</option>
              <option>Casual</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>

    <footer class="bg-dark text-white text-center p-3">
      © 2026 Sistem Manajemen Sepatu
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>