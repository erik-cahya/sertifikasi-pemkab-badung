<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\LSPModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->loadMissing('lspData');
        $query = LSPModel::with('user');

        if ($user->roles === 'lsp' && $user->lspData) {
            $query->where('user_ref', $user->ref);
        }

        $data['dataLSP'] = $query->firstOrFail();

        return view('admin-panel.profile.index', $data);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'lsp_nama' => 'required|unique:lsp,lsp_nama,' . $id . ',ref',
            'lsp_no_lisensi' => 'required|unique:lsp,lsp_no_lisensi,' . $id . ',ref',
            'lsp_email' => 'required|unique:lsp,lsp_email,' . $id . ',ref',
            'lsp_logo' => 'nullable|mimes:png|max:2048',

        ])->validateWithBag('update_lsp');

        $lsp = LSPModel::where('ref', $id)->firstOrFail();

        /* ================== UPDATE LOGO ================== */
        if ($request->hasFile('lsp_logo')) {

            // DELETE LOGO LAMA
            if ($lsp->lsp_logo && Storage::disk('logo-lsp')->exists($lsp->lsp_logo)) {
                Storage::disk('logo-lsp')->delete($lsp->lsp_logo);
            }

            $lsp_nama = Str::slug($request->lsp_nama);
            $ext = $request->file('lsp_logo')->extension();
            $filename = Str::uuid() . ".{$ext}";
            $lsp_logo = Storage::disk('logo-lsp')->putFileAs('logo-lsp', $request->file('lsp_logo'), $filename);
        } else {
            $lsp_logo = $lsp->lsp_logo; // kalau ga upload baru
        }

        LSPModel::where('ref', $id)->update([
            'lsp_nama' => $request->lsp_nama,
            'lsp_no_lisensi' => $request->lsp_no_lisensi,
            'lsp_alamat' => $request->lsp_alamat,
            'lsp_telp' => $request->lsp_telp,
            'lsp_email' => $request->lsp_email,
            'lsp_telp' => $request->lsp_telp,
            'lsp_direktur' => $request->lsp_direktur,
            'lsp_direktur_telp' => $request->lsp_direktur_telp,
            // 'lsp_tanggal_lisensi' => $request->lsp_tanggal_lisensi,
            'lsp_expired_lisensi' => $request->lsp_expired_lisensi,
            'lsp_logo' => $lsp_logo,
        ]);

        $flashData = [
            'title' => 'Edit Success',
            'message' => 'Data LSP berhasil diubah',
            'type' => 'success',
        ];
        return redirect()->route('profile.index')->with('flashData', $flashData);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
