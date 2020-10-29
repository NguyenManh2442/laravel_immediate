@extends('layouts.default')
@section('title','Them moi User')
@section('head')
@endsection
@section('main')
<div>
    @if (isset($data))
        <h1 style="text-align: center">Update user</h1>
        <form action="{{ route('user.update', $data[0]->id) }}" method="post">
            @method('PUT')
    @else
        <h1 style="text-align: center">Them moi user</h1>
        <form action="{{ route('user.store') }}" method="post">
    @endif
        <lable style="color: {{ $errors->has('name') ? "red" : "black" }}">Ho ten user</lable>
        <input type="text" name="name" style="border-color: {{ $errors->has('name') ? "red" : "black" }}" value="{{ old('name', $data[0]->name ?? null) }}" /><br><br>
        @error('name')
            <lable style="color: red">{{ $errors->first('name') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('mail_address') ? "red" : "black" }}">Email</lable>
        <input type="text" name="mail_address" style="border-color: {{ $errors->has('mail_address') ? "red" : "black" }}" value="{{ old('mail_address', $data[0]->mail_address ?? null) }}" /><br><br>
        @error('mail_address')
            <lable style="color: red">{{ $errors->first('mail_address') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('address') ? "red" : "black" }}">Address</lable>
        <input type="text" name="address" style="border-color: {{ $errors->has('address') ? "red" : "black" }}" value="{{ old('address', $data[0]->address ?? null) }}" /><br><br>
        @error('address')
            <lable style="color: red">{{ $errors->first('address') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('phone') ? "red" : "black" }}">Phone</lable>
        <input type="text" name="phone" style="border-color: {{ $errors->has('phone') ? "red" : "black" }}" value="{{ old('phone', $data[0]->phone ?? null) }}" /><br><br>
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
        <label>Input</label>
        <select name="role">
            <option value="{{ \user::ADMIN }}" {{ old('role') == \user::ADMIN || isset($data) && $data[0]->role == \user::ADMIN ? 'selected' : null }} >{{ \user::ROLE[\user::ADMIN] }}</option>
            <option value="{{ \user::EMPLOYEE }}" {{ old('role') == \user::EMPLOYEE || isset($data) && $data[0]->role == \user::EMPLOYEE ? 'selected' : null }} >{{ \user::ROLE[\user::EMPLOYEE] }}</option>
        </select><br><br>
        <label>Lớp</label>
        <select name="classroom">
            @foreach($class as $value)
                <option value="{{ $value->id }}" {{ old('classroom') == $value->id || isset($data) && $data[0]->classroom_id == $value->id ? 'selected' : null }}>{{ $value->name }}</option>
            @endforeach
        </select><br><br>
        @csrf
        <input type="submit" value="{{ !isset($data) ? "Them moi" : "Cap nhat" }}"/>
    </form>
</div>
@endsection
