<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDetailModel;
use App\Models\KegiatanSkemaModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KegiatanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        DB::transaction(function () use ($request) {

            Validator::make($request->all(), [
                'kegiatan_ref' => 'required',
            ], [
                'kegiatan_ref.required' => 'Silahkan pilih kegiatan',
            ])->validateWithBag('create_detail_kegiatan');

            foreach ($request->lsp_ref as $i => $lspRef) {


                if (!$lspRef) continue;

                $lsp    = $request->lsp_ref[$i];
                $skemas = $request->skema_ref[$i] ?? [];
                $kuota  = (int) ($request->kuota_lsp[$i] ?? 0);
                $range  = $request->date_range[$i] ?? null;

                // Jika skema kosong, kuota 0, atau date range kosong, skip/lewati
                if (!$skemas || !$kuota || !$range) continue;

                foreach ($skemas as $i => $skema) {

                    KegiatanSkemaModel::create([
                        'kegiatan_ref' => $request->kegiatan_ref,
                        'skema_ref'    => $skema,
                        'created_by'   => Auth::user()->ref,
                    ]);
                }


                [$start, $end] = array_map('trim', explode(' - ', $range));
                $startDate = Carbon::createFromFormat('d-m-Y', $start);
                $endDate   = Carbon::createFromFormat('d-m-Y', $end);

                $dates = collect(CarbonPeriod::create($startDate, $endDate));
                $totalDays = $dates->count();

                $baseQuota = intdiv($kuota, $totalDays);
                $remainder = $kuota % $totalDays;

                foreach ($dates as $index => $date) {

                    $quotaForDay = $baseQuota + ($index < $remainder ? 1 : 0);

                    // dd($quotaForDay);
                    KegiatanDetailModel::create([
                        'kegiatan_ref'    => $request->kegiatan_ref,
                        'lsp_ref'         => $lsp,
                        'kuota_lsp'       => $quotaForDay,
                        'mulai_asesmen'   => $date instanceof Carbon ? $date->format('Y-m-d') : (string) $date,
                        'selesai_asesmen' => $endDate->format('Y-m-d'),
                        'created_by'      => Auth::user()->ref,
                    ]);
                }
            }
        });
        $flashData = [
            'title' => 'Tambah Data Success',
            'message' => 'Kegiatan Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('kegiatan.index')->with('flashData', $flashData);
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
