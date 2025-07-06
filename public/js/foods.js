const slider = document.querySelector('.foreach-today');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2; // scroll-fast multiplier
    slider.scrollLeft = scrollLeft - walk;
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


function updateRangeLabel(inputId, labelId, unitSuffix = '', multiplier = 1, formatter = val => val) {
    const rangeInput = document.getElementById(inputId);
    const rangeLabel = document.getElementById(labelId);

    const min = parseFloat(rangeInput.min);
    const max = parseFloat(rangeInput.max);
    const val = parseFloat(rangeInput.value);

    // Update label text
    rangeLabel.textContent = formatter(val * multiplier) + unitSuffix;

    // Position the label
    const percent = (val - min) / (max - min);
    const trackWidth = rangeInput.offsetWidth;
    const labelOffset = percent * trackWidth;

    rangeLabel.style.left = `${labelOffset}px`;
}

function initRangeLabel(inputId, labelId, unitSuffix, multiplier, formatter) {
    const input = document.getElementById(inputId);
    input.addEventListener('input', () =>
        updateRangeLabel(inputId, labelId, unitSuffix, multiplier, formatter)
    );
    updateRangeLabel(inputId, labelId, unitSuffix, multiplier, formatter);
}

window.addEventListener('load', () => {
    initRangeLabel('priceRange', 'priceLabel', 'K', 1/1000, val => 'IDR ' + val.toFixed(0));
    initRangeLabel('ratingRange', 'ratingLabel', '★', 1, val => val.toFixed(1));
});


document.addEventListener('DOMContentLoaded', () => {
    const filterBtn = document.getElementById('filterBtn');
    const filterDropdown = document.getElementById('filterDropdown');
    const applyBtn = document.getElementById('applyFilter');

    // Toggle dropdown visibility on filter icon click
    filterBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // prevent click bubbling to document
        filterDropdown.classList.toggle('show');
        initRangeLabel('priceRange', 'priceLabel', 'K', 1/1000, val => 'IDR ' + val.toFixed(0));
        initRangeLabel('ratingRange', 'ratingLabel', '★', 1, val => val.toFixed(1));
    });

    // Clicking APPLY button
    applyBtn.addEventListener('click', () => {
        const priceVal = document.getElementById('priceRange').value;
        const ratingVal = document.getElementById('ratingRange').value;

        console.log('Price:', priceVal);
        console.log('Rating:', ratingVal);

        filterDropdown.classList.remove('show');
    });

    // Close dropdown if clicking outside
    document.addEventListener('click', (e) => {
        if (!filterDropdown.contains(e.target) && e.target !== filterBtn) {
        filterDropdown.classList.remove('show');
        }
    });
});

const btnNearby = document.getElementById('btnNearby');

btnNearby.addEventListener('click', () => {
    btnNearby.classList.toggle('active');
});

const btnMostPopular = document.getElementById('btnMostPopular');

btnMostPopular.addEventListener('click', () => {
    btnMostPopular.classList.toggle('active');
});

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('moreModal');
    const allSections = document.querySelectorAll('.category-section');
    const titleElement = document.getElementById('moreModalLabel');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const category = button.getAttribute('data-category');

        // Hide all
        allSections.forEach(section => section.classList.add('d-none'));

        // Show selected
        const selectedSection = document.getElementById(category + 'Section');
        if (selectedSection) {
            selectedSection.classList.remove('d-none');
        }

        // Update modal title
        titleElement.textContent = category.replace(/([A-Z])/g, ' $1').toUpperCase();
    });
});