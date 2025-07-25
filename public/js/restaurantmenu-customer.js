document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.menu-tab-bar .tab');
    const contents = document.querySelectorAll('.menu-content');

    function showCategory(category) {
        contents.forEach(content => {
            if (content.getAttribute('data-category') === category) {
                content.classList.remove('d-none');
            } else {
                content.classList.add('d-none');
            }
        });
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Hapus active-tab dari semua tab
            tabs.forEach(t => t.classList.remove('active-tab'));

            // Set tab yang diklik jadi aktif
            tab.classList.add('active-tab');

            // Tampilkan hanya kategori yang sesuai
            const selectedCategory = tab.getAttribute('data-category');
            showCategory(selectedCategory);
        });
    });

    // **Default ke 'maincourse' saat halaman load**
    const defaultTab = document.querySelector('.menu-tab-bar .tab[data-category="maincourse"]');
    if (defaultTab) {
        tabs.forEach(t => t.classList.remove('active-tab'));
        defaultTab.classList.add('active-tab');
        showCategory('maincourse');
    }
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

document.addEventListener('DOMContentLoaded', function() {
    window.reportRestoPopup = function() {
        var myModal = new bootstrap.Modal(document.getElementById('reportRestoModal'));
        myModal.show();
    }
});

function closePopup() {
    var myModalEl = document.getElementById('reportRestoModal');
    var modal = bootstrap.Modal.getInstance(myModalEl);
    if (modal) {
        modal.hide();
    }
}
