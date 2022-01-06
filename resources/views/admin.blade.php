@extends('layouts.app')

@section('content')


<s-layout>
    <s-admin  :users="{{$users}}" :jabatans="{{$jabatans}}" ></s-admin >
</s-layout>

@endsection

