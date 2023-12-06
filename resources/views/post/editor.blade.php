@extends('layouts.layout')

@section('title')
    Редактирование поста
@endsection

@section('body')
    <form action="{{ @route('savePost') }}" method="POST" class="border border-secondary rounded m-2 p-3 form-auth">
        @csrf
        <div class="form-block-wrapper border border-secondary rounded">
            <input type="text" name="theme" class="theme-inp" placeholder="Тема поста...">
        </div>
        <div class="form-block-wrapper border border-secondary rounded">
            <textarea name="text" id="tinyMCE" placeholder="Текст поста...">
        </textarea>
        </div>
        <div class="form-block-wrapper">
            <button type="submit" class="btn btn-primary">Опубликовать</button>
        </div>
    </form>
@endsection
