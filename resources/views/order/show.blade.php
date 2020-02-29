@php $addForm = true; @endphp

<div class="order" id="order{{ $iteration = !empty($loop) ? $loop->iteration : 1 }}">

    <div class="container">

        <div class="row d-flex justify-content-between">

            <div class="order__number text-danger">
                {{ $iteration ?? 1 }}
            </div>

            <div class='order__photo'>
                <a href='https://sima-land.ru{{ $item->itemUrl }}'>
                    <img src="{{ $item->img }}" alt="{{ $item->name }}" title="{{ $item->name }}">
                </a>
            </div>

            <div class="order__info item">

                <div class="item__name">
                    <a href='https://sima-land.ru{{ $item->itemUrl }}'>{{ $item->name }}</a>
                </div>

                <div>
                    <span class="text-danger">Артикул: </span>{{ $item->sid }}
                </div>

                <div class="item__price">
                    <span class="text-danger">Цена: </span>
                    <a href="{{ url('/item/update/'.$item->id) }}" class="btn btn-sm btn-outline-{{ $item->isNew() ? 'success' : 'danger' }}">
                        {{ $item->price }} {{ $item->currency }}
                    </a>
                </div>

                <div>
                    <span class="text-danger">Минимум: </span>{{ $item->min_qty }}{{ $item->pluralNameFormat }}
                </div>

                @if(!empty($order))
                    <div><span class="text-danger">Создан: </span>{{ $order->created_at }}</div>
                @endif
            </div>

            <div class="order__users users add-collapse"  id="order_{{ $id }}">
                @if(!empty($users) && $users->count() > 0)

                    @foreach($users as $user)
                        <div>
                            {{ $user->full_name }} : <span class='qty'>{{ $user->pivot->qty }}</span> {{ $item->pluralNameFormat }} +
                            <a href="{{ url('/delivery/update/'.$user->pivot->id) }}" class="btn btn-sm btn-outline-{{ $user->pivotIsNew() ? 'success' : 'danger' }}">
                                {{ $user->pivotDeliveryInfo->getPrice() }}
                            </a>
                            @if(($user->id == Auth::id() || (Auth::user() && Auth::user()->isAdmin())) && !empty($action))
                                <span class="users__actions">
                                    <a href="#" data-id="{{ $user->pivot->id }}" data-anchor="{{ $iteration }}"class="order-edit" title='Редактировать'><i class="fas fa-pen"></i></a>
                                    <a href="{{ url('/order/destroy/'.$user->pivot->id.'#order'.(($users->count() > 1) ? $iteration : ($iteration-1))) }}" title='Удалить' onclick="if(!confirm('Вы уверены что хотите удалить заказ?')){return false;}"><i class="fas fa-trash"></i></a>
                                </span>
                            @endif
                            @if($user->id == Auth::id())
                                @php $addForm = false; @endphp
                            @endif
                        </div>

                    @endforeach
                    
                    <div class="users__total alert alert-{{ $users->sum('pivot.qty') >= $item->min_qty ? 'success' : 'danger' }}">
                        Итого: {{ $users->sum('pivot.qty') }}
                    </div>

                @else

                    <div class="alert alert-info">
                        Вы будете первым
                    </div>

                @endif
            </div>

            <div class="order__create">
                @if(!empty($action))
                    @if($addForm)
                        <form action='{{ $action }}' method='POST'>
                            @csrf
                            <input type='hidden' name='id' value='{{ $id }}'>
                            <input type='hidden' name='anchor' value='#order{{ $iteration }}'>
                            <input type='hidden' name='group' value='{{ $group->id }}'>
                            <input type='hidden' name='page' value='{{ Request::get('page', 1) }}'>
                            <input type='text' class="form-control form-control-sm" name='qty' placeholder='Количество' required>
                            <button class='btn btn-sm btn-primary' type='submit'>
                                <i class="fas fa-plus"></i>
                                <span class="responsive-hide">Добавить</span>
                            </button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-danger">
                        Товар в архиве
                    </div>
                @endif
            </div>      

        </div>

        <div class="row order__more">
            <a class="" data-toggle="collapse" href="#order_{{ $id }}" role="button" aria-expanded="false" aria-controls="order_{{ $id }}">
                Открыть / Закрыть
            </a>
        </div>

    </div>

