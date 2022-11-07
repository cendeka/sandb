<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Kontrak;
use App\Models\Output;
use App\Models\Pekerjaan;
use App\Models\Rincian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Variabel Statistik
        $foto = Foto::with('pekerjaan')->get();
        $pekerjaan = Pekerjaan::with('kegiatan', 'foto')->get();
        $sr = Output::where('komponen', 'SR')->sum('volume');
        $ipal = Output::where('komponen', 'IPAL')->sum('volume');
        $mck = Output::where('komponen', 'MCK')->sum('volume');

        $penerima_manfaat = Rincian::sum('outcome');
        $total_pagu = $pekerjaan->sum('pagu');
        $total_pekerjaan = $pekerjaan->count();
        // Kurang dari sejuta
        if ($total_pagu < 1000000) {
            $pagu = number_format($total_pagu);
        // Kurang dari semiliar
        } elseif ($total_pagu < 1000000000) {
            $pagu = number_format($total_pagu / 1000000, 1, ',', '').' Juta';
        } else {
            // Sama dengan atau lebih satu miliar
            $pagu = number_format($total_pagu / 1000000000, 1, ',', '').' Miliar';
        }

        $get_kontrak = Kontrak::get();
        $total_kontrak = $get_kontrak->sum('harga_kontrak');
        if ($total_kontrak < 1000000) {
            // code...
            $kontrak = number_format($total_kontrak);
        } elseif ($total_kontrak < 1000000000) {
            // code...
            $kontrak = number_format($total_kontrak / 1000000, 1, ',', '').' Juta';
        } else {
            $kontrak = number_format($total_kontrak / 1000000000, 1, ',', '').' Miliar';
        }

        $realisasi_kontrak = divnum($total_kontrak, $total_pagu);

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'pagu' => $pagu,
            'total_pagu' => $total_pagu,
            'total_pekerjaan' => $total_pekerjaan,
            'total_kontrak' => $kontrak,
            'realisasi' => $realisasi_kontrak,
            'penerima_manfaat' => $penerima_manfaat,
            'foto' => $foto,
            'sr' => $sr,
            'ipal' => $ipal,
            'mck' => $mck,

        ]);
    }

    public function commits()
    {
    exec('git log', $output);
    $history = array();

    foreach($output as $line) {
        if(strpos($line, 'commit') === 0) {
            if(!empty($commit)) {
                array_push($history, $commit);   
                unset($commit);
            }
            $commit['hash']   = substr($line, strlen('commit'));
            }
            else if(strpos($line, 'Author') === 0) {
            $commit['author'] = substr($line, strlen('Author:'));
            }
            else if(strpos($line, 'Date') === 0) {
                $commit['date']   = substr($line, strlen('Date:'));
            }
            else {
                if(isset($commit['message']))
                    $commit['message'] .= $line;
                else
                    $commit['message'] = $line;
            }
        }
        return $history; // Array of commits, parse it to json if you need
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
