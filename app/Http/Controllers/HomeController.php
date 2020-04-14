<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\User;
use App\Jabatan;
use App\Ckp;
use App\Ratarata;

use DB;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function adminHome()
        {

        return view('adminHome');
        }

    public function get_user(){
         $user = Auth::user();
         $role= $user->jabatan->role;
         
         return response()->json([
    $user, $role]);
    }

    public function logout(){
          \Auth::logout();

        return redirect()->route('login');
    }

    public function index()
    {
        $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)->get();
         $daftar_bulan = Ckp::select('bulan')->distinct()->get();
        return view('home', compact('ckpt', 'daftar_bulan'));
    }

    public function settings(){

        return view('settings');
    }

    public function about(){

        return view('about');
    }

    public function ckpRealisasi(Request $request){
        // dd($request->ckp[0]['jenis_kegiatan']);
        $length = count($request->ckp);
        // foreach ($request->ckp as $ckpt => $value) {
        //     dd($ckpt);
            
        // }
            $user = Auth::user();
        $ckpt = new Ckp;
        for ($i=0; $i < $length ; $i++) { 
            $ckpt = $ckpt->where('id', $request->ckp[$i]['id'])->first();
            $ckpt->realisasi = $request->ckp[$i]['realisasi'];
            $ckpt->save();
        }
    }

    public function updateCkp(Request $request, $id){
        // dd($id);
        // dd($request->input('edited_ckp')[0]['jenis_kegiatan']);
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('id', $id)->first();
        $ckpt->jenis_kegiatan = $request->input('edited_ckp')[0]['jenis_kegiatan'];
        $ckpt->uraian_kegiatan = $request->input('edited_ckp')[0]['uraian_kegiatan'];
        $ckpt->satuan = $request->input('edited_ckp')[0]['satuan'];
        $ckpt->target_kuantitas = $request->input('edited_ckp')[0]['target_kuantitas'];
        $ckpt->kode_butir_kegiatan = $request->input('edited_ckp')[0]['kode_butir_kegiatan'];
        $ckpt->angka_kredit = $request->input('edited_ckp')[0]['angka_kredit'];
        $ckpt->keterangan = $request->input('edited_ckp')[0]['keterangan'];
         $ckpt->save();
        
    }

    public function get_ckp( $bulan){
        
        
        $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)
        ->where('bulan', $bulan)->get();
        // return $ckpt;
        return response()->json([
    $ckpt
]);
    }

    public function get_ckp_bulan( $bulan){
        
        
        $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)
        ->where('bulan', $bulan)->get();
        // return $ckpt;
        return response()->json([
            $ckpt
        ]);
    }

    

    public function excelPost(Request $request)
    {
        
        $user=Auth::user();     
        //pejabat penilai
        
        $penilai = new User;
       
        switch ($user->jabatan->jabatan_kantor) {
            case 'Kepala BPS Kabupaten':
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

            case 'Kepala Bagian Tata Usaha':
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

            case 'Kepala Bidang Statistik Sosial':
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

            case 'Kepala Bidang Statistik Produksi':
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

            case 'Kepala Bidang Statistik Distribusi':   
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

            case 'Kepala Bidang Neraca Wilayah dan Analisis Statistik':
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

            case 'Kepala Bidang Statistik Integrasi Pengolahan dan Diseminasi Statistik':
            $penilai = $penilai->where('jabatan_id', 1)->get();
            break;

           
            //Kepala BPS Prov
            //=================================Kasie===================================
            //TU
            case 'Kepala Subbagian Bina Program':
            $penilai = $penilai->where('jabatan_id', 3)->get();
            break;

            case 'Kepala Subbagian Kepegawaian dan Hukum':
            $penilai = $penilai->where('jabatan_id', 3)->get();
            break;
            
            case 'Kepala Subbagian Bina Keuangan':
            $penilai = $penilai->where('jabatan_id', 3)->get();
            break;

            case 'Kepala Subbagian Umum':
            $penilai = $penilai->where('jabatan_id', 3)->get();
            break;

            case 'Kepala Subbagian Pengadaan Barang/Jasa':
            $penilai = $penilai->where('jabatan_id', 3)->get();
            break;

            //Sosial
            case 'Kepala Seksi Statistik Kependudukan':
            $penilai = $penilai->where('jabatan_id', 4)->get();
            break;

            case 'Kepala Seksi Statistik Ketahanan Sosial':
            $penilai = $penilai->where('jabatan_id', 4)->get();
            break;

            case 'Kepala Seksi Statistik Kesejahteraan Rakyat':
            $penilai = $penilai->where('jabatan_id', 4)->get();
            break;

            //Produksi
            case 'Kepala Seksi Statistik Pertanian':
            $penilai = $penilai->where('jabatan_id', 5)->get();
            break;

            case 'Kepala Seksi Statistik Industri':
            $penilai = $penilai->where('jabatan_id', 5)->get();
            break;

            case 'Kepala Seksi Statistik Pertambangan, Energi dan Konstruksi':
            $penilai = $penilai->where('jabatan_id', 5)->get();
            break;


            //Distribusi
            case 'Kepala Seksi Statistik Harga Konsumen dan Harga Perdagangan Besar':
            $penilai = $penilai->where('jabatan_id', 6)->get();
            break;

            case 'Kepala Seksi Statistik Keuangan Dan Harga Produsen':
            $penilai = $penilai->where('jabatan_id', 6)->get();
            break;

            case 'Kepala Seksi Statistik Niaga dan Jasa':
            $penilai = $penilai->where('jabatan_id', 6)->get();
            break;

            //Neraca
            case 'Kepala Seksi Neraca Produksi':
            $penilai = $penilai->where('jabatan_id', 7)->get();
            break;

            case 'Kepala Seksi Neraca Konsumsi':
            $penilai = $penilai->where('jabatan_id', 7)->get();
            break;

            case 'Kepala Seksi Analisis Statistik Lintas Sektor ':
            $penilai = $penilai->where('jabatan_id', 7)->get();
            break;



            //IPDS
            case ('Kepala Seksi Integrasi Pengolahan Data'):
            $penilai = $penilai->where('jabatan_id', 8)->get();
            break;
            case ('Kepala Seksi Jaringan dan Rujukan Statistik'):
            $penilai = $penilai->where('jabatan_id', 8)->get();
            break;
            case ('Kepala Seksi Diseminasi dan Layanan Statistik'):
            $penilai = $penilai->where('jabatan_id', 8)->get();
            break;


            //IPDS
            // case 'Kepala Seksi Integrasi Pengolahan Data'OR 'Kepala Seksi Jaringan dan Rujukan Statistik'OR 'Kepala Seksi Diseminasi dan Layanan Statistik':
            // $penilai = $penilai->where('jabatan_id', 8)->get();
            // break;
            //=================================Staff===================================
            //kasie TU
            case 'Staf Subbagian Bina Program':
            $penilai = $penilai->where('jabatan_id', 9)->get();
            break;

            case 'Staf Subbagian Kepegawaian dan Hukum':
            $penilai = $penilai->where('jabatan_id', 10)->get();
            break;

            case 'Staf Subbagian Bina Keuangan':
            $penilai = $penilai->where('jabatan_id', 11)->get();
            break;

            case 'Staf Subbagian Umum':
            $penilai = $penilai->where('jabatan_id', 12)->get();
            break;

            case 'Staf Subbagian Pengadaan Barang/Jasa':
            $penilai = $penilai->where('jabatan_id', 13)->get();
            break;

            //kasie Sosial
            case 'Staf Seksi Statistik Kependudukan':
            $penilai = $penilai->where('jabatan_id', 14)->get();
            break;

            case 'Staf Seksi Statistik Ketahanan Sosial':
            $penilai = $penilai->where('jabatan_id', 15)->get();
            break;

            case 'Staf Seksi Statistik Ketahanan Sosial':
            $penilai = $penilai->where('jabatan_id', 16)->get();
            break;
            //kasie Produksi
            case 'Staf Seksi Statistik Pertanian':
            $penilai = $penilai->where('jabatan_id', 17)->get();
            break;

            case 'Staf Seksi Statistik Industri':
            $penilai = $penilai->where('jabatan_id', 18)->get();
            break;

            case 'Staf Seksi Statistik Pertambangan dan Energi':
            $penilai = $penilai->where('jabatan_id', 19)->get();
            break;

            //kasie Neraca
            case 'Staf Seksi Neraca Produksi':
            $penilai = $penilai->where('jabatan_id', 23)->get();
            break;

            case 'Staf Seksi Neraca Konsumsi':
            $penilai = $penilai->where('jabatan_id', 24)->get();
            break;
            
            case 'Staf Seksi Analisis Statistik Lintas Sektor':
            $penilai = $penilai->where('jabatan_id', 25)->get();
            break;

            //kasie Distribusi
            case 'Staf Seksi Statistik Harga Konsumen dan Harga Perdagangan Besar':
            $penilai = $penilai->where('jabatan_id', 20)->get();
            break;

            case 'Staf Seksi Statistik Keuangan Dan Harga Produsen':
            $penilai = $penilai->where('jabatan_id', 21)->get();
            break;

            case 'Staf Seksi Statistik Niaga dan Jasa':
            $penilai = $penilai->where('jabatan_id', 22)->get();
            break;

            //Kasie IPDS
            case 'Staf Seksi Integrasi Pengolahan Data':
            $penilai = $penilai->where('jabatan_id', 26)->get();
            break;

            case 'Staf Seksi Jaringan dan Rujukan Statistik':
            $penilai = $penilai->where('jabatan_id', 27)->get();
            break;

            case 'Staf Seksi  Diseminasi dan Layanan Statistik':
            $penilai = $penilai->where('jabatan_id', 28)->get();
            break;

            
            default:
                # code...
                break;
        }   
        // dd($user->jabatan->jabatan_kantor);

        // dd($penilai);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template.xlsx');
         
        $worksheet = $spreadsheet->getSheet(0);

        //  dd(count($request->ckp));

        //Identitas
        $worksheet->getCell('C4')->setValue(': BPS Provinsi Sulawesi Tengah');
        $worksheet->getCell('C5')->setValue(': '.$user->name);
        $worksheet->getCell('C6')->setValue(': '.$user->jabatan->jabatan_kantor);
        $worksheet->getCell('C7')->setValue(': '.$request->ckp[0]['bulan']);

        //Penilai
        $spreadsheet->getSheet(0)->mergeCells('B21:C21');
        $worksheet->getCell('B21')->setValue('Tanggal: '.$request->ckp[0]['bulan']);

        $spreadsheet->getSheet(0)->mergeCells('B27:C27');
        $worksheet->getCell('B27')->setValue($user->name);

        $spreadsheet->getSheet(0)->mergeCells('B28:C28');
        $worksheet->getCell('B28')->setValue('NIP : '.$user->nip_panjang);


        $spreadsheet->getSheet(0)->mergeCells('E27:H27');
        $worksheet->getCell('E27')->setValue($penilai[0]['name']);

        $spreadsheet->getSheet(0)->mergeCells('E28:H28');
        $worksheet->getCell('E28')->setValue('NIP : '.$penilai[0]['nip_panjang']);

        

        //CKP Utama
        // The following code inserts 2 new rows, right before row 7:
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(7, 2);

        $ckp_utama = new Ckp;
        $ckp_utama = $ckp_utama->where('user_id', $user->id)
                                ->where('jenis_kegiatan', 'Utama')
                                ->where('bulan', $request->ckp[0]['bulan'])
                                ->get();

        $ckp_tambahan = new Ckp;
        $ckp_tambahan = $ckp_tambahan->where('user_id', $user->id)
                                ->where('jenis_kegiatan', 'Tambahan')
                                ->where('bulan', $request->ckp[0]['bulan'])
                                ->get();
        
       
       
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(17,1);
        if (count($ckp_tambahan) != 0) {
            # code...
            $spreadsheet->getSheet(0)->insertNewRowBefore(17,count($ckp_tambahan));
            for ($i=16; $i < count($ckp_tambahan) + 16 ; $i++) {        
                //  $spreadsheet->getSheet(0)->insertNewRowBefore(13+$i, 1);
                 $worksheet->getCell('A'.$i)->setValue($i-15);

                $spreadsheet->getSheet(0)->mergeCells('B'.$i.':'.'C'.$i);
                $worksheet->getCell('B'.$i)->setValue($ckp_tambahan[$i-16]['uraian_kegiatan']);//uraian kegiatan
                $worksheet->getCell('D'.$i)->setValue($ckp_tambahan[$i-16]['satuan']);//satuan
                $worksheet->getCell('E'.$i)->setValue($ckp_tambahan[$i-16]['target_kuantitas']);//target
                $worksheet->getCell('F'.$i)->setValue($ckp_tambahan[$i-16]['kode_butir_kegiatan']);//kode butir
                $worksheet->getCell('G'.$i)->setValue($ckp_tambahan[$i-16]['angka_kredit']);//angka kredit
                $worksheet->getCell('H'.$i)->setValue($ckp_tambahan[$i-16]['keterangan']);//keterangan
            

            }
        }
       

        
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(14,1);
        if (count($ckp_utama) != 0) {
            # code...
            $spreadsheet->getSheet(0)->insertNewRowBefore(14,count($ckp_utama));
             for ($i=13; $i < count($ckp_utama) + 13 ; $i++) {        
                //  $spreadsheet->getSheet(0)->insertNewRowBefore(13+$i, 1);
                 $worksheet->getCell('A'.$i)->setValue($i-12);

                $spreadsheet->getSheet(0)->mergeCells('B'.$i.':'.'C'.$i);
                $worksheet->getCell('B'.$i)->setValue($ckp_utama[$i-13]['uraian_kegiatan']);//uraian kegiatan
                $worksheet->getCell('D'.$i)->setValue($ckp_utama[$i-13]['satuan']);//satuan
                $worksheet->getCell('E'.$i)->setValue($ckp_utama[$i-13]['target_kuantitas']);//target
                $worksheet->getCell('F'.$i)->setValue($ckp_utama[$i-13]['kode_butir_kegiatan']);//kode butir
                $worksheet->getCell('G'.$i)->setValue($ckp_utama[$i-13]['angka_kredit']);//angka kredit
                $worksheet->getCell('H'.$i)->setValue($ckp_utama[$i-13]['keterangan']);//keterangan
            

             }
        }
       

        
        //  $spreadsheet->getSheetByName('CKP-R');
        // $worksheet = $spreadsheet->setActiveSheetIndex(1);
        // $worksheet->getCell('C4')->setValue(': BPS Provinsi Sulawesi Tengah X');

        //========================CKP-R============================
        $worksheet = $spreadsheet->getSheet(1);

        //  dd(count($request->ckp));

        //Identitas
        $worksheet->getCell('C4')->setValue(': BPS Provinsi Sulawesi Tengah');
        $worksheet->getCell('C5')->setValue(': '.$user->name);
        $worksheet->getCell('C6')->setValue(': '.$user->jabatan->jabatan_kantor);
        $worksheet->getCell('C7')->setValue(': '.$request->ckp[0]['bulan']);

        //Penilai
        // $spreadsheet->getSheet(1)->mergeCells('B21:C21');
        
        // dd($request->ckp[0]['bulan']);
        $bulan = $request->ckp[0]['bulan'];
        $tahun = substr($bulan, -4);
        // dd(substr($bulan, 0, -5));//bulan
        // dd((int)$tahun+1);
        // dd(substr($bulan, -4));//tahun
        switch (substr($bulan, 0, -5)) {
            case 'Januari':
                $bulan_r = 'Februari '.$tahun;
                break;
            case 'Februari':
                $bulan_r = 'Maret '.$tahun;
                break;
            case 'Maret':
                $bulan_r = 'April '.$tahun;
                break;
            case 'April':
                $bulan_r = 'Mei '.$tahun;
                break;
            case 'Juni':
                $bulan_r = 'Juli '.$tahun;
                break;
            case 'Agustus':
                $bulan_r = 'September '.$tahun;
                break;
            case 'September':
                $bulan_r = 'Oktober '.$tahun;
                break;
            case 'Oktober':
                $bulan_r = 'November '.$tahun;
                break;
            case 'November':
                $bulan_r = 'Desember '.$tahun;
                break;
            case 'Desember':
                $bulan_r = 'Januari '.$tahun+1;
                break;
            default:
                # code...
                break;
        }
        // dd($bulan_r);
        $worksheet->getCell('B23')->setValue('Tanggal: '.$bulan_r);

        // $spreadsheet->getSheet(1)->mergeCells('B27:C27');
        $worksheet->getCell('B29')->setValue($user->name);

        // $spreadsheet->getSheet(1)->mergeCells('B28:C28');
        $worksheet->getCell('B30')->setValue('NIP : '.$user->nip_panjang);


        // $spreadsheet->getSheet(1)->mergeCells('E27:H27');
        $worksheet->getCell('G29')->setValue($penilai[0]['name']);

        // $spreadsheet->getSheet(1)->mergeCells('E28:H28');
        $worksheet->getCell('G30')->setValue('NIP : '.$penilai[0]['nip_panjang']);

        

        //CKP Utama
        // The following code inserts 2 new rows, right before row 7:
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(7, 2);

        $ckp_utama = new Ckp;
        $ckp_utama = $ckp_utama->where('user_id', $user->id)
                                ->where('jenis_kegiatan', 'Utama')
                                ->where('bulan', $request->ckp[0]['bulan'])
                                ->get();

        $ckp_tambahan = new Ckp;
        $ckp_tambahan = $ckp_tambahan->where('user_id', $user->id)
                                ->where('jenis_kegiatan', 'Tambahan')
                                ->where('bulan', $request->ckp[0]['bulan'])
                                ->get();
        
       
       
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(17,1);
        if (count($ckp_tambahan) != 0) {
            # code...
            
            $spreadsheet->getSheet(1)->insertNewRowBefore(17,count($ckp_tambahan));
            for ($i=16; $i < count($ckp_tambahan) + 16 ; $i++) {        
                //  $spreadsheet->getSheet(1)->insertNewRowBefore(13+$i, 1);
                // dd((int)$ckp_tambahan[$i-16]['realisasi']/(int)$ckp_tambahan[$i-16]['target_kuantitas']*100);
                 $worksheet->getCell('A'.$i)->setValue($i-15);

                $spreadsheet->getSheet(1)->mergeCells('B'.$i.':'.'C'.$i);
                $worksheet->getCell('B'.$i)->setValue($ckp_tambahan[$i-16]['uraian_kegiatan']);//uraian kegiatan
                $worksheet->getCell('D'.$i)->setValue($ckp_tambahan[$i-16]['satuan']);//satuan
                $worksheet->getCell('E'.$i)->setValue($ckp_tambahan[$i-16]['target_kuantitas']);//target
                $worksheet->getCell('F'.$i)->setValue($ckp_tambahan[$i-16]['realisasi']);//realisasi
                
                if ((int)$ckp_tambahan[$i-16]['realisasi'] > 0 && (int)$ckp_tambahan[$i-16]['target_kuantitas'] > 0){
                       $worksheet->getCell('G'.$i)->setValue((int)$ckp_tambahan[$i-16]['realisasi']/(int)$ckp_tambahan[$i-16]['target_kuantitas']*100);//%
                }

             
                $worksheet->getCell('H'.$i)->setValue($ckp_tambahan[$i-16]['kualitas']);//realisasi
                $worksheet->getCell('I'.$i)->setValue($ckp_tambahan[$i-16]['kode_butir_kegiatan']);//kode butir
                $worksheet->getCell('J'.$i)->setValue($ckp_tambahan[$i-16]['angka_kredit']);//angka kredit
                $worksheet->getCell('K'.$i)->setValue($ckp_tambahan[$i-16]['keterangan']);//keterangan
            

            }
        }
       

        
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(14,1);
        if (count($ckp_utama) != 0) {
            # code...
            $spreadsheet->getSheet(1)->insertNewRowBefore(14,count($ckp_utama));
             for ($i=13; $i < count($ckp_utama) + 13 ; $i++) {        
                //  $spreadsheet->getSheet(1)->insertNewRowBefore(13+$i, 1);
                 $worksheet->getCell('A'.$i)->setValue($i-12);

                $spreadsheet->getSheet(1)->mergeCells('B'.$i.':'.'C'.$i);
                $worksheet->getCell('B'.$i)->setValue($ckp_utama[$i-13]['uraian_kegiatan']);//uraian kegiatan
                $worksheet->getCell('D'.$i)->setValue($ckp_utama[$i-13]['satuan']);//satuan
                $worksheet->getCell('E'.$i)->setValue($ckp_utama[$i-13]['target_kuantitas']);//target
                $worksheet->getCell('F'.$i)->setValue($ckp_utama[$i-13]['realisasi']);//realisasi
                 if ((int)$ckp_utama[$i-13]['realisasi'] > 0 && (int)$ckp_utama[$i-13]['target_kuantitas'] > 0){
                $worksheet->getCell('G'.$i)->setValue((int)$ckp_utama[$i-13]['realisasi']/(int)$ckp_utama[$i-13]['target_kuantitas']*100);//%
                }
             
                $worksheet->getCell('H'.$i)->setValue($ckp_utama[$i-13]['kualitas']);//kualitas
                $worksheet->getCell('I'.$i)->setValue($ckp_utama[$i-13]['kode_butir_kegiatan']);//kode butir
                $worksheet->getCell('J'.$i)->setValue($ckp_utama[$i-13]['angka_kredit']);//angka kredit
                $worksheet->getCell('K'.$i)->setValue($ckp_utama[$i-13]['keterangan']);//keterangan
            

             }
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('./upload/write.xlsx');

        

       
      

       
       }
       public function download_excel($id){
           
           $user=Auth::user();
           $ckpt = new Ckp;
        $ckpt = $ckpt->where('id', $id)->get();
       
             $file="./upload/write.xlsx";
        return Response::download($file, 'CKP '.$user->name. ' '. $ckpt[0]['bulan'].'.xlsx') ;
       }

    public function ckpt_post(Request $request){

        $ckpt = new Ckp;
        $user = Auth::user();
        
        //  $setatributs = $setatribut->where('user_id', $user->id)->get();
   
        $ckpt->jenis_kegiatan = $request->input('ckpt')['jenis_kegiatan'];
        $ckpt->uraian_kegiatan = $request->input('ckpt')['uraian_kegiatan'];
        $ckpt->satuan = $request->input('ckpt')['satuan'];
        $ckpt->target_kuantitas = $request->input('ckpt')['target_kuantitas'];
        $ckpt->kode_butir_kegiatan = $request->input('ckpt')['kode_butir_kegiatan'];
        $ckpt->angka_kredit = $request->input('ckpt')['angka_kredit'];
        $ckpt->keterangan = $request->input('ckpt')['keterangan'];
        $ckpt->bulan = $request->input('ckpt')['bulan'];
        


        $ckpt->user_id = $user->id; 
        $ckpt->save();
    }

    public function ckpt_delete( $request){

        // dd($request);
        // dd($request->input('ckpt')['id']);
       
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('id', $request)->delete();
    }

    //ckp bulanan
     public function ckpBulan()
    {
        $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)->get();
        $daftar_bulan = Ckp::select('bulan')->distinct()->get();
        // dd($daftar_bulan[0]['bulan']);
        // dd($daftar_bulan);
        return view('ckp_bulan', compact('ckpt', 'daftar_bulan'));
    }

    //ratarata
    public function submitRatarata(Request $request)
    {
            // dd($request->input('bulan'));
        $ratarata = new Ratarata;
         $user = Auth::user();
          $ratarata_bulan = $ratarata->where('user_id',  $user->id)->where('bulan',$request->input('bulan'))->first();
         
          if ($ratarata_bulan == null) {
               $ratarata->ratarata = $request->input('ratarata');
         $ratarata->bulan = $request->input('bulan');
         $ratarata->user_id = $user->id;
         $ratarata->save();
          } else {
         $ratarata_bulan->ratarata = $request->input('ratarata');
         $ratarata_bulan->bulan = $request->input('bulan');
         $ratarata_bulan->user_id = $user->id;
         $ratarata_bulan->save();
          }
          
       
    
    }

    public function submitRatarata2(Request $request)
    {
            // dd($request->input('bulan'));
        $ratarata = new Ratarata;
       
          $ratarata_bulan = $ratarata->where('user_id',$request->input('id'))->where('bulan',$request->input('bulan'))->first();
         
          if ($ratarata_bulan == null) {
               $ratarata->ratarata = $request->input('ratarata');
         $ratarata->bulan = $request->input('bulan');
         $ratarata->user_id = $user->id;
         $ratarata->save();
          } else {
         $ratarata_bulan->ratarata = $request->input('ratarata');
         $ratarata_bulan->bulan = $request->input('bulan');
         $ratarata_bulan->user_id = $request->input('id');
         $ratarata_bulan->save();
          }
          
       
    
    }

    public function ckpRatarata()
    {
        $ratarata = new Ratarata;
         $daftar_bulan = Ckp::select('bulan')->distinct()->get();

        return view('ckp_ratarata', compact('ratarata', 'daftar_bulan'));
    }

    public function get_ckp_ratarata($bulan)
    {
         $users = DB::table('users')
            ->leftJoin('rataratas', 'users.id', '=', 'rataratas.user_id')
            ->where('rataratas.bulan', $bulan)
            ->get();  
            // dd($users);
        return response()->json([
            $users
        ]);
    }

    public function excelPost_rekap(Request $request)
    {
                        //  dd($request->input('bulan'));
         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template_rekap.xlsx');
         
        $worksheet = $spreadsheet->getSheet(0);

         $worksheet->getCell('B3')->setValue($request->input('bulan'));
        


         for ($i=6; $i <count($request->input('ckp')[0]) +6; $i++) { 
              $worksheet->getCell('A'.$i)->setValue($i-5);//no
               $worksheet->getCell('B'.$i)->setValue($request->input('ckp')[0][$i-6]['name']);//nama
               $worksheet->getCell('C'.$i)->setValue($request->input('ckp')[0][$i-6]['ratarata']);//nama
         }

         $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('./upload/write_rekap.xlsx');

    }

    public function download_excel_rekap($bulan)
    {
        //    $user=Auth::user();
        //    $ckpt = new Ckp;
        // $ckpt = $ckpt->where('id', $id)->get();
       
             $file="./upload/write_rekap.xlsx";
        return Response::download($file, 'Rekap CKP '. $bulan.'.xlsx') ;
    }

    public function gantiPassword(Request $request)
    {   
        $user=Auth::user();
        $db_user= new User;
        $db_user= $db_user->where('id', $user->id)->first();
        // dd($request->input('password_lama'));
        if(Hash::check($request->input('password_lama'), $user->password)){
            $db_user->password = Hash::make($request->input('password_baru'));
            $db_user->save();
            return 'berhasil';
        }else{
            return 'gagal';
        }
        
    }

    public function copyCkp(Request $request)
    {   
        $user=Auth::user();
        $ckpt=new CKP;
        
        $ckpt_copy  = $ckpt->where('user_id', $user->id)->where('bulan', $request->bulan_copy)->get();

        for ($i=0; $i < count($ckpt_copy) ; $i++) { 
             $ckpt=new CKP;
        $ckpt->jenis_kegiatan = $ckpt_copy[$i]->jenis_kegiatan;
        $ckpt->uraian_kegiatan = $ckpt_copy[$i]->uraian_kegiatan;
        $ckpt->satuan = $ckpt_copy[$i]->satuan;
        $ckpt->target_kuantitas = $ckpt_copy[$i]->target_kuantitas;
        $ckpt->kode_butir_kegiatan = $ckpt_copy[$i]->kode_butir_kegiatan;
        $ckpt->angka_kredit = $ckpt_copy[$i]->angka_kredit;
        $ckpt->keterangan = $ckpt_copy[$i]->keterangan;
        $ckpt->bulan = $request->bulan;
         $ckpt->user_id = $user->id; 
        $ckpt->save();
        }
       
        


       
    }
}
