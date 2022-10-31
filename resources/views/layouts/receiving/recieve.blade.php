@extends('index')
@php
    $main_name = 'receiving';
    $message = 'Receiving';
    $title = 'Receiving';
@endphp
@section('title', $title)
@section('content')
    @php
        if (session()->has("$main_name-added")) {
            echo "<div class='alert alert-success added-$main_name'>$message Addedd Successfully</div>";
            session()->forget("$main_name-added");
        } elseif (session()->has("$main_name-updated")) {
            echo "<div class='alert alert-success updated-$main_name'>$message Updated Successfully</div>";
            session()->forget("$main_name-updated");
        } elseif (session()->has("$main_name-deleted")) {
            echo "<div class='alert alert-success deleted-$main_name'>$message Deleted Successfully</div>";
            session()->forget("$main_name-updated");
        }
    @endphp
    <div class="d-flex flex-row justify-content-between align-items-start mb-2">
        <h2 class="mb-4">{{ $title }}</h2>
        <a href={{ route("add-$main_name") }} class="btn btn-primary">Add New {{ $message }} </a>
    </div>
    <table id={{ $main_name }} style="width: 100%">
        <thead class="text-center">
            <tr>
                <td>ID</td>
                <td>Details</td>
                <td>Supplier</td>
                <td>Exp</td>
                <td>Action</td>
            </tr>
        <tbody>
            @foreach ($receiving as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        Product : <span class="fw-b text-truncate">{{ $i->prod_name }}</span><br>
                        Qty : <span class="text-truncate">{{ $i->qty }}</span><br>
                        Total : <span class="text-truncate">{{ $i->price * $i->qty }}</span><br>
                    </td>
                    <td>
                        {{ $i->supp_name }}
                    </td>
                    <td>
                        {{ date('d-M-Y', strtotime($i->exp)) }}
                    </td>
                    <td class="d-flex flex-row justify-content-center">
                        <a href={{ route("edit-$main_name", ['id' => $i->id]) }} class="btn btn-success">Edit</a>
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
            $(@json('.added-' . $main_name)).css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(@json('.deleted-' . $main_name)).css("display", 'none')
        }, 2000);
    </script>
@endsection
