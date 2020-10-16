@extends('layouts.default')
@section('title','Them moi User')
@section('head')
@endsection
@section('main')
<div>
    @if(isset($data))
        <h1 style="text-align: center">Update user</h1>
        @foreach($data as $value)
        @endforeach
        <form action="{{ route('user.update', $value->id) }}" method="post">
            @method('PUT')
    @else
        <h1 style="text-align: center">Them moi user</h1>
        <form action="{{ route('user.store') }}" method="post">
    @endif
        <lable style="color: {{ $errors->has('name') ? "red" : "black" }}">Ho ten user</lable>
        <input type="text" name="name" style="border-color: {{ $errors->has('name') ? "red" : "black" }}" value="{{ !isset($data) ? "" : $value->name }}" /><br><br>
        @error('name')
            <lable style="color: red">{{ $errors->first('name') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('mail_address') ? "red" : "black" }}">Email</lable>
        <input type="text" name="mail_address" style="border-color: {{ $errors->has('mail_address') ? "red" : "black" }}" value="{{ !isset($data) ? "" : $value->mail_address }}" /><br><br>
        @error('mail_address')
            <lable style="color: red">{{ $errors->first('mail_address') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('address') ? "red" : "black" }}">Address</lable>
        <input type="text" name="address" style="border-color: {{ $errors->has('address') ? "red" : "black" }}" value="{{ !isset($data) ? "" : $value->address }}" /><br><br>
        @error('address')
            <lable style="color: red">{{ $errors->first('address') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('phone') ? "red" : "black" }}">Phone</lable>
        <input type="text" name="phone" style="border-color: {{ $errors->has('phone') ? "red" : "black" }}" value="{{ !isset($data) ? "" : $value->phone }}" /><br><br>
        @error('phone')
            <lable style="color: red">{{ $errors->first('phone') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('password') ? "red" : "black" }}">Password</lable>
        <input type="password" name="password" style="border-color: {{ $errors->has('password') ? "red" : "black" }}"/><br><br>
        @error('password')
            <lable style="color: red">{{ $errors->first('password') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('password_confirmation') ? "red" : "black" }}">Confirmation Password</lable>
        <input type="password" name="password_confirmation" style="border-color: {{ $errors->has('password_confirmation') ? "red" : "black" }}"/><br><br>
        @error('password_confirmation')
            <lable style="color: red">{{ $errors->first('password_confirmation') }}</lable><br><br>
        @enderror
        @csrf
        <input type="submit" value="{{ !isset($data) ? "Them moi" : "Cap nhat" }}"/>
    </form>
</div>
@endsection
