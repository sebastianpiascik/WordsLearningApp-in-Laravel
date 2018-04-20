@extends('layouts.app')

@section('title', 'CRUD - Uzytkownicy')

@section('sidebar')
    @parent

    <h2 class="page__title"><strong>CRUD</strong> - Uzytkownicy</h2>
@endsection


@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Login</th>
            <th>E-mail</th>
            <th>Rola</th>
            <th width="150px">Akcja</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->last()->name }}</td>
                <td>
                    <form class="form--actions" action="{{ route('users.destroy',$user->id) }}" method="POST">
                        <a class="" href="/users/{{ $user->id }}"><i class="fas fa-eye"></i></a>
                        <a class="" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=""><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>




@endsection