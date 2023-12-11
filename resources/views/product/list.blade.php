@extends('layouts.layout')

@section('title')
    Каталог
@endsection

@section('body')
    <div class="border border-secondary rounded m-2 p-3">
        @auth
            @if (auth()->user()->role < 2)
                <form action="{{ @route('productNew') }}" method="post">
                    @csrf
                    <button class="btn btn-primary">Новый товар</button>
                </form>
            @endif
        @endauth
    </div>
@endsection
