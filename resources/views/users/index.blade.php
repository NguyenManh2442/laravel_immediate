<html>
<head>
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
    </style>
</head>
<body>
<h1 style="text-align: center">user</h1>
<div style="text-align: center">
    <a type="button" class="btn btn-info" href="{{route('user.create')}}">Them moi</a>
</div>
<div id="table">
    @include('flash::message')
    <table>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone number</th>
        </tr>
        @foreach($user as $key => $value)
            <tr>
                <td>{{ $user->perPage() * ($user->currentPage() - 1) + (++$key) }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->mail_address }}</td>
                <td>{{ $value->address }}</td>
                <td>{{ $value->phone }}</td>
            </tr>
        @endforeach
    </table>
    <div style="text-align: center">{!! $user->render(); !!}</div>
</div>
</body>
</html>
