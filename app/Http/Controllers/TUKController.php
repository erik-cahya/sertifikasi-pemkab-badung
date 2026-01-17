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

    public function list()
    {
        $tuk = TUKModel::join('lsp', 'lsp.ref', '=', 'tuk.lsp_ref')
        ->join('users', 'users.ref', '=', 'tuk.created_by')
        ->select('tuk.*','lsp.lsp_nama', 'users.name')
        ->orderBy('tuk.created_at', 'desc')
        ->get();

        return view('admin-panel.tuk.index', [
            'dataTUK' => $tuk,
        ]);
    }
}
