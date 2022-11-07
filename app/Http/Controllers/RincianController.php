<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Rincian;
use App\Models\Kegiatan;
use App\Models\Output;


use Illuminate\Http\Request;

class RincianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rincian::with('pekerjaan', 'pekerjaan.kegiatan', 'output')->get();
        $program = Kegiatan::get();
        $title = 'Rincian Pekerjaan';

        return view('pages.pekerjaan.paket', compact('data', 'title','program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //tambah Rincian
        $rules = [
            'pekerjaan_id' => 'required',
            'outcome' => 'required',
            'output.*.komponen' => 'required',
            'output.*.volume' => 'required',
            'output.*.satuan' => 'required'



        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            // 'unique'    => ':attribute sudah digunakan',

        ];
        $attributeNames = [
            'pekerjaan_id' => 'Kegiatan',
            'outcome' => 'Target Outcome',


        ];

        $valid = $this->validate($request, $rules, $customMessages, $attributeNames);

        $rincian = Rincian::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
            'pekerjaan_id' => $request->pekerjaan_id,
            'outcome' => $request->outcome,            
        ]);
        foreach ($request->output as $key => $value) {
            $output = Output::create(
                [
                    'pekerjaan_id' => $request->pekerjaan_id,
                    'komponen' => $value['komponen'],
                    'volume' => $value['volume'],
                    'satuan' => $value['satuan'],
                ]
            );        
        }
        
        Alert::success('Rincian Pekerjaan', 'Data Rincian Pekerjaan Berhasil Ditambahkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $Paket
     * @return \Illuminate\Http\Response
     */
    public function show(Rincian $rincian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $Paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Rincian $rincian)
    {
        //
    }

    public function edit_paket(Request $request)
    {
        $data = Rincian::with('pekerjaan', 'pekerjaan.kegiatan')->where('id', $request->id)->first();

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $Paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $rules = [
            'pekerjaan_id' => 'required',


        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong ',
            // 'unique'    => ':attribute sudah digunakan',

        ];
        $attributeNames = [
            'pekerjaan_id' => 'Pekerjaan',

        ];

        $valid = $this->validate($request, $rules, $customMessages, $attributeNames);

        $rincian = Rincian::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
            'pekerjaan_id' => $request->pekerjaan_id,
            'outcome' => $request->outcome,
        ]);
        foreach ($request->output as $key => $value) {
            $output = Output::updateOrCreate(
                [
                    'id' => $value['id']
                ],
                [
                    'komponen' => $value['komponen'],
                    'volume' => $value['volume'],
                    'satuan' => $value['satuan'],
                ]
            );        
        }
        Alert::success('Paket Pekerjaan', 'Data Paket Pekerjaan Berhasil Diubah');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $Paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rincian $rincian)
    {
        $rincian->output()->delete();
        $rincian->delete();

        Alert::success('Paket Pekerjaan', 'Data Paket Pekerjaan Berhasil Dihapus');

        return redirect()->back();
    }
}
