<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Jabatan;
use App\Ckp;
use App\Ratarata;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        // $user = Auth::user();
        // $ckpt = new Ckp;
        // $ckpt = $ckpt->where('user_id', $user->id)->get();
        //  $daftar_bulan = Ckp::select('bulan')->distinct()->get();
        // return view('home', compact('ckpt', 'daftar_bulan', 'user'));

        $users = new User;
        $users = $users::with('jabatan')->get();
     
        
        $jabatans = new Jabatan;
        $jabatans = $jabatans->get();
        
        
        return view('admin', compact('users', 'jabatans'));
    }

    public function indexRecords()
    {
        

        $daftar_pegawai = User::get();
        $daftar_bulan = Ckp::select('bulan')->distinct()->get();
        
        
        return view('ckprecords', compact('daftar_pegawai', 'daftar_bulan'));
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
    public function storeUser(Request $request)
    {
    
        $user = new User;
        $user->name = $request->editedField['edited_nama'] ;
        $user->email = $request->editedField['edited_email'] ;
        $user->nip_pendek = $request->editedField['edited_nip9digit'] ;
        $user->nip_panjang = $request->editedField['edited_nip18digit'] ;
        $user->jabatan_id = $request->editedField['edited_jabatan'] ;
        $user->is_admin = $request->editedField['edited_isAdmin'] == 'admin';
        // ? ; 0 , turnery operation
        $user->password = Hash::make(12341234);
        $user->save();  
        // $user->name = 
    }

    public function storeJabatan(Request $request)
    {
    
        $jabatan = new Jabatan;
        $jabatan->jabatan_kantor = $request->editedField['jabatan_kantor'] ;
        $jabatan->role = $request->editedField['role'] ;
        $jabatan->save();  
        // $user->name = 
    }

    public function getCurrentUser(){
        $users = new User;
        $users = $users::with('jabatan')->get();
        
        return response()->json([
            $user]);
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
    public function updateUser(Request $request, $id)
    {
        //
        
        // $user = new User;
        // $user = User::where('id', $id)->first();
        // $user->name = $request->editedField['edited_nama'] ;
        // $user->email = $request->editedField['edited_email'] ;
        // $user->nip_pendek = $request->editedField['edited_nip9digit'] ;
        // $user->nip_panjang = $request->editedField['edited_nip18digit'] ;
        // $user->jabatan_id = $request->editedField['edited_jabatan'];
        // $user->is_admin = $request->editedField['edited_isAdmin'] == 'admin';
        // $user->save();
        // $tes = $user->save();

        $user = User::where('id', $id)->update([
            'name' => $request->editedField['edited_nama'] ,
            'email' => $request->editedField['edited_email'] ,
            'nip_pendek' => $request->editedField['edited_nip9digit'] ,
            'nip_panjang' => $request->editedField['edited_nip18digit'] ,
            'jabatan_id' => $request->editedField['edited_jabatan'],
            'is_admin' => $request->editedField['edited_isAdmin'] == 'admin'
        ]);



    }

    public function updateJabatan(Request $request, $id)
    {
        //
        


        $jabatan = Jabatan::where('id', $id)->update([
            'jabatan_kantor' => $request->editedField['jabatan_kantor'] ,
            'role' => $request->editedField['role'] ,
           
        ]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        //
        
        $user = new User;
        $user = $user->where('id', $id)->delete();
    }

    public function destroyJabatan($id)
    {
        //
        
        $jabatan = new Jabatan;
        $jabatan = $jabatan->where('id', $id)->delete();
    }
}
