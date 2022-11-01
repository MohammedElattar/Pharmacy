@extends('index')
@section('title', 'Update User')
@section('content')
    <div style="width: 60%;margin:auto">
        <h3 class="text-center">Update User</h3>
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @php
                    foreach ($errors->all() as $i) {
                        if ($i == 'name-required') {
                            echo 'Name Cannot Be Empty';
                            break;
                        } elseif ($i == 'name-valid') {
                            echo 'Name Must Have Alpha Characters Only';
                            break;
                        } elseif ($i == 'name-big') {
                            echo 'Name Is Bigger Than 20 Characters';
                            break;
                        } elseif ($i == 'email-required') {
                            echo 'Email Cannot Be Empty';
                            break;
                        } elseif ($i == 'email-valid') {
                            echo 'Type A Valid Email';
                            break;
                        } elseif ($i == 'email-exists') {
                            echo 'This Email Is Already In Use';
                            break;
                        } elseif ($i == 'pass-required') {
                            echo 'Password Cannot Be Empty';
                            break;
                        } elseif ($i == 'pass-between') {
                            echo 'Password Must Be Between 8 and 10 characters';
                            break;
                        }
                    }
                @endphp
            </div>
        @endif
        <form action={{ route('update-user', ['id' => $user->id]) }} method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name"
                    value="{{ isset($user->name) ? $user->name : old('name') }}" name="name" autofocus>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email"
                    value="{{ isset($user->email) ? $user->email : old('email') }}" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Select Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="2" {{ $user->role == '2' ? 'selected' : '' }}>Admin</option>
                    <option value="1" {{ $user->role == '1' ? 'selected' : '' }}>Cachier</option>
                </select>
            </div>
            <input type="submit" value="Update User" class="btn btn-primary">
        </form>
    </div>
@endsection
@section('active')
    <script>
        document.querySelector(".users").classList.add("active")
    </script>
@endsection
