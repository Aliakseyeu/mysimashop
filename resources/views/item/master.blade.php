@extends('layouts.master', ['title' => 'index', 'group' => $group, 'pageTitle' => 'Создать заказ'])

@section('content')

    <div class="container">
        
        <div class="">
            @yield('data')
        </div>
                
    </div>

@endsection
