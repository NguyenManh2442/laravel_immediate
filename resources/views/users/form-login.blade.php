<html>
<head>

</head>
<body>
<div>
    <h1 style="text-align: center">Dang nhap</h1>
    <form action="{{ route('login') }}" method="post">

        <lable style="color: {{ $errors->has('mail_address') ? "red" : "black" }}">Email</lable>
        <input type="text" name="mail_address" style="border-color: {{ $errors->has('mail_address') ? "red" : "black" }}"/><br><br>
        @error('mail_address')
        <lable style="color: red">{{ $errors->first('mail_address') }}</lable><br><br>
        @enderror
        <lable style="color: {{ $errors->has('password') ? "red" : "black" }}">Password</lable>
        <input type="password" name="password" style="border-color: {{ $errors->has('password') ? "red" : "black" }}"/><br><br>
        @error('password')
        <lable style="color: red">{{ $errors->first('password') }}</lable><br><br>
        @enderror
        @csrf
        <input type="submit" value="Dang nhap"/>
    </form>
</div>
</body>
</html>
