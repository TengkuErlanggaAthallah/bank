<?php

namespace App\Http\Controllers;

use App\Models\Nasabah; // Import the Nasabah model
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the total number of Nasabah
        $totalNasabah = Nasabah::count();

        // Get the list of Nasabah
        $nasabahList = Nasabah::all(); // Fetch all nasabah data

        // Pass the total and the list to the view
        return view('dashboard', compact('totalNasabah', 'nasabahList'));
    }
}