<?php

namespace App\Http\Controllers\Api\v1;

use App\Ckp;
use App\Ratarata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CkpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = request()->user();
        $bulanEng = substr(request()->input('bulan'), 0, -5);
        
        switch ($bulanEng) {
            case 'January':
                $bulanInd = 'Januari';
                break;
            case 'February':
                $bulanInd = 'Februari';
                break;
            case 'March':
                $bulanInd = 'Maret';
                break;
            case 'April':
                $bulanInd = 'April';
                break;
            case 'May':
                $bulanInd = 'Mei';
                break;
            case 'June':
                $bulanInd = 'Juni';
                break;
            case 'July':
                $bulanInd = 'Juli';
                break;
            case 'August':
                $bulanInd = 'Agustus';
                break;
            case 'September':
                $bulanInd = 'September';
                break;
            case 'October':
                $bulanInd = 'Oktober';
                break;
            case 'November':
                $bulanInd = 'November';
                break;
            case 'December':
                $bulanInd = 'Desember';
                break;
            default:
                # code...
                break;
        }
        $bulanFinal = $bulanInd . ' ' . substr(request()->input('bulan'), -4);
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)
        ->where('bulan', $bulanFinal)->get();

        return response()->json([
            "data" =>$ckpt
        ]);
    }

    public function getRatarata()
    {


        $user = request()->user();
      
        
        $bulanEng = substr(request()->input('bulan'), 0, -5);
        
        switch ($bulanEng) {
            case 'January':
                $bulanInd = 'Januari';
                break;
            case 'February':
                $bulanInd = 'Februari';
                break;
            case 'March':
                $bulanInd = 'Maret';
                break;
            case 'April':
                $bulanInd = 'April';
                break;
            case 'May':
                $bulanInd = 'Mei';
                break;
            case 'June':
                $bulanInd = 'Juni';
                break;
            case 'July':
                $bulanInd = 'Juli';
                break;
            case 'August':
                $bulanInd = 'Agustus';
                break;
            case 'September':
                $bulanInd = 'September';
                break;
            case 'October':
                $bulanInd = 'Oktober';
                break;
            case 'November':
                $bulanInd = 'November';
                break;
            case 'December':
                $bulanInd = 'Desember';
                break;
            default:
                # code...
                break;
        }
        $bulanFinal = $bulanInd . ' ' . substr(request()->input('bulan'), -4);
        $ratarata = Ratarata::where([
            ['user_id', '=', $user->id],
            ['bulan', '=', $bulanFinal]

        ])->first();
        

        return response()->json([
            'status_code' => 200,
            'message' => 'success',
            'data' => $ratarata
        ]);
        //   return $ratarata;
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

      
        try {
            $ckpt = new Ckp;
            $user = request()->user();  
            $ckpt->jenis_kegiatan = request()->input('jenisKegiatan');
            $ckpt->uraian_kegiatan = request()->input('uraianKegiatan');
            $ckpt->satuan = request()->input('satuan');
            $ckpt->target_kuantitas = request()->input('targetKuantitas');
            $ckpt->kode_butir_kegiatan = request()->input('kodeButir');
            $ckpt->angka_kredit = request()->input('angkaKredit');
            $ckpt->keterangan = request()->input('keterangan');
            $ckpt->bulan = request()->input('bulan');
            $ckpt->user_id = $user->id; 
            $ckpt->save();

            return response()->json([
                "status_code" => 201,
                "message" => "success",
                "data" => $ckpt,

            ], 201, ["Location" => ""]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
           return response()->json([
               "status_code" => 400,
               "message" => "error occured"
           ], 400);
        }
       
    }

    public function storeRealisasi(Request $request)
    {
        //

      
        try {
            $length = count(json_decode(request()->input('ckpr')));
            // foreach ($request->ckp as $ckpt => $value) {
            //     dd($ckpt);
                
            // }
               
            $ckpt = new Ckp;
            for ($i=0; $i < $length ; $i++) { 
                $ckpt = $ckpt->where('id', json_decode(request()->input('ckpr'))[$i]->id)->first();
                $ckpt->realisasi = json_decode(request()->input('ckpr'))[$i]->realisasi;
                $ckpt->save();
            }
            return response()->json([
                "status_code" => 201,
                "message" => "success",
                "data" => $ckpt,

            ], 201, ["Location" => ""]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
           return response()->json([
               "status_code" => 400,
               "message" => "error occured"
           ], 400);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ckp  $ckp
     * @return \Illuminate\Http\Response
     */
    public function show(Ckp $ckp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ckp  $ckp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ckp $ckp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ckp  $ckp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ckp $ckp)
    {
        //
    }
}
