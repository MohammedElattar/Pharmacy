<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css"
        integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Login</title>
    {{-- @includeWhen($title != 'login', 'header_scripts.scripts') --}}
</head>

<body>

    <div class="container">
        <h2 class="text-center">Login</h2>
        @php
            if (session()->has('not-exists')) {
                echo '<div class="alert alert-danger text-center">Email Or Password Are Wrong Check Them Again</div>';
                session()->forget('not-exists');
            }
        @endphp
        @if ($errors->any())
            <div class="text-center">
                @foreach ($errors->all() as $i)
                    @if ($i == 'empty-email')
                        <div class="alert alert-danger">Email Cannot Be Empty</div>
                    @elseif ($i == 'valid-email')
                        <div class="alert alert-danger">Must be A Valid Email</div>
                    @elseif($i == 'empty-password')
                        <div class="alert alert-danger">Password Cannot Be Empty</div>
                    @endif
                @endforeach
            </div>
        @endif
        <form action="{{ route('auth-user') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                    value="{{ isset($data['email']) ? $data['email'] : old('email') }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
