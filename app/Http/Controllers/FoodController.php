<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popular     = Food::with('restaurant')->inRandomOrder()->take(10)->get();
        $mainCourses = Food::with('restaurant')->where('category_id', 1)->get();
        $desserts    = Food::with('restaurant')->where('category_id', 2)->get();
        $snacks      = Food::with('restaurant')->where('category_id', 3)->get();
        $drinks      = Food::with('restaurant')->where('category_id', 4)->get();

        return view('foods', compact('popular', 'mainCourses', 'desserts', 'snacks', 'drinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
