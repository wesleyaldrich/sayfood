<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = [
            (object)['id' => '12345678', 'name' => 'Upin Cucu Opah', 'email' => 'upin123@gmail.com', 'status' => 'Pending'],
            (object)['id' => '87654321', 'name' => 'Ipin Cucu Opah', 'email' => 'ipin123@gmail.com', 'status' => 'Resolved'],
        ];

        return view('report', compact('reports'));
    }
}
