<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\User;
use App\Jabatan;
use App\Ckp;

class KasieController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)->get();
        return view('kasie.home', compact('ckpt'));
    }

    public function indexPenilaian()
    {   
        $user = Auth::user();
           $daftar_pegawai = new User;
        //kasie Neraca
        switch ($user->jabatan->jabatan_kantor) {
            //Kepala BPS Prov
            case 'Kepala BPS Provinsi':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [2,3,4,5,6,7,8])->get();
            break;

            //kabid TU
            case 'Kepala Bagian Tata Usaha':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [9,10,11,12,13])->get();
            break;
                        
            //kabid Sosial
            case 'Kepala Bidang Statistik Sosial':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [14,15,16])->get();
            break;

            //kabid Produksi
            case 'Kepala Bidang Statistik Produksi':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [17,18,19])->get();
            break;

            //kabid Distribusi
            case 'Kepala Bidang Statistik Distribusi':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [20,21,22])->get();
            break;

            //kabid Neraca
            case 'Kepala Bidang Neraca Wilayah dan Analisis Statistik':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [23,24,25])->get();
            break;

            //kabid IPDS
            case 'Kepala Bidang Statistik Integrasi Pengolahan dan Diseminasi Statistik':
            $daftar_pegawai = $daftar_pegawai->whereIn('jabatan_id', [26,27,28])->get();
            break;

            //=============================================//
            //=============================================//

            //kasie TU
            case 'Kepala Subbagian Bina Program':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 29)->get();
            break;

            case 'Kepala Subbagian Kepegawaian dan Hukum':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 30)->get();
            break;

            case 'Kepala Subbagian Bina Keuangan':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 31)->get();
            break;

            case 'Kepala Subbagian Umum':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 32)->get();
            break;

            case 'Kepala Subbagian Pengadaan Barang/Jasa':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 33)->get();
            break;

            //kasie Sosial
            case 'Kepala Seksi Statistik Kependudukan':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 34)->get();
            break;

            case 'Kepala Seksi Statistik Ketahanan Sosial':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 35)->get();
            break;

            case 'Kepala Seksi Statistik Ketahanan Sosial':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 36)->get();
            break;
            //kasie Produksi
            case 'Kepala Seksi Statistik Pertanian':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 37)->get();
            break;

            case 'Kepala Seksi Statistik Industri':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 38)->get();
            break;

            case 'Kepala Seksi Statistik Pertambangan dan Energi':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 39)->get();
            break;

            //kasie Neraca
            case 'Kepala Seksi Neraca Produksi':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 43)->get();
            break;

            case 'Kepala Seksi Neraca Konsumsi':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 44)->get();
            break;
            
            case 'Kepala Seksi Analisis Statistik Lintas Sektor':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 45)->get();
            break;

            //kasie Distribusi
            case 'Kepala Seksi Statistik Harga Konsumen dan Harga Perdagangan Besar':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 40)->get();
            break;

            case 'Kepala Seksi Statistik Keuangan Dan Harga Produsen':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 41)->get();
            break;

            case 'Kepala Seksi Statistik Niaga dan Jasa':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 42)->get();
            break;

            //Kasie IPDS
            case 'Kepala Seksi Integrasi Pengolahan Data':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 46)->get();
            break;

            case 'Kepala Seksi Jaringan dan Rujukan Statistik':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 47)->get();
            break;

            case 'Kepala Seksi  Diseminasi dan Layanan Statistik':
            $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 48)->get();
            break;

            
            default:
                # code...
                break;
        }
        
        //kasie IPDS 
        // if ($user->jabatan->jabatan_kantor == 'Kepala Seksi Integrasi Pengolahan Data' ) {    
        //     $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 46)->get();
        // }
        
        //  if ($user->jabatan->jabatan_kantor == 'Kepala Seksi Jaringan dan Rujukan Statistik' ) {          
        //     $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 47)->get();
        // }

        // if ($user->jabatan->jabatan_kantor == 'Kepala Seksi  Diseminasi dan Layanan Statistik' ) {
        //     $daftar_pegawai = $daftar_pegawai->where('jabatan_id', 48)->get();
        // }

        // dd($daftar_pegawai);
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)->get();
        $daftar_bulan = Ckp::select('bulan')->distinct()->get();
        
        return view('penilaian', compact('ckpt', 'daftar_bulan', 'daftar_pegawai'));
        
    }

     public function get_ckp_bulan_pegawai( $bulan, $pegawai){
        
        // dd($bulan, $pegawai);
        // $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id',$pegawai)
        ->where('bulan', $bulan)->get();
        // return $ckpt;
        return response()->json([
            $ckpt
        ]);
    }

    public function submitPenilaian(Request $request){
        // dd($request->ckp[0]);

        $length = count($request->ckp);
        // foreach ($request->ckp as $ckpt => $value) {
        //     dd($ckpt);
            
        // }
            $user = Auth::user();
        $ckpt = new Ckp;
        for ($i=0; $i < $length ; $i++) { 
            $ckpt = $ckpt->where('id', $request->ckp[$i]['id'])->first();
            $ckpt->kualitas = $request->ckp[$i]['kualitas'];
            $ckpt->save();
        }
    }

}
