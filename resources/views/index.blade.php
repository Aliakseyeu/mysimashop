<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('parts/head')
<body>

@include('parts/header')

<section class="notifications">
    <div class="container">
        <div class="row">
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis fugiat ratione accusamus velit sunt, quisquam inventore reprehenderit est optio ad id placeat debitis distinctio laborum aliquam dolor corrupti iure.</li>
                <li>Labore nobis culpa unde distinctio itaque ipsam rem beatae! Voluptatem recusandae architecto iusto, quaerat quia. Quia libero, in nulla deleniti perspiciatis, suscipit culpa et voluptatem iusto aperiam expedita consectetur voluptas.</li>
                <li>Voluptatum similique non libero quisquam illo at ex beatae quia veniam officia aliquam, natus nam commodi aliquid doloribus dolorum aperiam nemo earum quaerat omnis consequuntur accusantium! Quam excepturi exercitationem odit?</li>
            </ul>
        </div>
    </div>
</section>

<section class="orders">
    @foreach($groups as $group)
        @foreach($group->orders as $order)
            @if(!$order->item)
                @continue
            @endif
            @php $addForm = true; @endphp
            <div class="order">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <a href='https://sima-land.ru{{ $order->item->itemUrl }}' class='order__photo'>
                            <img src="{{ $order->item->img }}" alt="{{ $order->item->name }}" title="{{ $order->item->name }}">
                        </a>
                        <div class="order__info item {{-- d-flex flex-column --}}">
                            <div class="item__name">
                                <a href='https://sima-land.ru{{ $order->item->itemUrl }}'>{{ $order->item->name }}</a>
                            </div>
                            <div>
                                <span class="text-danger">Артикул: </span>{{ $order->item->sid }}</div>
                            <div class="item__price">
                                <span class="text-danger">Цена: </span>
                                    <a href="{{ url('/item/update/'.$order->item->id) }}" class="btn btn-sm btn-outline-{{ $order->item->isNew() ? 'success' : 'danger' }}">
                                    {{ $order->item->price }} {{ $order->item->currency }}
                                </a>
                            </div>
                            <div><span class="text-danger">Минимум: </span>{{ $order->item->min_qty }}{{ $order->item->pluralNameFormat }}</div>
                            <div><span class="text-danger">Создан: </span>{{ $order->created_at }}</div>
                        </div>
                        <div class="order__users users">
                            @foreach($order->users as $user)
                                {{ $user->full_name }} : <span class='qty'>{{ $user->pivot->qty }}</span> {{ $order->item->pluralNameFormat }} +
                                <a href="{{ url('/delivery/update/'.$user->pivot->id) }}" class="btn btn-sm btn-outline-{{ $user->pivotIsNew() ? 'success' : 'danger' }}">
                                    {{ $user->pivotDeliveryInfo->getPrice() }}
                                </a>
                                @if($user->id == Auth::id() || (Auth::user() && Auth::user()->isAdmin()))
                                    <span>
                                        <a href="#" data-id="{{ $user->pivot->id }}" class="order-edit" title='Редактировать'><i class="fa fa-pen"></i></a>
                                        <a href="{{ url('/order/destroy/'.$user->pivot->id) }}" title='Удалить'><i class="fa fa-trash"></i></a>
                                    </span>
                                @endif
                                @if($user->id == Auth::id())
                                    @php $addForm = false; @endphp
                                @endif
                                <br>
                            @endforeach
                            <div class="users__total alert alert-{{ $order->users()->sum('qty') >= $order->item->min_qty ? 'success' : 'danger' }}">
                                Итого: {{ $order->users()->sum('qty') }}
                            </div>
                            
                        </div>
                        <div class="order__create">
                            <form action='/order/store_exists' method='POST'>
                                @csrf
                                <input type='hidden' name='id' value='{{ $order->id }}'>
                                <input type='hidden' name='page' value='{{ Request::get('page', 1) }}'>
                                <input type='text' class="form-control form-control-sm" name='qty' placeholder='Количество' required>
                                <button class='btn btn-sm btn-primary' type='submit'>
                                    <i class="fas fa-plus"></i>
                                    <span class="responsive-hide">Добавить</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row order__more">
                        <a href="#" class="text-danger order__more_open"><i class="fas fa-chevron-down"></i></a>
                        <a href="#" class="text-danger order__more_close"><i class="fas fa-chevron-up"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</section>

@include('parts/footer')

</body>
</html>
