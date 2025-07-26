<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('status', 'Pending');

        $reports = Report::query()->where('status', $query)->get();

        return view('report-resto-admin', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('report-resto-detail', compact('report'));
    }

    public function suspend(Report $report)
    {
        $report->update([
            'status' => 'Resolved'
        ]);

        $restaurant = $report->restaurant;
        $user = $restaurant->user;
        $restaurant->delete();
        $user->delete();

        return redirect()->route('show.manage.reports')->with('status', 'Successfully suspend reported restaurant!');
    }

    public function safe(Report $report)
    {
        $report->update([
            'status' => 'Resolved'
        ]);

        return redirect()->route('show.manage.reports')->with('status', 'Successfully mark report as safe!');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'restaurant_id' => 'required|exists:restaurants,id',
    //         'description' => 'required|string|max:1000',
    //     ]);

    //     // dd(auth()->user());
    //     Report::create([
    //         // 'customer_id' => auth()->id(),
    //         'restaurant_id' => $request->restaurant_id,
    //         'description' => $request->description,
    //         'status' => 'pending',
    //         'note' => null,
    //     ]);

    //     return redirect()->back()->with('success', 'Laporan telah dikirim.');
    // }
}