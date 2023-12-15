@extends('layouts.layout')

@section('title')
    Редактирование товара
@endsection

@section('body')
    <form action="{{ @route('productSave') }}" method="POST" class="border border-secondary rounded m-2 p-3 form-auth">
        @csrf
        <input type="text" class="hide" name="post_id" value="{{ isset($product) ? $product->id : null }}">
        <div class="form-block-wrapper border border-secondary rounded">
            <input type="text" name="name" class="name-inp" placeholder="Наименование товара"
                value="{{ isset($product) ? $product->name : null }}">
        </div>
        <div class="form-block-wrapper border border-secondary rounded">
            <textarea name="description" id="tinyMCE" placeholder="Описание товара">
                {{ isset($product) ? $product->description : null }}
            </textarea>
        </div>
        <div class="form-block-wrapper border border-secondary rounded">
            <input type="number" name="cost" class="" placeholder="Тема поста..."
                value="{{ isset($product) ? $product->cost : null }}">
        </div>
        <div class="form-block-wrapper border border-secondary rounded">
            <input type="file" name="covers" multiple>
        </div>
        <div class="form-block-wrapper">
            <button type="submit" class="btn btn-primary">Опубликовать</button>
        </div>
    </form>
@endsection
