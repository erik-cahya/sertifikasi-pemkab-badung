<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TUKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pendaftaran.pendaftaran-tuk');
    }
}
