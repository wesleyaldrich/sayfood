<?php

return [
    'name.required'     => 'Nama makanan wajib diisi.',
    'name.max'          => 'Nama makanan tidak boleh lebih dari 255 karakter.',
    'category_id.required' => 'Kategori wajib dipilih.',
    'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
    'description.required' => 'Deskripsi wajib diisi.',
    'exp_date.required' => 'Tanggal kedaluwarsa wajib diisi.',
    'exp_date.after_or_equal' => 'Tanggal kedaluwarsa tidak boleh tanggal yang sudah lewat.',
    'exp_time.required' => 'Waktu kedaluwarsa wajib diisi.',
    'exp_time.date_format'  => 'Format waktu harus jam:menit (contoh: 14:30).',
    'image_url.mimes'   => 'File gambar harus berformat: png, jpg, jpeg.',
    'image_url.max'     => 'Ukuran gambar tidak boleh lebih dari 2MB.',
    'stock.required'    => 'Stok wajib diisi.',
    'stock.integer'     => 'Stok harus berupa angka.',
    'stock.min'         => 'Stok tidak boleh kurang dari 0.',
    'price.required'    => 'Harga wajib diisi.',
    'price.integer'     => 'Harga harus berupa angka.',
    'price.min'         => 'Harga tidak boleh kurang dari 0.',
];