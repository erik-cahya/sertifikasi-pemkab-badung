<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use App\Models\DepartemenModel;
use App\Models\JabatanModel;
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
        $departemen = DepartemenModel::all();
        $jabatan = JabatanModel::all();
        $lsp = LSPModel::all();

        return view('pendaftaran.pendaftaran-asesi', [
            'dataDepartemen' => $departemen,
            'dataJabatan' => $jabatan,
            'dataLsp' => $lsp,
        ]);
    }
}
