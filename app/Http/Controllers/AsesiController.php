<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\AsesiModel;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AsesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ItemModel::all();

        return view('pendaftaran.pendaftaran-asesi', [
            'dataItem' => $items
        ]);
    }
}
