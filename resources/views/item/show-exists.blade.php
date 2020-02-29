@extends('item.master', ['group' => $group])

@section('data')

    @include('order.show', ['action' => '/order/store_exists', 'id' => $item->order->id, 'order' => $item->order])

@endsection