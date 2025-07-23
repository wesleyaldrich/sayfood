document.addEventListener('DOMContentLoaded', function () {
  const donationAmountValue = document.getElementById('donationAmountValue');
  const toggleButton = document.getElementById('toggleDonationVisibility');
  const visibilityIcon = document.getElementById('visibilityIcon');

  if (donationAmountValue && toggleButton && visibilityIcon) {
    console.log('Semua elemen yang diperlukan ditemukan.');

    function setDonationVisibility(isVisible) {
      if (isVisible) {
        donationAmountValue.style.filter = 'none';
        visibilityIcon.classList.remove('bi-eye-fill');
        visibilityIcon.classList.add('bi-eye-slash-fill');
      } else {
        donationAmountValue.style.filter = 'blur(5px)';
        visibilityIcon.classList.remove('bi-eye-slash-fill');
        visibilityIcon.classList.add('bi-eye-fill');
      }
      localStorage.setItem('hideDonationAmount', !isVisible);
    }

    const hideAmountFromStorage = localStorage.getItem('hideDonationAmount') === 'true';
    setDonationVisibility(!hideAmountFromStorage);

    toggleButton.addEventListener('click', function () {
      console.log('Tombol toggle diklik!');
      const currentVisibility = donationAmountValue.style.filter === 'none';
      setDonationVisibility(!currentVisibility);
    });
  } else {
    console.error('Satu atau lebih elemen untuk toggle donasi tidak ditemukan.');
  }
});

// function agreeAndReturnToForm() {
//   const termsModalEl = document.getElementById('termsAndConditionsModal');
//   const proposeModalEl = document.getElementById('proposeEventModal');

//   const termsModal = bootstrap.Modal.getInstance(termsModalEl);
//   const proposeModal = bootstrap.Modal.getOrCreateInstance(proposeModalEl);

//   // Step 1: Close terms modal
//   termsModal.hide();

//   // Step 2: Tunggu animasi modal hide selesai, baru show modal form
//   termsModalEl.addEventListener('hidden.bs.modal', function handler() {
//       // Step 3: Buka kembali modal form
//       proposeModal.show();

//       // Step 4: Tambahkan class modal-open ke body agar scroll aktif
//       document.body.classList.add('modal-open');

//       // Step 5: Unbind event listener agar tidak dipanggil berulang
//       termsModalEl.removeEventListener('hidden.bs.modal', handler);
//   });
// }

document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('agreeTermsCheckbox');
    const hCheck = document.getElementById('hiddenAgreeCheckbox');
    const checkTC = document.getElementById('checkTC');
    const backbutton = document.getElementById('backProposeEventModal');

    if (checkbox) {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                if (hCheck) hCheck.checked = true;
                if (checkTC) {
                    checkTC.classList.remove("d-none");
                    checkTC.classList.add("d-flex");
                }
                if (backbutton) backbutton.click();
            } else{
                hCheck.checked = false;
                if (checkTC) {
                    checkTC.classList.remove("d-flex");
                    checkTC.classList.add("d-none");
                }
                if (backbutton) backbutton.click();
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const modals = document.querySelectorAll('.modal');

    modals.forEach(function (modal) {
        const stars = modal.querySelectorAll('.star-icon');
        const input = modal.querySelector('.rating-input');

        // Reset state saat modal dibuka
        modal.addEventListener('show.bs.modal', function () {
            stars.forEach(star => {
                star.classList.remove('selected', 'hovered');
            });
            input.value = 0;
        });

        stars.forEach((star, index) => {
            // Saat klik bintang
            star.addEventListener('click', function () {
                const rating = index + 1;
                input.value = rating;
                stars.forEach((s, i) => {
                    s.classList.toggle('selected', i < rating);
                });
            });

            // Hover efek
            star.addEventListener('mouseover', function () {
                stars.forEach((s, i) => {
                    s.classList.toggle('hovered', i <= index);
                });
            });

            star.addEventListener('mouseout', function () {
                stars.forEach(s => s.classList.remove('hovered'));
            });
        });
    });
});