@extends('layouts.app')

@section('body')

    @include('parts.header', ['title' => $title])

    @if(!empty($pageTitle))
        @include('parts.page-title', ['title' => $pageTitle])
    @endif

    @yield('notifications')

    <div class="content">
        @include('parts.messages')
        @yield('content')
    </div>

    @include('parts.footer')

@endsection