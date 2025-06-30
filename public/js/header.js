document.addEventListener('DOMContentLoaded', function () {
    const hamburgerIcon = document.querySelector('.icon-hamburger');
    const dropdownNav = document.querySelector('header .dropdown-nav');
    const languageIcon = document.querySelector('.icon-language');
    const dropdownLanguage = document.querySelector('header .dropdown-language');

    // Toggle hamburger menu
    hamburgerIcon.addEventListener('click', function () {
        dropdownNav.classList.toggle('show');
    });

    // Toggle language dropdown
    languageIcon.addEventListener('click', function () {
        dropdownLanguage.classList.toggle('show');
    });

    // Close both dropdowns if clicked outside
    document.addEventListener('click', function (e) {
        const isClickInsideNav = dropdownNav.contains(e.target) || hamburgerIcon.contains(e.target);
        const isClickInsideLang = dropdownLanguage.contains(e.target) || languageIcon.contains(e.target);

        if (!isClickInsideNav) {
            dropdownNav.classList.remove('show');
        }

        if (!isClickInsideLang) {
            dropdownLanguage.classList.remove('show');
        }
    });
});


const openBtn = document.getElementById('openOffcanvasNotif');
const offcanvas = document.getElementById('notifOffcanvas');
const closeBtn = document.getElementById('closeOffcanvas');
const overlay = document.getElementById('offcanvasOverlay');

openBtn.addEventListener('click', function (e) {
    e.preventDefault();
    offcanvas.classList.add('active');
    overlay.classList.add('active');
});

function closeOffcanvas() {
    offcanvas.classList.remove('active');
    overlay.classList.remove('active');
}

closeBtn.addEventListener('click', closeOffcanvas);

// Close on overlay click
overlay.addEventListener('click', closeOffcanvas);

// Optional: Close if clicking anywhere outside
document.addEventListener('click', function (event) {
    const isClickInsideOffcanvas = offcanvas.contains(event.target);
    const isClickOnTrigger = openBtn.contains(event.target);

    if (!isClickInsideOffcanvas && !isClickOnTrigger && offcanvas.classList.contains('active')) {
    closeOffcanvas();
    }
});

