<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $currentUser = Auth::user();

        // Validasi: user harus customer
        if (!$currentUser->customer) {
            return back()
                ->withErrors(['user' => 'Akun Anda tidak terdaftar sebagai customer.'])
                ->withInput();
        }

        // Validasi awal: restaurant_id harus valid
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        // Validasi khusus: salah satu harus diisi
        if (empty($request->description)) {
            return back()
                ->withErrors(['description' => 'Please select a reason or write a report.'])
                ->withInput();
        }

        // Simpan ke database
        Report::create([
            'restaurant_id' => $request->restaurant_id,
            'customer_id' => $currentUser->customer->id,
            'description' => $request->description,
        ]);

        return back()->with('report_success', 'Thank you! Your report has been submitted.   ');
    }
}
