@extends('layouts.app')

@section('body')
    
    <div class="container">
        <div class="report__order">Заказ № {{ $group->id }}</div>
        <div class="report__rate">
            Курс
            <input type="text" name="rate" class="report-rate">
        </div>

        @php $totalAll = 0 @endphp
        @foreach($report->getUsers() as $user)

            <div class="report__user alert alert-primary">
                {{ $loop->iteration }}. {{ $user->fullName }}
            </div>

            @php $totalOrder = 0 @endphp
            @foreach($user->ordersByGroup($group->id)->get() as $order)

                @if($order->item)
                    <div class="report__item-name">{{ $order->item->name }}</div>
                    <div class="report__item-info">
                        <div><span class="text-danger">Артикул:</span> {{ $order->item->sid }}</div>
                        <div><span class="text-danger">Цена:</span> {{ $order->item->price }}</div>
                        <div><span class="text-danger">Количество:</span> {{ $order->pivot->qty }}</div>
                        <div><span class="text-danger">Сумма:</span> {{ $sum = $order->item->price * $order->pivot->qty }}</div>
                        <div><span class="text-danger">Доставка:</span> {{ $order->pivot->delivery }}</div>
                        <div><span class="text-danger">Итого:</span> {{ $total = $sum + (float)$order->pivot->delivery }}</div>
                        @php $totalOrder += $total @endphp
                    </div>
                @else
                    <div>Информация о товаре отсутствует!</div>
                @endif
            @endforeach

            <div class="report__user-topay">
                <span class="userSum alert alert-success">К оплате:&nbsp;
                    <span class='ru'>{{ $totalOrder }} RUB</span>
                    <span class='by'></span>
                    @php $totalAll += $totalOrder @endphp
                </span>
            </div>

        @endforeach

        <div>
            К оплате за группу:
            <div class="report__total-topay">
                <div class="ru">{{ $totalAll }}</div>
                <div class="by"></div>
            </div>
        </div>
    </div>





    {{--<table class="report-table table table-sm table-borderless table-striped">--}}
        {{--<tr>--}}
            {{--<th>#</th>--}}
            {{--<th>Заказчик/Название</th>--}}
            {{--<th>Артикул</th>--}}
            {{--<th>Цена</th>--}}
            {{--<th>Количество</th>--}}
            {{--<th>Сумма</th>--}}
            {{--<th>Доставка</th>--}}
            {{--<th>Итого</th>--}}
        {{--</tr>--}}
        {{--@php $totalAll = 0 @endphp--}}
        {{--@foreach($report->getUsers() as $user)--}}
            {{--<tr>--}}
                {{--<td>{{ $loop->iteration }}</td>--}}
                {{--<td>--- {{ $user->fullName }}</td>--}}
                {{--<td>Позиций</td>--}}
                {{--<td>{{ $user->orders->count() }}</td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
                {{--<td></td>--}}
            {{--</tr>--}}
            {{--@php $totalOrder = 0 @endphp--}}
            {{--@foreach($user->ordersByGroup($group->id)->get() as $order)--}}
                {{--<tr>--}}
                    {{--@if($order->item)--}}
                        {{--<td></td>--}}
                        {{--<td>--}}
                            {{--{{ str_limit($order->item->name, $limit = 50, $end = '...') }}--}}
                        {{--</td>--}}
                        {{--<td>{{ $order->item->sid }}</td>--}}
                        {{--<td>{{ $order->item->price }}</td>--}}
                        {{--<td>{{ $order->pivot->qty }}</td>--}}
                        {{--<td>{{ $sum = $order->item->price * $order->pivot->qty }}</td>--}}
                        {{--<td>{{ $order->pivot->delivery }}</td>--}}
                        {{--<td>{{ $total = $sum + (float)$order->pivot->delivery }}</td>--}}
                        {{--@php $totalOrder += $total @endphp--}}
                    {{--@else--}}
                        {{--<td colspan=7>Информация о товаре отсутствует</td>--}}
                    {{--@endif--}}
                {{--</tr>--}}
            {{--@endforeach--}}
            {{--<tr>--}}
                {{--<td colspan="5"></td>--}}
                {{--<td colspan="2">Итого:</td>--}}
                {{--<td class="userSum">--}}
                    {{--<div class='ru'>{{ $totalOrder }}</div>--}}
                    {{--<div class='by'></div>--}}
                    {{--@php $totalAll += $totalOrder @endphp--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
        {{--<tr>--}}
            {{--<td colspan="5"></td>--}}
            {{--<td colspan="2">К оплате</td>--}}
            {{--<td class="totalSum">--}}
                {{--<div class="ru">{{ $totalAll }}</div>--}}
                {{--<div class="by"></div>--}}
            {{--</td>--}}
        {{--</tr>--}}
    {{--</table>--}}
@endsection