@extends('layouts.layout')

@section('title')
    {{ $post->theme }}
@endsection

@section('body')
    @auth
        @if (auth()->user()->id === $post->author_id || auth()->user()->role < 3)
            <form action="{{ @route('postDelete', ['id' => $post->id]) }}" method="post">
                @csrf
                <button class="btn btn-danger m-2">Удалить пост</button>
            </form>
            <form action="{{ @route('postEdit', ['id' => $post->id]) }}" method="post">
                @csrf
                <button class="btn btn-secondary m-2">Редактировать пост</button>
            </form>
        @endif
    @endauth

    <div class="border border-secondary rounded m-2 p-3">
        <h1>{{ $post->theme }}</h1>
        <span>{!! $post->text !!}</span>
    </div>

    @auth
        <form action="{{ @route('postReply', ['id' => $post->id]) }}" method="post">
        @csrf
        <button class="btn btn-primary m-2">Продолжить ветку</button>
        </form>
    @endauth
@endsection
