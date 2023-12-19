@extends('layouts.layout')

@section('title')
    Форум
@endsection

@section('body')
    <div class="border border-secondary rounded m-2 p-3">
        @auth
            <form action="{{ @route('postNew') }}" method="post">
                @csrf
                <button class="btn btn-primary" >Новый пост</button>
            </form>
        @endauth
        @if (!empty($posts))
            @foreach ($posts as $post)
                <div class="rounded border-dark">
                    <a href="{{ route('seePost', ['id' => $post->id]) }}">
                        <h2>Тема: {{ $post->theme }}</h2>
                    </a>
                </div>
            @endforeach
        @else
            Постов пока нет
        @endif
    </div>
@endsection
