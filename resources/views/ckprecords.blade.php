@extends('layouts.app')

@section('content')


<s-layout>
    <s-ckprecords  :daftar_bulan="{{$daftar_bulan}}" :daftar_pegawai="{{$daftar_pegawai}}"  ></s-ckprecords >
</s-layout>

@endsection

