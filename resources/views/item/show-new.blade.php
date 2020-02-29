@extends('item.master', ['group' => $group])

@section('data')

    @include('order.show', ['action' => '/order/store_new', 'id' => $item->id])

@endsection