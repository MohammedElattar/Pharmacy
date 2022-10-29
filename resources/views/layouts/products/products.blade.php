@extends('index')
@php
    $main_name = 'product';
    $message = 'Product';
    $title = 'Products';
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
                <td>Product Info</td>
                <td>Category</td>
                <td>Type</td>
                <td>Added</td>
                <td>Action</td>
            </tr>
        <tbody>
            @foreach ($products as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        Name : <span class="fw-b text-truncate">{{ $i->prod_name }}</span><br>
                        Description : <span class="text-truncate">{{ $i->prod_desc }}</span><br>
                        Concentration :<span class="text-truncate">{{ $i->conc }} mg</span><br>
                        {!! $i->recp ? 'Preception : <div class="badge bg-warning">This Product Require Preception</div>' : '' !!}
                    </td>
                    <td>{{ $i->cat }}</td>
                    <td>{{ $i->med_type }}</td>
                    <td>
                        {{ date('d/M/Y', strtotime($i->created_at)) }}
                    </td>
                    <td class="d-flex flex-column">
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
            $(@json('.edited-' . $main_name)).css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(@json('.deleted-' . $main_name)).css("display", 'none')
        }, 2000);
    </script>
@endsection
