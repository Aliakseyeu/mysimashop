@extends('layouts.master', ['title' => 'groups'])

@section('content')

    <div class="container">
        
        <a href="/group/store" class="btn btn-success">Создать новую группу</a>

        <hr>

        @if($groups->count() > 0)
            <div class="groups">
                @foreach($groups as $group)
                    <div class="group">
                        <div class="group__info">Группа №{{ $id = $group->id }}. Создана: {{ $group->created_at }}</div>
                        <div class="group__comment">Комментарий: {{ $group->comment }}</div>
                        <div class="group__actions">
                            <a href="{{ url('/group/refresh/'.$id) }}" class="btn btn-secondary">Обновить всё</a>
                            <a href="{{ url('/report/'.$id) }}" class="btn btn-primary">Сделать отчет</a>
                            <a href="{{ url('/group/'.$id.'/show') }}" class="btn btn-success">Редактировать</a>
                            <a href="{{ url('/group/toCart/'.$id) }}" class="btn btn-warning" onclick="if(!confirm('Вы уверены что хотите отправить группу в корзину?')){return false;}">В корзину</a>
                            <a href="{{ url('/archive/store/'.$id) }}" class="btn btn-secondary " onclick="if(!confirm('Вы уверены что хотите перемесить группу в архив?')){return false;}">В архив</a>
                            <a href="{{ url('/group/destroy/'.$id) }}" class="btn btn-danger group__destroy" onclick="if(!confirm('Вы уверены что хотите удалить группу?')){return false;}title="Для удаления группы в ней не должно быть заказов.">Удалить группу</a>
                        </div>
                        <small class="text-muted">Пожалуйста, во избежание конфликтов, добавляте заказ в пустую корзину!</small>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

@endsection