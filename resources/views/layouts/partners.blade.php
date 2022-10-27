@extends('index')
@php

@endphp
@section('title', 'Partners')
@section('content')
    @php
        if (session()->has('partner-added')) {
            echo '<div class="alert alert-success added-partner">Partner Addedd Successfully</div>';
            session()->forget('partner-added');
        } elseif (session()->has('partner-updated')) {
            echo '<div class="alert alert-success edited-partner">Partner Updated Successfully</div>';
            session()->forget('partner-updated');
        } elseif (session()->has('partner-deleted')) {
            echo '<div class="alert alert-success deleted-partner">Partner Deleted Successfully</div>';
            session()->forget('partner-updated');
        }
    @endphp
    <div class="d-flex flex-row justify-content-between align-items-start mb-2">
        <h2 class="mb-4">Partners</h2>
        <a href={{ route('add-partner') }} class="btn btn-primary">Add Partner</a>
    </div>
    <table id="partners" style="width: 100%">
        <thead class="text-center">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Joined At</td>
                <td>Action</td>
            </tr>
        <tbody>
            @foreach ($partners as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        {{ $i->name }}
                    </td>
                    <td>
                        {{ $i->created_at }}
                    </td>
                    <td>
                        <a href={{ route('edit-partner', ['id' => $i->id]) }} class="btn btn-success">Edit</a>
                        <a href={{ route('delete-partner', ['id' => $i->id]) }} class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
@endsection
@section('active')
    <script>
        document.querySelector(".partners").classList.add("active")
        $(document).ready(function() {
            $('#partners').DataTable();
        });
        setTimeout(() => {
            $(".added-partner").css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(".edited-partner").css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(".deleted-partner").css("display", 'none')
        }, 2000);
    </script>
@endsection
