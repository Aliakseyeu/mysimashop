@extends('item.master', ['group' => $group])

@section('data')

    <hr>
    <div class="">
        <form action='/item/show' method='post' id='create-order'>
            @csrf
            <input type="hidden" name="group" id='group' value="{{ $group->id }}">
            <input type="hidden" name="page" id='page' value="{{ Request::get('page', 1) }}">
            <div class="form-group">
                <label for="sid">Артикул</label>
                <input type="text" name='sid' class="form-control" id="sid" aria-describedby="sid" placeholder="Артикул" required>
                <small id="sid-help" class="form-text text-muted">Пожалуйста введите артикул товара и нажмите кнопку "Найти"</small>
                <div id="item-result"></div>
            </div>
            <div class="form-group">
                <button class='btn btn-primary find-article' type="submit">Найти</button>
            </div>
        </form>
    </div>
    <hr>

@endsection