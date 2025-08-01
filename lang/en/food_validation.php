<?php

return [
    'name.required'     => 'The food name is required.',
    'name.max'          => 'The food name may not be greater than 255 characters.',
    'category_id.required' => 'The category is required.',
    'category_id.exists'   => 'The selected category is invalid.',
    'description.required' => 'The description is required.',
    'exp_date.required' => 'The expiration date is required.',
    'exp_date.after_or_equal' => 'The expiration date cannot be a past date.',
    'exp_time.required' => 'The expiration time is required.',
    'exp_time.date_format'  => 'The time format must be H:i (e.g., 14:30).',
    'image_url.mimes'   => 'The image must be a file of type: png, jpg, jpeg.',
    'image_url.max'     => 'The image size cannot be larger than 2MB.',
    'stock.required'    => 'Stock is required.',
    'stock.integer'     => 'Stock must be an integer.',
    'stock.min'         => 'Stock must be at least 0.',
    'price.required'    => 'Price is required.',
    'price.integer'     => 'Price must be an integer.',
    'price.min'         => 'Price must be at least 0.',
];