document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const btnTheme = document.getElementById('btn-theme');
    const wishlistCountEl = document.getElementById('wishlist-count');
    const daftarItems = document.getElementById('daftar-items');

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        if (btnTheme) btnTheme.innerText = 'Mode Terang';
    }

    if (btnTheme) {
        btnTheme.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                btnTheme.innerText = 'Mode Terang';
            } else {
                localStorage.removeItem('theme');
                btnTheme.innerText = 'Mode Gelap';
            }
        });
    }

    let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');

    function updateWishlistCount() {
        if (wishlistCountEl) wishlistCountEl.innerText = wishlist.length;
    }

    function tampilkanWishlist() {
        if (!daftarItems) return;
        daftarItems.innerHTML = '';

        if (wishlist.length === 0) {
            daftarItems.innerHTML = '<li class="list-group-item text-center text-muted">Belum ada item di wishlist</li>';
        } else {
            wishlist.forEach((item, idx) => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `
                    <span>${item}</span>
                    <button class="btn btn-sm btn-danger" onclick="removeFromWishlist(${idx})">Hapus</button>
                `;
                daftarItems.appendChild(li);
            });
        }
    }

    updateWishlistCount();

    document.body.addEventListener('click', function(e) {
        const wlBtn = e.target.closest('.btn-wishlist');
        if (wlBtn) {
            const cardBody = wlBtn.closest('.card-body');
            const namaBarang = cardBody.querySelector('.card-title').innerText;

            if (wishlist.includes(namaBarang)) {
                alert('Barang ini sudah ada di wishlist!');
            } else {
                wishlist.push(namaBarang);
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                updateWishlistCount();
                alert('Berhasil ditambahkan ke wishlist: ' + namaBarang);
                if (daftarItems && document.getElementById('whislistModal').classList.contains('show')) {
                    tampilkanWishlist();
                }
            }
        }
    });

    document.body.addEventListener('click', function(e) {
        const beliBtn = e.target.closest('.btn-detail');
        if (beliBtn) {
            const cardBody = beliBtn.closest('.card-body');
            const stokElement = cardBody.querySelector('.stok-text');
            if (!stokElement) return;

            let stok = parseInt(stokElement.innerText.replace('Stok: ', '')) || 0;
            if (stok > 0) {
                stok--;
                stokElement.innerText = 'Stok: ' + stok;
                const namaBarang = cardBody.querySelector('.card-title').innerText;
                alert('Berhasil membeli: ' + namaBarang);
                if (stok === 0) {
                    beliBtn.disabled = true;
                    beliBtn.innerText = 'Habis';
                }
            } else {
                alert('Stok habis!');
            }
        }
    });

    window.removeFromWishlist = function(idx) {
        wishlist.splice(idx, 1);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        updateWishlistCount();
        tampilkanWishlist();
    };

    window.hapusWishlist = function() {
        if (confirm('Apakah Anda yakin ingin mengosongkan wishlist?')) {
            wishlist = [];
            localStorage.removeItem('wishlist');
            updateWishlistCount();
            tampilkanWishlist();
        }
    };

    const myModalEl = document.getElementById('whislistModal');
    if (myModalEl) {
        myModalEl.addEventListener('show.bs.modal', function () {
            tampilkanWishlist();
        });
    }
});