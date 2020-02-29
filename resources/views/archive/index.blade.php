@extends('layouts.master', ['title' => 'archive', 'group' => $groups->first(), 'pageTitle' => 'Архив'])

@section('content')

<section class="orders">

    <div class="container">
        {{ $groups->links() }}
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
                    'id' => $order->id,
                ])

            @endforeach

        @endforeach

    @endif

    <div class="container">
        {{ $groups->links() }}
    </div>

</section>



{{-- @if($groups->count() <= 0)
        <div class="alert alert-danger" role="alert">
            Групп нет
        </div>
    @else
        @foreach($groups as $group)

            <div class="group">

                <div class="">
                    @include('orders.list.group-info', compact('group'))
                    <div class="clearfix"></div>
                </div>

                @if($group->orders->count() > 0)

                    <table class="table">
                        @include('orders.list.header')
                        @foreach($group->orders as $order)
                            @if($order->item)
                                <tr>
                                    @include('orders.list.item-info', compact('loop', 'order'))
                                    <td>
                                        @foreach($order->users as $user)
                                            @include('orders.list.user-info', compact('order', 'user'))
                                            {{ $user->pivotDeliveryInfo->getPrice() }}
                                            <br>
                                        @endforeach
                                        @include('orders.list.total', compact('order'))
                                    </td>
                                    <td>
                                        {{ $order->item->price }} {{ $order->item->currency }}
                                    </td>
                                    @include('orders.list.item-added-info', compact('order'))
                                </tr>
                            @endif
                        @endforeach
                    </table>

                @else

                    @include('orders.list.no-orders')

                @endif

            </div>

        @endforeach
    @endif

    {{ $groups->links() }} --}}

@endsection