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

function showCartPopup(cartIcon) {
    const parent = cartIcon.closest('.container-food');
    const popover = parent.querySelector('.successfully-added');

    if (popover) {
        // Show the popover with fade-in
        popover.style.display = 'flex'; // display it first
        requestAnimationFrame(() => {
            popover.classList.add('show'); // then fade it in
        });

        // Fade out after 3 seconds
        setTimeout(() => {
            popover.classList.remove('show'); // triggers opacity 0
            setTimeout(() => {
                popover.style.display = 'none'; // hide after fade-out
            }, 500); // match transition duration
        }, 800);
    }
}