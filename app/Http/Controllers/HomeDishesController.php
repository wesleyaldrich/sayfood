<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeDishesController extends Controller
{
    public function show(): View
    {
        // Sample product data (you would typically fetch this from a database)
        $products = [
            [
                'id' => 1, 'title' => 'Nyonya Laksa Delight', 'description' => 'Authentic, Rich Broth, Spicy Kick',
                'image' => 'https://placehold.co/400x180/FCE7F3/831843?text=Nyonya+Laksa', 'url' => '#', 'rating' => '4.9'
            ],
            [
                'id' => 2, 'title' => 'Classic Chicken Rice', 'description' => 'Savory, Tender Chicken, Fragrant Rice',
                'image' => 'https://placehold.co/400x180/E0E7FF/3730A3?text=Chicken+Rice', 'url' => '#', 'rating' => '4.7'
            ],
            [
                'id' => 3, 'title' => 'Spicy Beef Rendang', 'description' => 'Aromatic, Slow-cooked, Rich Coconut',
                'image' => 'https://placehold.co/400x180/FEF9C3/854D0E?text=Beef+Rendang', 'url' => '#', 'rating' => '4.8'
            ],
            [
                'id' => 4, 'title' => 'Sweet Kuih Lapis', 'description' => 'Layered, Colorful, Traditional Dessert',
                'image' => 'https://placehold.co/400x180/D1FAE5/057A55?text=Kuih+Lapis', 'url' => '#', 'rating' => '4.5'
            ],
            [
                'id' => 5, 'title' => 'Ikan Bakar Special', 'description' => 'Grilled Fish, Sambal Sauce, Banana Leaf',
                'image' => 'https://placehold.co/400x180/FFF7ED/C2410C?text=Ikan+Bakar', 'url' => '#', 'rating' => '4.6'
            ],
            [
                'id' => 6, 'title' => 'Cendol Cooler', 'description' => 'Shaved Ice, Coconut Milk, Palm Sugar',
                'image' => 'https://placehold.co/400x180/E0F2FE/0891B2?text=Cendol', 'url' => '#', 'rating' => '4.9'
            ],
            [
                'id' => 7, 'title' => 'Otak-Otak Fusion', 'description' => 'Spiced Fish Paste, Grilled, Aromatic',
                'image' => 'https://placehold.co/400x180/FAF5FF/7E22CE?text=Otak-Otak', 'url' => '#', 'rating' => '4.4'
            ],
            [
                'id' => 8, 'title' => 'Durian Pengat Bliss', 'description' => 'Creamy Durian, Sweet Porridge, Dessert',
                'image' => 'https://placehold.co/400x180/F0FDFA/0F766E?text=Durian+Pengat', 'url' => '#', 'rating' => '4.7'
            ]
        ];

        $allProducts = count($products) > 0 ? array_merge($products, $products, $products) : [];
        $originalProductsCount = count($products);

        return view('home', compact('allProducts', 'products', 'originalProductsCount'));
    }
}