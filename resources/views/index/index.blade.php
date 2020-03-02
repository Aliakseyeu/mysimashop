@extends('layouts.master', ['title' => 'index', 'group' => $groups->first()])

@section('notifications')
    @include('parts.notifications')
@endsection

@section('content')

    <section class="orders">

        <div class="container">
            <div class="orders__navigation row">
                <div class="">
                    {{ $groups->links() }}
                </div>
                @include('parts.filters')
            </div>
        </div>

        @if($groups->count() <= 0)

            <div class="alert alert-danger" role="alert">
                Групп нет
            </div>

        @else

            @foreach($groups as $group)
            
                @foreach($group->orders as $order)

                    @if(!$order->item)
                        @continue
                    @endif                

                    @include('order.show', [
                        'item' => $order->item, 
                        'users' => $order->users, 
                        'action' => '/order/store_exists',
                        'id' => $order->id,
                    ])

                @endforeach

            @endforeach

        @endif

        <div class="container">
            {{ $groups->links() }}
        </div>

    </section>

@endsection