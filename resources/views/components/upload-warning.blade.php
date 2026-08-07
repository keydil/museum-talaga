{{--
    Peringatan penyimpanan file tidak permanen.

    Situs ini di-hosting di Render dengan filesystem yang bersifat ephemeral:
    file yang diunggah lewat panel admin disimpan di disk lokal container, dan
    container itu dibuat ulang setiap kali ada deploy ATAU restart (di paket
    gratis, termasuk saat layanan spin-up lagi setelah idle). Akibatnya file
    hasil unggahan hilang, sementara baris datanya tetap ada di database —
    jadi gambarnya jadi rusak/kosong.

    Data teks (judul, deskripsi, dsb.) AMAN — yang tidak awet hanya berkasnya.

    Solusi permanennya: mengarahkan penyimpanan ke object storage (mis.
    Cloudflare R2, yang sudah dipakai aplikasi Arsip untuk model 3D). Belum
    dikerjakan karena sampai sekarang seluruh konten situs memakai gambar yang
    ikut di dalam repositori (public/images/), jadi belum ada yang terdampak.

    Sampai itu dikerjakan: untuk gambar yang harus permanen, taruh filenya di
    public/images/ lewat git, lalu isi kolom fotonya dengan path relatif
    seperti "images/artefak/nama-file.jpg" (bukan lewat tombol unggah).
--}}
<div class="mb-6 p-4 bg-orange-50 border-l-4 border-orange-400 rounded-xl">
    <h2 class="text-sm font-bold text-orange-900 mb-1">Catatan: berkas unggahan belum permanen</h2>
    <p class="text-xs text-stone-600 leading-relaxed">
        Gambar/berkas yang diunggah lewat tombol unggah di halaman ini
        <strong class="text-stone-800">bisa hilang saat sistem diperbarui atau di-restart</strong>
        (keterbatasan hosting saat ini). Teksnya tetap aman — hanya berkasnya yang tidak awet.
        Untuk gambar yang harus permanen, hubungi pengembang agar filenya dipasang langsung ke dalam kode.
    </p>
</div>
