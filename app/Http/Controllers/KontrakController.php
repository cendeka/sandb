<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Kontrak;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data Kontrak
        $data = Kontrak::with('pekerjaan.kegiatan')->get();
        $title = 'Data Kontrak';
        // dd($data);
        return view('pages.kontrak.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Tambah data kontrak
        $pekerjaan = Pekerjaan::with('detail')->get();

        return view('halaman.kontrak.tambah', compact('pekerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $s = Pekerjaan::where('id', $request->pekerjaan_id)->pluck('pagu')->first();
        $kontrak = 'Rp'.number_format($s, 2, ',', '.');

        // $s = $kontrak->pagu;
        $rules = [
            'program_id' => 'required',
            'pekerjaan_id' => 'required',
            'harga_kontrak' => 'required|numeric|max:'.$s,
            'no_spk' => 'required|unique:db_kontrak,no_spk',
            'tgl_spk' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'nama_pelaksana' => 'required',
            'nama_pengawas' => 'required',
            'jenis_kontrak' => 'required',


        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'unique' => ':attribute sudah digunakan',
            'max' => ':attribute tidak boleh lebih dari pagu '.$kontrak,

        ];
        $string = ['Rp', ',00', '.'];
        $attributeNames = [
            'program_id' => 'Kegiatan',
            'pekerjaan_id' => 'Pekerjaan',
            'harga_kontrak' => 'Harga Kontrak',
            'no_spk' => 'Nomor SPK',
            'tgl_spk' => 'Tanggal SPK',
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
            'nama_pelaksana' => 'Nama Pelaksana',
            'nama_pengawas' => 'Nama Pengawas',
            'jenis_kontrak' => 'Jenis Kontrak',

        ];

        $valid = $this->validate($request, $rules, $customMessages, $attributeNames);

        // if ($valid->fails()) {
        //     return Redirect::to('/kontrak/create')
        //     ->withErrors($valid)
        //     ->withInput();
        // } else {
        // }

        $pekerjaan = Kontrak::firstOrCreate([
            'program_id' => $request->program_id,
            'pekerjaan_id' => $request->pekerjaan_id,
            'harga_kontrak' => str_replace($string, '', $request->harga_kontrak),
            'no_spk' => $request->no_spk,
            'tgl_spk' => $request->tgl_spk,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'nama_pelaksana' => $request->nama_pelaksana,
            'nama_pengawas' => $request->nama_pengawas,
            'jenis_kontrak' => $request->jenis_kontrak,
        ]);
        Alert::success('Kontrak', 'Data Kontrak Berhasil Ditambahkan');

        return redirect('kontrak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function cover()
    {
        //
        return view('pages.print.coverkontrak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrak $kontrak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrak $kontrak)
    {
        //
        $kontrak = Kontrak::with('pekerjaan', 'kegiatan')->first();
        // dd($kontrak);
        return response()->json($kontrak, 200);
    }

    public function edit_kontrak(Request $request)
    {
        $data = Kontrak::with('pekerjaan', 'kegiatan')->where('id', $request->id)->first();

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontrak $kontrak)
    {
        $s = Pekerjaan::where('id', $request->pekerjaan_id)->pluck('pagu')->first();
        // $kontrak = 'Rp' . number_format($s, 2, ',', '.');
        // $k = $request->no_spk;

        //edit
        $rules = [
            'program_id' => 'required',
            'pekerjaan_id' => 'required',
            'harga_kontrak' => 'required|numeric|max:'.$s,
            'no_spk' => 'required',
            'tgl_spk' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'nama_pelaksana' => 'required',
            'nama_pengawas' => 'required',
        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'max' => ':attribute tidak boleh lebih dari pagu '.$s,
        ];

        $attributeNames = [
            'program_id' => 'Kegiatan',
            'pekerjaan_id' => 'Pekerjaan',
            'harga_kontrak' => 'Harga Kontrak',
            'no_spk' => 'Nomor SPK',
            'tgl_spk' => 'Tanggal SPK',
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
            'nama_pelaksana' => 'Nama Pelaksana',
            'nama_pengawas' => 'Nama Pengawas',
        ];

        // $string = ['Rp',',00','.'];

        $this->validate($request, $rules, $customMessages, $attributeNames);
        $kontrak->update([
            'program_id' => $request->program_id,
            'pekerjaan_id' => $request->pekerjaan_id,
            'harga_kontrak' => $request->harga_kontrak,
            'no_spk' => $request->no_spk,
            'tgl_spk' => $request->tgl_spk,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'nama_pelaksana' => $request->nama_pelaksana,
            'nama_pengawas' => $request->nama_pengawas,
        ]);
        Alert::success('Kontrak', 'Data Kontrak Berhasil Diubah');

        return redirect('kontrak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrak $kontrak)
    {
        //
        $kontrak->delete();
        Alert::success('Kontrak', 'Data Kontrak Berhasil Dihapus');

        return redirect('kontrak');
    }
}
