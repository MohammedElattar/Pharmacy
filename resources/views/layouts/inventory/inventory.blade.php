@extends('index')
@php
    $main_name = 'inventory';
    $message = 'Medicine Type';
    $title = 'Inventory';
@endphp
@section('title', $title)
@section('content')
    <div class="d-flex flex-row justify-content-between align-items-start mb-2">
        <h2 class="mb-4">{{ $title }}</h2>
    </div>
    <table id={{ $main_name }} style="width: 100%">
        <thead class="text-center">
            <tr>
                <td>ID</td>
                <td>Product Name</td>
                <td>Total Qty</td>
                <td>Sold</td>
                <td>Expired</td>
                <td>Available</td>
            </tr>
        <tbody>
            @foreach ($inventory as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        {{ $i->product_name }}
                    </td>
                    <td>
                        {{ $i->total_qty }}
                    </td>
                    <td>
                        {{ $i->sold }}
                    </td>
                    <td>
                        {{ $i->expired }}
                    </td>
                    <td>
                        {{ $i->available }}
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
    </script>
@endsection
