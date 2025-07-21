const track = document.getElementById('carouselTrack');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const sliderBar = document.getElementById('sliderTrack');
const sliderThumb = document.getElementById('sliderThumb');

const cardWidth = 220;

function updateSlider() {
    const scrollMax = track.scrollWidth - track.clientWidth;
    const scrollLeft = track.scrollLeft;

    const percent = scrollMax > 0 ? scrollLeft / scrollMax : 0;
    const barWidth = sliderBar.offsetWidth;
    const thumbWidth = sliderThumb.offsetWidth;
    const maxThumbLeft = barWidth - thumbWidth;
    const thumbLeft = percent * maxThumbLeft;

    sliderThumb.style.left = `${thumbLeft}px`;

    // Jika scroll sudah di ujung, reset ke awal (manual)
    if (scrollLeft >= scrollMax - 1) {
        setTimeout(() => {
            track.scrollTo({ left: 0, behavior: 'smooth' });
        }, 500);
    }
}

// Scroll otomatis + kembali ke awal
function autoScroll() {
    const scrollMax = track.scrollWidth - track.clientWidth;
    const atEnd = Math.ceil(track.scrollLeft + 1) >= scrollMax;

    if (atEnd) {
        track.scrollTo({ left: 0, behavior: 'auto' });
        updateSlider();
        setTimeout(() => {
            track.scrollBy({ left: cardWidth, behavior: 'smooth' });
            setTimeout(updateSlider, 400);
        }, 200);
    } else {
        track.scrollBy({ left: cardWidth, behavior: 'smooth' });
        setTimeout(updateSlider, 400);
    }
}

// Event listeners
window.addEventListener('load', () => {
    updateSlider();
    setTimeout(() => {
        autoScroll();
        setInterval(autoScroll, 7000);
    }, 1000);
});

prevBtn?.addEventListener('click', () => {
    track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    setTimeout(updateSlider, 400);
});

nextBtn?.addEventListener('click', () => {
    track.scrollBy({ left: cardWidth, behavior: 'smooth' });
    setTimeout(updateSlider, 400);
});

track.addEventListener('scroll', () => requestAnimationFrame(updateSlider));

// Drag to scroll
let isDragging = false;
let startX, scrollStart;

track.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.pageX - track.offsetLeft;
    scrollStart = track.scrollLeft;
    track.style.cursor = 'grabbing';
});

document.addEventListener('mouseup', () => {
    isDragging = false;
    track.style.cursor = 'grab';
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - track.offsetLeft;
    const walk = (x - startX) * 1.5;
    track.scrollLeft = scrollStart - walk;
    updateSlider();
});

// Drag thumb
let draggingThumb = false;

sliderThumb.addEventListener('mousedown', (e) => {
    draggingThumb = true;
    e.stopPropagation();
});

document.addEventListener('mouseup', () => {
    draggingThumb = false;
});

document.addEventListener('mousemove', (e) => {
    if (!draggingThumb) return;
    const barRect = sliderBar.getBoundingClientRect();
    const x = e.clientX - barRect.left;
    const percent = Math.max(0, Math.min(1, x / barRect.width));
    track.scrollLeft = (track.scrollWidth - track.clientWidth) * percent;
    updateSlider();
});


document.addEventListener('DOMContentLoaded', function () {
    const slidesContainer = document.getElementById('slides');
    const prevBtn = document.getElementById('prevBtn_shamo');
    const nextBtn = document.getElementById('nextBtn_shamo');
    const indicatorsContainer = document.getElementById('indicators');
    const slideElements = document.querySelectorAll('.share_moment-slide');
    const indicatorElements = document.querySelectorAll('.share_moment-indicator');

    let currentIndex = 0;
    const slideCount = slideElements.length;

    if (slideCount === 0) {
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
        if (indicatorsContainer) indicatorsContainer.style.display = 'none';
        const navButtonsContainer = document.querySelector('.share_moment-nav-buttons-container');
        if (navButtonsContainer) navButtonsContainer.style.display = 'none';
        return;
    }

    function updateCarousel() {
        slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

        indicatorElements.forEach((indicator, index) => {
            if (index === currentIndex) {
                indicator.classList.add('share_moment-active');
            } else {
                indicator.classList.remove('share_moment-active');
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            currentIndex = (currentIndex + 1) % slideCount;
            updateCarousel();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            currentIndex = (currentIndex - 1 + slideCount) % slideCount;
            updateCarousel();
        });
    }

    indicatorElements.forEach(indicator => {
        indicator.addEventListener('click', function () {
            currentIndex = parseInt(this.getAttribute('data-index'));
            updateCarousel();
        });
    });

    let autoAdvanceInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % slideCount;
        updateCarousel();
    }, 5000);

    const carouselContainer = document.querySelector('.share_moment-carousel-container');
    if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(autoAdvanceInterval);
        });
        carouselContainer.addEventListener('mouseleave', () => {
            autoAdvanceInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % slideCount;
                updateCarousel();
            }, 5000);
        });
    }
    if (slideCount > 0) {
        updateCarousel();
    }
});

