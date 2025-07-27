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


const expiredBtn = document.getElementById('expiredFoodBtn');
const textarea = document.getElementById('otherTextarea');
const descInput = document.getElementById('descriptionInput');

const modal = document.getElementById('reportModal');
modal.addEventListener('show.bs.modal', () => {
    expiredBtn.classList.remove('btn-secondary');
    expiredBtn.classList.add('btn-light');
    textarea.disabled = false;
    textarea.value = '';
    descInput.value = '';
});

  let isExpiredSelected = false;

    function chooseExpiredFood() {
        const btn = document.getElementById('expiredFoodBtn');
        const otherTextarea = document.getElementById('otherTextarea');
        const descInput = document.getElementById('descriptionInput');

        if (isExpiredSelected) {
            isExpiredSelected = false;
            btn.classList.remove('active', 'btn-secondary');
            btn.classList.add('btn-light', 'border');

            otherTextarea.disabled = false;
            descInput.value = '';
        } else {
            isExpiredSelected = true;
            btn.classList.remove('btn-light', 'border');
            btn.classList.add('active', 'btn-secondary');

            otherTextarea.value = '';
            otherTextarea.disabled = true;
            descInput.value = 'They sell expired foods';
        }
    }

    function chooseOther() {
        const btn = document.getElementById('expiredFoodBtn');
        const otherTextarea = document.getElementById('otherTextarea');
        const descInput = document.getElementById('descriptionInput');

        // Unselect tombol jika textarea diisi
        if (otherTextarea.value.trim() !== '') {
            isExpiredSelected = false;
            btn.classList.remove('active', 'btn-danger');
            btn.classList.add('btn-light', 'border');
            otherTextarea.disabled = false;
            descInput.value = otherTextarea.value;
        } else {
            descInput.value = '';
        }
    }