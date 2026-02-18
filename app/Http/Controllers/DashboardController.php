<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsesiModel;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin-panel.dashboard.index');
    }
}
