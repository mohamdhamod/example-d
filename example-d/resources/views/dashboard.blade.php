@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            @if(session('error'))
                <div class="bg-red-500 p-4  rounded-lg mb-6 text-white text-center">  {{session('error')}} </div>
            @elseif(session('success'))
                <div class="bg-green-600 p-4  rounded-lg mb-6 text-white text-center">  {{session('success')}} </div>
            @endif
            dashboard
        </div>
    </div>
@endsection
