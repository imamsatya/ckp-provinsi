<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\User;
use App\Jabatan;
use App\Ckp;

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
    public function index()
    {
        $user = Auth::user();
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('user_id', $user->id)->get();
        return view('home', compact('ckpt'));
    }

    public function excelPost(Request $request){
        
        dd($request->ckpt);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template.xls');
        $worksheet = $spreadsheet->getActiveSheet();

        //Identitas
        $worksheet->getCell('C4')->setValue(': BPS Provinsi Sulawesi Tengah');
        $worksheet->getCell('C5')->setValue(': Imam Satya Wedhatama');
        $worksheet->getCell('C6')->setValue(': Staf Seksi IPDS Pengolahan');
        $worksheet->getCell('C7')->setValue(': Maret 2020');

        //Penilai
        $spreadsheet->getActiveSheet()->mergeCells('B21:C21');
        $worksheet->getCell('B21')->setValue('Tanggal: Maret 2020');

        $spreadsheet->getActiveSheet()->mergeCells('B27:C27');
        $worksheet->getCell('B27')->setValue('Pegawai');

        $spreadsheet->getActiveSheet()->mergeCells('B28:C28');
        $worksheet->getCell('B28')->setValue('NIP Pegawai');


        $spreadsheet->getActiveSheet()->mergeCells('E27:H27');
        $worksheet->getCell('E27')->setValue('Pejabat');

        $spreadsheet->getActiveSheet()->mergeCells('E28:H28');
        $worksheet->getCell('E28')->setValue('NIP Pejabat');

        //CKP Utama
        // The following code inserts 2 new rows, right before row 7:
        // $spreadsheet->getActiveSheet()->insertNewRowBefore(7, 2);
        $spreadsheet->getActiveSheet()->insertNewRowBefore(14, 2);
        for ($i=13; $i < 15 ; $i++) { 
              
            $worksheet->getCell('A'.$i)->setValue(1);

        $spreadsheet->getActiveSheet()->mergeCells('B'.$i.':'.'C'.$i);
        $worksheet->getCell('B'.$i)->setValue('Kegiatan '.$i);
        $worksheet->getCell('D'.$i)->setValue('Satuan '.$i);
        $worksheet->getCell('E'.$i)->setValue('Target '.$i);
        $worksheet->getCell('F'.$i)->setValue('Kode Butir '.$i);
        $worksheet->getCell('G'.$i)->setValue('Angka Kredit '.$i);
        $worksheet->getCell('H'.$i)->setValue('Ket '.$i);

        }
        
        

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('write.xls');
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
        


        $ckpt->user_id = $user->id; 
        $ckpt->save();
    }

    public function ckpt_delete( $request){

        // dd($request);
        // dd($request->input('ckpt')['id']);
       
        $ckpt = new Ckp;
        $ckpt = $ckpt->where('id', $request)->delete();
    }
}