const eventCards = document.querySelectorAll('.event-card');
const joinFormModal = document.getElementById('joinFormModal');
const closeModal = document.getElementById('closeModal');
const joinForm = document.getElementById('joinForm');
const phoneInput = document.getElementById('phoneNumber');
const phoneError = document.getElementById('phoneError');

// Modal Title Elements
const modalEventTitle = document.getElementById('modalEventTitle');
const modalEventHost = document.getElementById('modalEventHost');
const modalEventLocation = document.getElementById('modalEventLocation');

// Show modal with correct event data when card is clicked
eventCards.forEach(card => {
    card.addEventListener('click', () => {
        // Get event data from data attributes
        const title = card.dataset.eventTitle;
        const host = card.dataset.eventHost;
        const location = card.dataset.eventLocation;

        // Update modal content
        modalEventTitle.textContent = title;
        // modalEventHost.textContent = host;
        // modalEventLocation.textContent = `Location: ${location}`;

        // Show modal
        joinFormModal.style.display = 'flex';

    });
});

// Close modal when X is clicked
closeModal.addEventListener('click', () => {
    joinFormModal.style.display = 'none';
    document.body.classList.remove('modal-open');
});

// Close modal when clicking outside
joinFormModal.addEventListener('click', (e) => {
    if (e.target === joinFormModal) {
        joinFormModal.style.display = 'none';
        document.body.classList.remove('modal-open');
    }
});

// Phone number validation
phoneInput.addEventListener('input', function (e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length < 10 || this.value.length > 15) {
        phoneError.style.display = 'block';
        this.classList.add('error');
    } else {
        phoneError.style.display = 'none';
        this.classList.remove('error');
    }
});

joinForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // Validate phone number again on submit
    const phoneNumber = phoneInput.value;
    if (phoneNumber.length < 10 || phoneNumber.length > 15 || !/^[0-9]+$/.test(phoneNumber)) {
        phoneError.style.display = 'block';
        phoneInput.classList.add('error');
        phoneInput.focus();
        return;
    }

    // Get other form values
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const age = document.getElementById('age').value;
    const address = document.getElementById('address').value;

    // Here you would typically send this data to a server
    console.log('Form submitted:', {
        firstName,
        lastName,
        phoneNumber,
        age,
        address
    });

    // Show success message
    alert('Thank you for registering! We look forward to seeing you at the event.');

    // Close modal and reset form
    joinFormModal.style.display = 'none';
    document.body.classList.remove('modal-open');
    joinForm.reset();
});

function truncateResponsively(selector, breakpoints) {
    const elements = document.querySelectorAll(selector);
    const isMobile = window.matchMedia("(max-width: 390px)").matches;
    const { max, cut } = isMobile ? breakpoints.mobile : breakpoints.default;

    elements.forEach((element) => {
        if (!element.textContent) return;
        const text = element.textContent.trim();
        if (text.length > max) {
            const truncated = text.substring(0, cut) + "...";
            element.innerHTML = truncated; // Preserves HTML if present
        }
    });
}

// Run on page load and resize
document.addEventListener("DOMContentLoaded", () => {
    truncateResponsively(".title_font_os", {
        default: { max: 13, cut: 12 },  // Desktop/larger screens
        mobile: { max: 10, cut: 9 }     // Screens ≤390px
    });

    truncateResponsively(".host_font_os", {
        default: { max: 19, cut: 18 },
        mobile: { max: 15, cut: 14 }
    });

    truncateResponsively(".location_font", {
        default: { max: 10, cut: 7 },
        mobile: { max: 9, cut: 6 }
    });

    truncateResponsively(".date_font", {
        default: { max: 10, cut: 7 },
        mobile: { max: 9, cut: 7 }
    });
});

// Re-check on window resize
window.addEventListener("resize", () => {
    truncateResponsively(".title_font_os", {
        default: { max: 13, cut: 12 },
        mobile: { max: 10, cut: 9 }
    });

    truncateResponsively(".host_font_os", {
        default: { max: 19, cut: 18 },
        mobile: { max: 15, cut: 14 }
    });

    truncateResponsively(".location_font", {
        default: { max: 10, cut: 7 },
        mobile: { max: 9, cut: 6 }
    });

    truncateResponsively(".date_font", {
        default: { max: 10, cut: 7 },
        mobile: { max: 9, cut: 6 }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.share_moments-wrapper .carousel-item');
    const dots = document.querySelectorAll('.share_moments-wrapper .carousel-dots span');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            dots[i].classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    // Attach functions globally so HTML can use them
    window.nextSlide = function () {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    };

    window.prevSlide = function () {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    };

    window.setSlide = function (index) {
        showSlide(index);
    };

    window.toggleText = function (index) {
        const textContainer = document.getElementById(`text-${index}`);
        textContainer.classList.toggle('expanded');
        const button = textContainer.querySelector('.see-more');
        button.textContent = textContainer.classList.contains('expanded') ? 'See Less' : 'See More';
    };

    // Initialize the first slide
    showSlide(currentSlide);
});
