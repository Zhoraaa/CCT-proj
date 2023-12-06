@extends('layouts.layout')

@section('title')
    {{ $post->theme }}
@endsection

@section('body')
    <div class="border border-secondary rounded m-2 p-3">
        @auth
            @if (auth()->user()->id === $post->author_id || auth()->user()->role < 3)
                <form action="{{ @route('postDelete', ['id' => $post->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-danger">Удалить пост</button>
                </form>
                <form action="{{ @route('postEdit', ['id' => $post->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-secondary">Редактировать пост</button>
                </form>
            @endif
        @endauth
        <h1>{{ $post->theme }}</h1>
        <span>{!! $post->text !!}</span>
    </div>
@endsection
