@extends('index')
@php
    $main_name = 'exp_prod';
    $message = 'Expired Product';
    $title = 'Products';
@endphp
@section('title', $title)
@section('content')
    @php
        if (session()->has("$main_name-deleted")) {
            echo "<div class='alert alert-success deleted-$main_name'>$message Deleted Successfully</div>";
            session()->forget("$main_name-deleted");
        }
    @endphp
    <div class="d-flex flex-row justify-content-between align-items-start mb-2">
        <h2 class="mb-4">{{ $title }}</h2>
    </div>
    <table id={{ $main_name }} style="width: 100%">
        <thead class="text-center">
            <tr>
                <td>Product ID</td>
                <td>Product Name</td>
                <td>Medicine Type</td>
                <td>Medicine Category</td>
                <td>Action</td>
            </tr>
        <tbody>
            @foreach ($expired_products as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        {{ $i->name }}
                    </td>
                    <td>{{ $i->cat }}</td>
                    <td>{{ $i->type }}</td>
                    <td class="d-flex flex-column">
                        <a href={{ route("delete-$main_name", ['id' => $i->id]) }} class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
@endsection
@section('active')
    <script>
        document.querySelector(@json('.' . $main_name)).classList.add("active")
        $(document).ready(function() {
            $(@json('#' . $main_name)).DataTable();
        });
        setTimeout(() => {
            $(@json('.deleted-' . $main_name)).css("display", 'none')
        }, 2000);
    </script>
@endsection
