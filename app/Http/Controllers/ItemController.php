<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ItemModel::join('users', 'users.ref', '=', 'item.created_by')
        ->select('item.*', 'users.name')
        ->get();

        return view('admin-panel.item.index', [
            'dataItem' => $query
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Function Create Skema
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_kategori' => 'required',
            'item_nama' => 'required',
        ], [
            'item_kategori.required' => 'Silahkan pilih kategori terlebih dahulu',
            'item_nama.required' => 'Silahkan isi nama item terlebih dahulu',
        ]);

        ItemModel::create([
            'item_kategori' => $request->item_kategori,
            'item_nama' => $request->item_nama,
            'created_by' => Auth::user()->ref,
        ]);

        $flashData = [
            'title' => 'Tambah Data Item Berhasii',
            'message' => 'Data Item Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('item.index')->with('flashData', $flashData);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
    
    }
}
