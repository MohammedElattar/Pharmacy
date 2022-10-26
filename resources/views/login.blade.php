@include('header.header', ['title' => 'Login'])
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
    <form action="auth-user" method="POST">
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
    </?>
    @include('footer')
