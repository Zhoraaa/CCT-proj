@extends('layouts.layout')

@section('title')
    Администрирование
@endsection

@php
    $users = $data['users'];
    $roles = $data['roles'];
@endphp

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
                        <form action="" method="post">
                            @csrf
                            <select name="" id="">
                                <option value="" disabled>Кем назначить?</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </form>
                        <form action="" method="post">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>

    <div class="m-2">
        {{ $users->links() }}
    </div>
@endsection
