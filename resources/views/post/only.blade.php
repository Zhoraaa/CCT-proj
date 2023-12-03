@extends('layouts.layout')

@section('title')
{{ $post->theme }}
@endsection

@section('body')
    <div class="border border-secondary rounded m-2 p-3">
        <h1>{{ $post->theme }}</h1>
        <span>{!! $post->text !!}</span>
    </div>
@endsection