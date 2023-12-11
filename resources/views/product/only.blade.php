@extends('layouts.layout')

@section('title')
    {{ $product->name }}
@endsection

@section('body')
    <div class="border border-secondary rounded m-2 p-3">
        @auth
            @if (auth()->user()->role < 2)
                <form action="{{ @route('productDelete', ['id' => $product->id]) }}" method="product">
                    @csrf
                    <button class="btn btn-danger">Удалить пост</button>
                </form>
                <form action="{{ @route('productEdit', ['id' => $product->id]) }}" method="product">
                    @csrf
                    <button class="btn btn-secondary">Редактировать пост</button>
                </form>
            @endif
        @endauth
        <h1>{{ $product->name }}</h1>
        <span>{!! $product->description !!}</span>
    </div>
@endsection
