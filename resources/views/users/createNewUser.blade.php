<html>
<head>

</head>
<body>
<div>
    <h1 style="text-align: center">Them moi user</h1>
    <form action="{{ route('user.store') }}" method="post">

        <lable style="color: {{$errors->has('name') ? "red" : "black"}}">Ho ten user</lable>
        <input type="text" name="name" style="border-color: {{$errors->has('name') ? "red" : "black"}}"/><br><br>
        @if($errors->has('name'))
            <lable style="color: red">{{$errors->first('name')}}</lable><br><br>
        @endif
        <lable style="color: {{$errors->has('mail_address') ? "red" : "black"}}">Email</lable>
        <input type="text" name="mail_address"
               style="border-color: {{$errors->has('mail_address') ? "red" : "black"}}"/><br><br>
        @if($errors->has('mail_address'))
            <lable style="color: red">{{$errors->first('mail_address')}}</lable><br><br>
        @endif
        <lable style="color: {{$errors->has('address') ? "red" : "black"}}">Address</lable>
        <input type="text" name="address" style="border-color: {{$errors->has('address') ? "red" : "black"}}"/><br><br>
        @if($errors->has('address'))
            <lable style="color: red">{{$errors->first('address')}}</lable><br><br>
        @endif
        <lable style="color: {{$errors->has('phone') ? "red" : "black"}}">Phone</lable>
        <input type="text" name="phone" style="border-color: {{$errors->has('phone') ? "red" : "black"}}"/><br><br>
        @if($errors->has('phone'))
            <lable style="color: red">{{$errors->first('phone')}}</lable><br><br>
        @endif
        <lable style="color: {{$errors->has('password') ? "red" : "black"}}">Password</lable>
        <input type="password" name="password"
               style="border-color: {{$errors->has('password') ? "red" : "black"}}"/><br><br>
        @if($errors->has('password'))
            <lable style="color: red">{{$errors->first('password')}}</lable><br><br>
        @endif
        <lable style="color: {{$errors->has('password_confirmation') ? "red" : "black"}}">Confirmation Password</lable>
        <input type="password" name="password_confirmation"
               style="border-color: {{$errors->has('password_confirmation') ? "red" : "black"}}"/><br><br>
        @if($errors->has('password_confirmation'))
            <lable style="color: red">{{$errors->first('password_confirmation')}}</lable><br><br>
        @endif
        @csrf
        <input type="submit" value="Them moi"/>
    </form>
</div>
</body>
</html>
