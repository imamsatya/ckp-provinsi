@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                   
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- <button type="submit" class="btn btn-primary">
    <a href="{{ route('download_excel') }}">asdad</a>
 </button> --}}
        <s-layout>
            <s-ckp :ckpt="{{$ckpt}}" :daftar_bulan="{{$daftar_bulan}}" :user="{{$user}}"></s-ckp >
        </s-layout>
{{-- <example-component></example-component> --}}
@endsection

