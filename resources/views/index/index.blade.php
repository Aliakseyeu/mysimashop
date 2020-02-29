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
                <form class="no-send filters">
                    <label>Фильтры</label>
                    <input class="form-control filters__name" placeholder="Название"></input>
                    <input class="form-control filters__user" placeholder="Пользователь"></input>
                </form>
            </div>
        </div>

        @if($groups->count() <= 0)

            <div class="container">
                <div class="alert alert-danger" role="alert">
                    Групп нет
                </div>
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