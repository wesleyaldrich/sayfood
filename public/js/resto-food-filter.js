document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const foodRows = document.querySelectorAll('.tbody tr');

    // main function untuk filter category dan search func
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const activeCategoryButton = document.querySelector('.filter-btn.active');
        const selectedCategory = activeCategoryButton ? activeCategoryButton.getAttribute('data-category') : 'all';

        foodRows.forEach(row => {
            const foodName = row.querySelectorAll('td')[1].textContent.toLowerCase();
            const rowCategory = row.getAttribute('data-category');

            // cek kondisi kategori
            const categoryMatch = selectedCategory === 'all' || rowCategory === selectedCategory;
            
            // cek kondisi pencarian
            const searchMatch = foodName.includes(searchTerm);

            // if else tampilin kalo terpenuhi
            if (categoryMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // event listener untuk input pencarian
    searchInput.addEventListener('input', applyFilters);

    // Modifikasi event listener untuk tombol filter
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            applyFilters(); // call main function 
        });
    });

    // set state awal saat halaman dimuat
    const allButton = document.querySelector('.filter-btn[data-category="all"]');
    if (allButton) {
        allButton.classList.add('active');
    }
    applyFilters(); // apply main function saat halaman pertama dimuat
});