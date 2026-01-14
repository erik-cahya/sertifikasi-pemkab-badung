<?php

namespace App\Http\Controllers;

use App\Models\SkemaDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KodeUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function create_kode_unit(Request $request) {}

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
        $validator = Validator::make($request->all(), [
            'skema_ref'     => ['required', 'exists:skema,ref'],
            'judul_unit'    => ['required', 'array', 'min:1'],
            'judul_unit.*'  => ['required', 'string', 'max:255'],
            'kode_unit'     => ['required', 'array'],
            'kode_unit.*'   => ['required', 'string', 'max:100'],
        ], [
            'skema_ref.required'      => 'Silahkan pilih skema',
            'skema_ref.exists'        => 'Skema tidak valid',

            'judul_unit.required'     => 'Minimal 1 judul unit harus diisi',
            'judul_unit.*.required'   => 'Judul unit tidak boleh kosong',

            'kode_unit.required'      => 'Minimal 1 kode unit harus diisi',
            'kode_unit.*.required'    => 'Kode unit tidak boleh kosong',
        ]);
        $validator->validateWithBag('create_kode_unit');
        $validated = $validator->validated();

        DB::transaction(function () use ($validated) {
            foreach ($validated['judul_unit'] as $index => $judul) {
                SkemaDetailModel::create([
                    'skema_ref'  => $validated['skema_ref'],
                    'kode_unit'  => trim($validated['kode_unit'][$index]),
                    'judul_unit' => trim($judul),
                    'created_by' => Auth::user()->ref,
                ]);
            }
        });

        return redirect()
            ->back()
            ->with('active_tab', 'create_kode_unit')
            ->with('flashData', [
                'title' => 'Tambah Data Success',
                'message' => 'Kode Unit Baru Berhasil Ditambahkan',
                'type' => 'success',
            ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SkemaDetailModel::where('ref', $id)->delete();
        $flashData = [
            'judul' => 'Hapus Data Success',
            'pesan' => 'Kode Unit Berhasil Dihapus ',
            'type' => 'success',
        ];

        return response()->json($flashData);
    }
}
