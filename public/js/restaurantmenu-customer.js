document.querySelectorAll('.menu-tab-bar .tab').forEach(tab => {
    tab.addEventListener('click', () => {
        const isActive = tab.classList.contains('active-tab');

        // Hapus semua active-tab class
        document.querySelectorAll('.menu-tab-bar .tab').forEach(t => t.classList.remove('active-tab'));

        if (isActive) {
            // Kalau tab diklik dua kali (sudah aktif), tampilkan semua kategori
            document.querySelectorAll('.menu-content').forEach(content => {
                content.classList.remove('d-none');
            });
        } else {
            // Kalau tab baru dipilih, aktifkan dan tampilkan sesuai kategori
            tab.classList.add('active-tab');
            const selectedCategory = tab.getAttribute('data-category');

            document.querySelectorAll('.menu-content').forEach(content => {
                content.classList.add('d-none');
            });

            const target = document.querySelector(`.menu-content[data-category="${selectedCategory}"]`);
            if (target) {
                target.classList.remove('d-none');
            }
        }
    });
});
