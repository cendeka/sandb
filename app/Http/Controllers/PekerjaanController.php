<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Dokumen;
use App\Models\Foto;
use App\Models\Kecamatan;
use App\Models\Kegiatan;
use App\Models\OutputRealisasi;
use App\Models\Pekerjaan;
use App\Models\Tfl;
use Auth;
use DateTime;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function kegiatan($id)
    {
        $data = Pekerjaan::with('kegiatan', 'desa', 'kec')->where('program_id', $id)->latest()->get();
        $kec = Kecamatan::get();
        $kegiatan = kegiatan::where('id', $id)->get('detail_kegiatan');

        return view('pages.pekerjaan.index', [
            'data' => $data,
            'title' => $kegiatan[0]->detail_kegiatan,
            'kec' => $kec,
        ]);
    }

    //custom
    public function getPekerjaan($keg_id)
    {
        $data = Pekerjaan::with('detail', 'output')->latest()->get()
        ->where('program_id', $keg_id)->where('detail', null)->whereNotNull('output');
        // ->pluck('nama_pekerjaan', 'id');
        return response()->json($data);
    }

    public function getPaket($keg_id, $tahun)
    {
        $data = Pekerjaan::with('output')->get()
        ->where('program_id', $keg_id)->where('tahun_anggaran', $tahun)->where('output', null);
        // ->pluck('nama_pekerjaan', 'id');

        return response()->json($data);
    }

    public function ubahPekerjaan(Request $request)
    {
        $data = Pekerjaan::with('kegiatan', 'desa', 'kec')->where('id', $request->id)->first();

        return response()->json($data, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kec = Kecamatan::get();
        $data = Pekerjaan::with('kegiatan', 'desa', 'kec')->latest()->get();

        return view('pages.pekerjaan.index', [
            'title' => 'Database Sanitasi',
            'data' => $data,
            'kec' => $kec,
        ]);
    }

    public function pekerjaan($tahun)
    {
        //wtf
        $data = Pekerjaan::with('kegiatan', 'desa', 'kec')->where('tahun_anggaran', $tahun)->latest()->get();
        // dd($data);
        return view('halaman.pekerjaan.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keg = Kegiatan::get();
        $kec = Kecamatan::get();

        return view('halaman.pekerjaan.tambah', [
            'keg' => $keg,
            'kec' => $kec,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'program_id' => 'required',
            'nama_pekerjaan' => 'required|unique:db_pekerjaan,nama_pekerjaan,'.$request->id.',id,tahun_anggaran,'.$request->tahun_anggaran,
            'kecamatan_id' => 'required',
            'desa_id' => 'required',
            'pagu' => 'required',
            'tahun_anggaran' => 'required',
            'sumber_dana' => 'required',


        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'unique' => 'Pekerjaan sama di tahun anggaran yang sama',

        ];

        $attributeNames = [
            'program_id' => 'Kegiatan',
            'nama_pekerjaan' => 'Nama Pekerjaan',
            'kecamatan_id' => 'Kecamatan',
            'desa_id' => 'Desa',
            'pagu' => 'Pagu',
            'tahun_anggaran' => 'Tahun Anggaran',
            'sumber_dana' => 'Sumber Dana',
        ];

        $this->validate($request, $rules, $customMessages, $attributeNames);
        $string = ['Rp', ',00', '.'];
        $pekerjaan = Pekerjaan::firstOrCreate([
            'program_id' => $request->program_id,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'kecamatan_id' => $request->kecamatan_id,
            'desa_id' => $request->desa_id,
            'pagu' => str_replace($string, '', $request->pagu),
            'tahun_anggaran' => $request->tahun_anggaran,
            'sumber_dana' => $request->sumber_dana,
        ]);
        Alert::success('Kegiatan', 'Data Kegiatan Berhasil Ditambahkan');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
        $pekerjaan = Pekerjaan::with('kec', 'desa', 'kegiatan', 'detail', 'detail.realisasi', 'dokumen', 'output')->where('id', $pekerjaan->id)->first();
        $pekerjaan_id = $pekerjaan->id;
        $foto = Foto::where('pekerjaan_id', $pekerjaan_id)->get();
        $dokumen = Dokumen::where('pekerjaan_id', $pekerjaan_id)->get();

        if (! is_null($pekerjaan->detail)) {
            // code...
            $mulai = new DateTime($pekerjaan->detail->tgl_mulai);
            $selesai = new DateTime($pekerjaan->detail->tgl_selesai);
            $interval = $mulai->diff($selesai);
            $days = $interval->format('%a').' Hari Kalender';

            return view('pages.pekerjaan.info', compact('pekerjaan'), [
                'title' => $pekerjaan->nama_pekerjaan,
                'foto' => $foto,
                'dokumen' => $dokumen,
                'days' => $days,

            ]);
        } else {
            // code...
            return view('pages.pekerjaan.info', compact('pekerjaan'), [
                'title' => $pekerjaan->nama_pekerjaan,
                'foto' => $foto,
                'dokumen' => $dokumen,
                // 'days' => $days,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        //
        $keg = Kegiatan::get();
        $kec = Kecamatan::get();
        // $pekerjaan = Pekerjaan::with('kec','desa','kegiatan')->first();
        return view('halaman.pekerjaan.edit', compact('pekerjaan', 'keg', 'kec'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $rules = [
            'program_id' => 'required',
            'nama_pekerjaan' => 'required',
            'kecamatan_id' => 'required',
            'desa_id' => 'required',
            'pagu' => 'required',
            'tahun_anggaran' => 'required',
            'sumber_dana' => 'required'
        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            'unique' => 'Pekerjaan sama di tahun anggaran yang sama',

        ];

        $attributeNames = [
            'program_id' => 'Kegiatan',
            'nama_pekerjaan' => 'Nama Pekerjaan',
            'kecamatan_id' => 'Kecamatan',
            'desa_id' => 'Desa',
            'pagu' => 'Pagu',
            'tahun_anggaran' => 'Tahun Anggaran',
            'sumber_dana' => 'Sumber Dana'
        ];

        $this->validate($request, $rules, $customMessages, $attributeNames);
        $string = ['Rp', ',00', '.'];

        $pekerjaan->updateOrCreate(
        [
            'id' => $request->pekerjaan_id
        ],
        [
            'program_id' => $request->program_id,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'kecamatan_id' => $request->kecamatan_id,
            'desa_id' => $request->desa_id,
            'pagu' => str_replace($string, '', $request->pagu),
            'tahun_anggaran' => $request->tahun_anggaran,
            'sumber_dana' => $request->sumber_dana
        ]);

        Alert::success('Kegiatan', 'Data Kegiatan Berhasil Diubah');
        return redirect()->back();    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        //
        $pekerjaan->delete();
        Alert::success('Kegiatan', 'Data Kegiatan Berhasil Dihapus');

        return redirect('pekerjaan');
    }
}
