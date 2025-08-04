<?php

return [
    // --- Kunci untuk Halaman Beranda Restoran ---
    'home_page_title' => 'Halaman Beranda Restoran',
    'total_orders_today_title' => 'Total Pesanan Hari Ini',
    'orders_suffix' => 'Pesanan', // contoh: "5 Pesanan"
    'todays_income_title' => 'Pendapatan Hari Ini',
    'todays_most_purchased_title' => 'Terlaris Hari Ini',
    'order_list_heading' => 'DAFTAR PESANAN',
    'no_pending_orders' => 'Anda sudah selesai! Tidak ada pesanan tertunda!',
    'new_customer_ratings_heading' => 'RATING PELANGGAN BARU',
    'no_customer_ratings_yet' => 'Belum ada rating pelanggan.',
    'total_orders_this_week_heading' => 'TOTAL PESANAN MINGGU INI',
    'main_courses_category' => 'Hidangan Utama',
    'desserts_category' => 'Makanan Penutup',
    'snacks_category' => 'Camilan',
    'drinks_category' => 'Minuman',
    'transaction_report_button' => 'Laporan Transaksi',
    'unknown_customer' => 'Tidak Dikenal', // Untuk nama pelanggan jika tidak ditemukan
    'other_category' => 'Lain-lain', // Untuk kategori makanan jika tidak ditemukan

    'customer_role' => 'Pelanggan',
    'order_created_status_button' => 'Terima',
    'ready_to_pickup_status_button' => 'Diterima',
    'completed_status_button' => 'Selesai',

    // --- Kunci baru untuk Halaman Kelola Makanan Restoran ---
    'manage_food_title' => 'Halaman Kelola Makanan Restoran',
    'manage_food_heading' => 'AYO KELOLA MAKANANMU!',
    'food_list_subtitle' => 'Daftar makanan :restaurant_name', // :restaurant_name akan diganti dengan nama sebenarnya
    'search_food_placeholder' => 'Cari nama makanan...',
    'all_categories_filter' => 'Semua',
    'upload_csv_instruction_1' => 'Anda juga bisa mengunggah dalam format file CSV! Klik di sini',
    'upload_csv_import_button' => 'Impor',
    'table_header_no' => 'No',
    'table_header_image' => 'Gambar',
    'table_header_food_name' => 'Nama Makanan',
    'table_header_food_description' => 'Deskripsi Makanan',
    'table_header_food_price' => 'Harga',
    'table_header_expiration_time' => 'Waktu Kedaluwarsa',
    'table_header_category' => 'Kategori',
    'table_header_stock' => 'Stok',
    'table_header_status' => 'Status',
    'add_food_button' => '+ Tambah Makanan',
    'no_image_text' => 'Tidak Ada Gambar',
    'edit_button' => 'Edit',
    'delete_button' => 'Hapus',

    // Tambah Makanan Modal
    'add_food_modal_title' => 'Tambah Makanan',
    'add_food_name_label' => 'Nama Makanan',
    'add_food_image_label' => 'Gambar Makanan',
    'add_category_label' => 'Kategori',
    'add_category_placeholder' => 'Pilih kategori...',
    'add_food_description_label' => 'Deskripsi Makanan',
    'add_food_price_label' => 'Harga',
    'add_expiration_date_label' => 'Tanggal Kedaluwarsa',
    'add_expiration_time_label' => 'Waktu Kedaluwarsa',
    'add_stock_label' => 'Stok',
    'add_status_available' => 'Tersedia',
    'close_button' => 'Tutup',
    'submit_button' => 'Kirim',
    'status_stock' => 'Stok untuk ',
    'stock_success' => 'berhasil di perbarui!',

    // Edit Makanan Modal
    'edit_food_modal_title' => 'Edit Makanan',
    'edit_food_name_label' => 'Nama Makanan',
    'edit_food_image_label' => 'Gambar Makanan Baru (Opsional)',
    'edit_image_hint' => 'Biarkan kosong jika tidak ingin mengubah gambar.',
    'edit_category_label' => 'Kategori',
    'edit_category_placeholder' => 'Pilih kategori...',
    'edit_food_description_label' => 'Deskripsi Makanan',
    'edit_food_price_label' => 'Harga',
    'edit_expiration_date_label' => 'Tanggal Kedaluwarsa',
    'edit_expiration_time_label' => 'Waktu Kedaluwarsa',
    'edit_stock_label' => 'Stok',
    'edit_status_available' => 'Tersedia',
    'save_changes_button' => 'Simpan Perubahan',

    // Konfirmasi Hapus Modal
    'delete_confirm_modal_title' => 'Konfirmasi Hapus',
    'delete_confirm_message' => 'Anda yakin ingin menghapus item makanan ini: :food_name?',
    'delete_undo_warning' => 'Tindakan ini tidak dapat dibatalkan.',
    'cancel_button' => 'Batal',
    'yes_delete_button' => 'Ya, Hapus',

    // Unggah CSV Modal
    'upload_csv_modal_title' => 'Unggah File ZIP',
    'csv_instruction_heading' => 'Instruksi:',
    'csv_instruction_1' => '1. Unduh template CSV yang disediakan.',
    'csv_instruction_2' => '2. Isi data makanan Anda sesuai contoh, lalu simpan file.',
    'csv_instruction_3' => '3. Letakkan file CSV yang disimpan dan semua file gambar yang sesuai dalam satu folder.',
    'csv_instruction_4' => '4. Pastikan nama file gambar dalam folder sama persis dengan nama di kolom `image_url` pada CSV Anda.',
    'csv_instruction_5' => '5. `category_name` harus salah satu dari: Hidangan Utama, Makanan Penutup, Minuman, Camilan.',
    'csv_instruction_6' => '6. `exp_datetime` harus mengikuti format: YYYY-MM-DD HH:MM:SS (contoh: 2025-12-31 23:59:00).',
    'csv_instruction_7' => '7. Kompres seluruh folder menjadi satu file .zip.',
    'csv_instruction_8' => '8. Unggah file .zip di bawah.',
    'download_csv_template_button' => '📥 Unduh Template CSV',
    'choose_zip_file_label' => 'Pilih file .zip',
    'upload_and_proceed_button' => 'Unggah dan Lanjutkan',

    // --- Kunci baru untuk Halaman Pesanan Restoran ---
    'orders_page_title' => 'Halaman Pesanan',
    'manage_orders_heading' => 'AYO KELOLA PESANANMU!',
    'table_header_no' => 'No', // Menggunakan kembali jika sudah didefinisikan, jika tidak tambahkan
    'table_header_id' => 'ID', // Menggunakan kembali jika sudah didefinisikan, jika tidak tambahkan
    'table_header_customer_name' => 'Nama Pelanggan',
    'table_header_food_name' => 'Nama Makanan',
    'table_header_qty' => 'Jumlah',
    'table_header_notes' => 'Catatan',
    'table_header_order_date' => 'Tanggal Pesanan',
    'table_header_action' => 'Aksi',
    'order_created_button' => 'Terima',
    'ready_to_pickup_button' => 'Diterima',
    'order_completed_button' => 'Selesai',

    // --- Kunci baru untuk Halaman Aktivitas Restoran ---
    'activity_page_title' => 'Halaman Pesanan', // Menggunakan kembali judul untuk saat ini, bisa diubah menjadi 'Halaman Aktivitas' jika diinginkan
    'activity_heading' => 'AKTIVITAS',
    'all_ratings_filter' => 'Semua',
    'table_header_rating' => 'Rating',

    // --- Kunci baru untuk Halaman Laporan Transaksi Restoran ---
    'transaction_report_title' => 'Sayfood | Laporan Transaksi Restoran',
    'transaction_report_heading' => 'LAPORAN TRANSAKSI',
    'date_start_label' => 'Tanggal Mulai',
    'date_end_label' => 'Tanggal Akhir',
    'filter_button' => 'Filter',
    'download_report_button' => 'Unduh Laporan',
    'table_header_price' => 'Harga',
    'table_header_total_price' => 'Total Harga',
    'currency_prefix' => 'Rp',
    'currency_suffix' => ',00',

    // --- Kunci baru untuk Modal Laporan Restoran ---
    'report_restaurant_modal_title' => 'Laporkan Restoran',
    'report_restaurant_question' => 'Mengapa Anda ingin melaporkan restoran ini?',
    'reason_expired_foods' => 'Mereka menjual makanan kedaluwarsa',
    'reason_others_label' => 'Lainnya:',
    'reason_others_placeholder' => 'Tulis sesuatu...',
    'submit_report_button' => 'Kirim',
    'report_success_message' => 'Laporan berhasil dikirim!',
];