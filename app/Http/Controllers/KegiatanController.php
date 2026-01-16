<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDetailModel;
use App\Models\KegiatanModel;
use App\Models\LSPModel;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataKegiatan'] = KegiatanModel::with([
            'details.lsp'
        ])->withSum(
            'details as total_kuota_lsp',
            'kuota_lsp'
        )->get();

        // dd($data['dataKegiatan']);

        return view('admin-panel.kegiatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataLSP'] = LSPModel::get();

        // Jika data kegiatan sudah dibuat, maka tidak ditampilkan lagi
        $data['dataKegiatan'] = KegiatanModel::select('ref', 'nama_kegiatan')->whereDoesntHave('details')->get();
        return view('admin-panel.kegiatan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'mulai_kegiatan' => 'required',
            'selesai_kegiatan' => 'required',
        ], [
            'nama_kegiatan.required' => 'Masukkan nama kegiatan',
            'mulai_kegiatan.required' => 'Silahkan pilih tanggal mulai',
            'selesai_kegiatan.required' => 'Silahkan pilih tanggal selesai',
        ])->validateWithBag('create_kegiatan');

        KegiatanModel::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'mulai_kegiatan' => $request->mulai_kegiatan,
            'selesai_kegiatan' => $request->selesai_kegiatan,
            'status' => 1,
            'created_by' => Auth::user()->ref,

        ]);

        return redirect()
            ->route('kegiatan.create')
            ->with('flashData', [
                'title' => 'Tambah Data Success',
                'message' => 'Kegiatan Baru Berhasil Ditambahkan',
                'type' => 'success',
            ]);





        dd($request->all());
        $range = $request->input('date_range')[0];
        // "01/13/2026 - 01/24/2026"

        // dd($range);

        [$start, $end] = explode(' - ', $range);

        $startDate = Carbon::createFromFormat('d F Y', trim($start));
        $endDate   = Carbon::createFromFormat('d F Y', trim($end));

        $days = $startDate->diffInDays($endDate) + 1;

        dd($days); // 11
        dd($request->all());
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
        //
    }
}
