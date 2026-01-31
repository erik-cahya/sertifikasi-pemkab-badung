<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDetailModel;
use App\Models\KegiatanLSPModel;
use App\Models\KegiatanModel;
use App\Models\KegiatanSkemaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');

        $query = KegiatanModel::with([
            'kegiatanLsp:ref,kegiatan_ref,lsp_ref,kuota_lsp',
            'kegiatanLsp.lsp:ref,lsp_nama'
        ])->withSum('kegiatanLsp as total_kuota', 'kuota_lsp');

        if ($user->roles === 'lsp' && $user->lspData) {
            $query->whereHas('kegiatanLsp', function ($q) use ($user) {
                $q->where('lsp_ref', $user->lspData->ref);
            });
        }

        $data['dataKegiatan'] = $query->get();

        // dd($data['dataKegiatan']);
        return view('admin-panel.asesmen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
