@extends('layouts.default')
@section('title','Danh sach')
@section('head')
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        #table {
            margin-left: 350px;
        }

        th {
            text-align: center;
        }

        td {
            padding: 10px;
        }
        #f-search{
            /*margin-left: 330px;*/
            /*margin-top: 50px;*/
            /*margin-top: 50px;*/
            margin: 50px 0px 50px 330px;
        }
        label{
            margin-left: 20px;
        }
    </style>
@endsection
@section('main')
<h1 style="text-align: center">Danh sach Users</h1>
<div id="f-search">
    <form action="{{route('user.index')}}" method="get">
        <label>Ten</label>
        <input type="text" name="s_name" value="{{ request()->s_name }}" />
        <label>Email</label>
        <input type="text" name="s_email" value="{{ request()->s_email }}" />
        <label>Phone</label>
        <input type="text" name="s_phone" value="{{ request()->s_phone }}" />
        <label>Dia chi</label>
        <input type="text" name="s_address" value="{{ request()->s_address }}" />
        @csrf
        <input type="submit" name="btn_search" value="Tim kiem" />
    </form>
</div>
<div style="text-align: center; margin-bottom: 50px">
    <a type="button" class="btn btn-info" href="{{ route('user.create') }}">Them moi</a>
</div>
<div id="table">
    @if ($user->total() < 1)
        <h2 style="color: red">Khong tim thay du lieu!</h2>
    @endif
    <table>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone number</th>
            <th>Hành động</th>
        </tr>
        @foreach($user as $key => $value)
            <tr>
                <td>{{ $user->perPage() * ($user->currentPage() - 1) + (++$key) }}</td>
                <td>{{ \HelperFacade::toUpperCase($value->name) }}</td>
                <td>{{ $value->mail_address }}</td>
                <td>{{ $value->address }}</td>
                <td>{{ $value->phone }}</td>
                <td><a type="button" class="btn btn-info" href="{{ route('user.edit', $value->id) }}">Edit</a></td>
            </tr>
        @endforeach
    </table>
    <div style="text-align: center">{!! $user->render(); !!}</div>
</div>
@endsection
