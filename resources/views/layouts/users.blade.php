@extends('index')

@section('title', 'Users')
@section('content')
    @php
        if (session()->has('user-added')) {
            echo '<div class="alert alert-success added-user">User Addedd Successfully</div>';
            session()->forget('user-added');
        } elseif (session()->has('user-updated')) {
            echo '<div class="alert alert-success edited-user">User Updated Successfully</div>';
            session()->forget('user-updated');
        } elseif (session()->has('user-deleted')) {
            echo '<div class="alert alert-success deleted-user">User Deleted Successfully</div>';
            session()->forget('user-updated');
        }
    @endphp
    <div class="d-flex flex-row justify-content-between align-items-start mb-2">
        <h2 class="mb-4">Users</h2>
        <a href={{ route('add-user') }} class="btn btn-primary">Add User</a>
    </div>
    <table id="users" style="width: 100%">
        <thead class="text-center">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Joined At</td>
                <td>Action</td>
            </tr>
        <tbody>
            @foreach ($users_data as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        {{ $i->name }}
                    </td>
                    <td>
                        {{ $i->email }}
                    </td>
                    <td>
                        {{ $i->role == 0 ? 'Customer' : ($i->role == 1 ? 'Cacheir' : 'Admin') }}
                    </td>
                    <td>
                        {{ $i->created_at }}
                    </td>
                    <td>
                        <a href={{ route('edit-user', ['id' => $i->id]) }} class="btn btn-success">Edit</a>
                        <a href={{ route('delete-user', ['id' => $i->id]) }} class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
@endsection
@section('active')
    <script>
        document.querySelector(".users").classList.add("active")
        $(document).ready(function() {
            $('#users').DataTable();
        });
        setTimeout(() => {
            $(".added-user").css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(".edited-user").css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(".deleted-user").css("display", 'none')
        }, 2000);
    </script>
@endsection
