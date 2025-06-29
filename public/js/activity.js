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

function agreeAndReturnToForm() {
        const termsModalEl = document.getElementById('termsAndConditionsModal');
        const proposeModalEl = document.getElementById('proposeEventModal');

        const termsModal = bootstrap.Modal.getInstance(termsModalEl);
        const proposeModal = bootstrap.Modal.getOrCreateInstance(proposeModalEl);

        // Step 1: Close terms modal
        termsModal.hide();

        // Step 2: Tunggu animasi modal hide selesai, baru show modal form
        termsModalEl.addEventListener('hidden.bs.modal', function handler() {
            // Step 3: Buka kembali modal form
            proposeModal.show();

            // Step 4: Tambahkan class modal-open ke body agar scroll aktif
            document.body.classList.add('modal-open');

            // Step 5: Unbind event listener agar tidak dipanggil berulang
            termsModalEl.removeEventListener('hidden.bs.modal', handler);
        });
    }