</div>

{{-- <div class="order" id="order{{ $iteration = !empty($loop) ? $loop->iteration : 1 }}">

    <div class="container">

        <div class="row d-flex justify-content-between">

            <div class="order__number text-danger">
                {{ $iteration ?? 1 }}
            </div>

            <a href='https://sima-land.ru{{ $item->itemUrl }}' class='order__photo'>
                <img src="{{ $item->img }}" alt="{{ $item->name }}" title="{{ $item->name }}">
            </a>

            <div class="order__info item">
                <div class="item__name">
                    <a href='https://sima-land.ru{{ $item->itemUrl }}'>{{ $item->name }}</a>
                </div>

                <div>
                    <span class="text-danger">Артикул: </span>{{ $item->sid }}
                </div>

                <div class="item__price">
                    <span class="text-danger">Цена: </span>
                    <a href="{{ url('/item/update/'.$item->id) }}" class="btn btn-sm btn-outline-{{ $item->isNew() ? 'success' : 'danger' }}">
                        {{ $item->price }} {{ $item->currency }}
                    </a>
                </div>

                <div>
                    <span class="text-danger">Минимум: </span>{{ $item->min_qty }}{{ $item->pluralNameFormat }}
                </div>

                @if(!empty($order))
                    <div><span class="text-danger">Создан: </span>{{ $order->created_at }}</div>
                @endif
            </div>

            <div class="order__users users">
                @if(!empty($users) && $users->count() > 0)

                    @foreach($users as $user)
                        <div>
                            {{ $user->full_name }} : <span class='qty'>{{ $user->pivot->qty }}</span> {{ $item->pluralNameFormat }} +
                            <a href="{{ url('/delivery/update/'.$user->pivot->id) }}" class="btn btn-sm btn-outline-{{ $user->pivotIsNew() ? 'success' : 'danger' }}">
                                {{ $user->pivotDeliveryInfo->getPrice() }}
                            </a>
                            @if(($user->id == Auth::id() || (Auth::user() && Auth::user()->isAdmin())) && !empty($action))
                                <span class="users__actions">
                                    <a href="#" data-id="{{ $user->pivot->id }}" data-anchor="{{ $iteration }}"class="order-edit" title='Редактировать'><i class="fas fa-pen"></i></a>
                                    <a href="{{ url('/order/destroy/'.$user->pivot->id.'#order'.(($users->count() > 1) ? $iteration : ($iteration-1))) }}" title='Удалить' onclick="if(!confirm('Вы уверены что хотите удалить заказ?')){return false;}"><i class="fas fa-trash"></i></a>
                                </span>
                            @endif
                            @if($user->id == Auth::id())
                                @php $addForm = false; @endphp
                            @endif
                        </div>

                    @endforeach
                    
                    <div class="users__total alert alert-{{ $users->sum('pivot.qty') >= $item->min_qty ? 'success' : 'danger' }}">
                        Итого: {{ $users->sum('pivot.qty') }}
                    </div>

                @else

                    <div class="alert alert-info">
                        Вы будете первым
                    </div>

                @endif
            </div>

            <div class="order__create">
                @if(!empty($action))
                    @if($addForm)
                        <form action='{{ $action }}' method='POST'>
                            @csrf
                            <input type='hidden' name='id' value='{{ $id }}'>
                            <input type='hidden' name='anchor' value='#order{{ $iteration }}'>
                            <input type='hidden' name='group' value='{{ $group->id }}'>
                            <input type='hidden' name='page' value='{{ Request::get('page', 1) }}'>
                            <input type='text' class="form-control form-control-sm" name='qty' placeholder='Количество' required>
                            <button class='btn btn-sm btn-primary' type='submit'>
                                <i class="fas fa-plus"></i>
                                <span class="responsive-hide">Добавить</span>
                            </button>
                        </form>
                    @endif
                @else
                    <div class="alert alert-danger">
                        Товар в архиве
                    </div>
                @endif
            </div>      

        </div>

        <div class="row order__more">
            <a href="#" class="text-danger order__more_open"><i class="fas fa-chevron-down"></i></a>
            <a href="#" class="text-danger order__more_close"><i class="fas fa-chevron-up"></i></a>
        </div>

    </div>

</div> --}}