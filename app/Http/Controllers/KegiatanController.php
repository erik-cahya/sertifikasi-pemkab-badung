<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin-panel.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataLSP'] = LSPModel::get();
        return view('admin-panel.kegiatan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(Str::ulid());



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
