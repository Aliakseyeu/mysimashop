@extends('layouts.master', ['title' => 'index'])

@section('content')

    <div class="container">

        <hr>

        <form action='/group/update' method='POST' class='form'>
            @csrf
            <input type='hidden' name='id' value='{{ $group->id }}'>
            <input type='hidden' name='page' value='{{ Request::get('page') ?? 1 }}'>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <input type='text' class="form-control" name='comment' value='{{ $group->comment }}' placeholder='Комментарий'>
                <small id="comment-help" class="form-text text-muted">Пожалуйста введите комментарий к группе и нажмите "Сохранить"</small>
            </div>
            <button class='btn btn-primary' type='submit'>Сохранить</button>
        </form>

        <hr>

    </div>

@endsection