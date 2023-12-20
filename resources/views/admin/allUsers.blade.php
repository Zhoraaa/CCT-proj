@extends('layouts.layout')

@section('title')
    Администрирование
@endsection

@section('body')
    @if (session('success'))
        <div class="alert alert-success m-2" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger m-2" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ник</th>
                <th scope="col">Почта</th>
                <th scope="col">Роль</th>
                <th scope="col">Взаимодействие</th>
            </tr>
        </thead>
        <tbody>
            @php
                $num = 1;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        Кнопки
                    </td>
                </tr>
            @endforeach
    </table>
    
    <div class="m-2">
        {{ $users->links() }}
    </div>
@endsection
