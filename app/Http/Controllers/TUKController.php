<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\TUKModel;
use App\Models\LSPModel;

class TUKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lsp = LSPModel::all();

        return view('pendaftaran.pendaftaran-tuk', [
            'dataLsp' => $lsp
        ]);
    }
}
