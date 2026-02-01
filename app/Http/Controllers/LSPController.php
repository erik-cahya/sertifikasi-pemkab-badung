<?php

namespace App\Http\Controllers;

use App\Models\LSPModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LSPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['dataLSP'] = LSPModel::select(
            'lsp.ref',
            'lsp.lsp_nama',
            'lsp.lsp_no_lisensi',
            'lsp.lsp_email',
            'lsp.lsp_telp',

            'users.is_active',
            'users.username',
        )->withCount('skemas', 'tuk')
            ->join('users', 'users.ref', '=', 'lsp.user_ref')
            ->get();

        // dd($data['dataLSP']);

        return view('admin-panel.lsp.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-panel.lsp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->hasFile('lsp_logo'), $request->file('lsp_logo'));


        $validated = $request->validate([
            'lsp_nama' => 'required',
            'lsp_no_lisensi' => 'required',
            // 'lsp_email' => 'required',
            // 'lsp_alamat' => 'required',
            // 'lsp_telp' => 'required',
            // 'lsp_direktur' => 'required',
            // 'lsp_direktur_telp' => 'required',
            'lsp_tanggal_lisensi' => 'required',
            'lsp_expired_lisensi' => 'required',

            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',

            // FILE VALIDATION
            'lsp_logo' => 'nullable|mimes:png|max:2048',
        ], [
            'lsp_nama.required' => 'Silahkan inputkan nama LSP',
            'lsp_logo.max'   => 'Logo maksimal 2 MB',
            'lsp_logo.mimes' => 'Format logo harus PNG',
        ]);

        // ================== SIMPAN FILE ==================
        $lsp_nama  = Str::slug($request->lsp_nama);
        $lsp_no_lisensi  = $request->lsp_no_lisensi;
        $lsp_logo = null;

        /* ================== LOGO LSP ================== */
        if ($request->hasFile('lsp_logo')) {
            $ext = $request->file('lsp_logo')->extension();
            $filename = "{$lsp_nama}-{$lsp_no_lisensi}.{$ext}";
            $lsp_logo = Storage::disk('logo-lsp')->putFileAs("logo-lsp", $request->file('lsp_logo'), $filename);

            //  $lsp_logo = $request->file('lsp_logo')
            // ->storeAs("LSP/{$request->lsp_nama}", $filename, 'public');

        }

        $userCreated = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'roles' => strtolower(trim('lsp')),
            'is_active' => 1
        ]);

        LSPModel::create([
            'user_ref' => $userCreated->ref,
            'lsp_nama' => trim($request->lsp_nama),
            'lsp_no_lisensi' => $request->lsp_no_lisensi,
            'lsp_alamat' => $request->lsp_alamat,
            'lsp_email' => $request->lsp_email,
            'lsp_telp' => $request->lsp_telp,
            'lsp_direktur' => $request->lsp_direktur,
            'lsp_direktur_telp' => $request->lsp_direktur_telp,
            'lsp_logo' => $lsp_logo,
            'lsp_tanggal_lisensi' => $request->lsp_tanggal_lisensi,
            'lsp_expired_lisensi' => $request->lsp_expired_lisensi,
            'created_by' => Auth::user()->ref,

        ]);

        $flashData = [
            'title' => 'Tambah Data Success',
            'message' => 'Data LSP Berhasil Ditambahkan',
            'type' => 'success',
        ];
        return redirect()->route('lsp.index')->with('flashData', $flashData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataLSP'] = LSPModel::where('ref', $id)->with('user')->with([
            'skemas' => function ($q) {
                $q->withCount('kodeUnits');
            }
        ])
            ->firstOrFail();

        // dd($data['dataLSP']);

        return view('admin-panel.lsp.show', $data);
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
        // dd($request->all());

        Validator::make($request->all(), [
            'lsp_nama' => 'required|unique:lsp,lsp_nama,' . $id . ',ref',
            'lsp_no_lisensi' => 'required|unique:lsp,lsp_no_lisensi,' . $id . ',ref',
            'lsp_email' => 'required|unique:lsp,lsp_email,' . $id . ',ref',
        ])->validateWithBag('update_lsp');

        LSPModel::where('ref', $id)->update([
            'lsp_nama' => $request->lsp_nama,
            'lsp_no_lisensi' => $request->lsp_no_lisensi,
            'lsp_alamat' => $request->lsp_alamat,
            'lsp_telp' => $request->lsp_telp,
            'lsp_email' => $request->lsp_email,
            'lsp_telp' => $request->lsp_telp,
            'lsp_direktur' => $request->lsp_direktur,
            'lsp_direktur_telp' => $request->lsp_direktur_telp,
            'lsp_tanggal_lisensi' => $request->lsp_tanggal_lisensi,
            'lsp_expired_lisensi' => $request->lsp_expired_lisensi,
        ]);

        $flashData = [
            'title' => 'Edit Success',
            'message' => 'Data LSP berhasil diubah',
            'type' => 'success',
        ];;
        return redirect()->route('lsp.show', $id)->with('flashData', $flashData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // LSPModel::where('ref', $id)->delete();

        $lsp = LSPModel::where('ref', $id)->firstOrFail();
        $lsp->delete();
        return response()->json([
            'judul' => 'Hapus Data Success',
            'pesan' => 'Data LSP Berhasil Dihapus',
            'type'  => 'success',
        ], 200);
    }

    public function changePassword(Request $request, $id)
    {

        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $lsp = LSPModel::with('user')
            ->where('ref', $id)
            ->firstOrFail();

        $user = $lsp->user;

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // 🔥 FORCE LOGOUT: hapus semua session user ini
        DB::table('sessions')
            ->where('user_id', $user->id) // atau ref, tergantung auth
            ->delete();

        $flashData = [
            'title' => 'Edit Success',
            'message' => 'Password LSP berhasil diubah',
            'type' => 'success',
        ];;
        return redirect()->route('lsp.show', $id)->with('flashData', $flashData);
    }
}
