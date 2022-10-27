@extends('index')
@php

@endphp
@section('title', 'Logs')
@section('content')
    @php
        if (session()->has('log-deleted')) {
            echo '<div class="alert alert-success deleted-log">Log(s) Deleted Successfully</div>';
            session()->forget('log-updated');
        } elseif (session()->has('logs-deleted')) {
            echo '<div class="alert alert-danger deleted-logs">All Logs Have Been Deleted</div>';
            session()->forget('logs-updated');
        } elseif (session()->has('no-logs')) {
            echo '<div class="alert alert-info no-logs">No Logs To Delete</div>';
            session()->forget('no-logs');
        }
    @endphp
    <div class="d-flex flex-row justify-content-between align-items-start mb-2">
        <h2 class="mb-4">Logs</h2>
        <a href={{ route('delete-logs') }} class="btn btn-danger">Delete All</a>
    </div>
    <table id="logs" style="width: 100%">
        <thead class="text-center">
            <tr>
                <td>ID</td>
                <td>Details</td>
                <td>User ID</td>
                <td>Date</td>
                <td>Action</td>
            </tr>
        <tbody>
            @foreach ($logs as $i)
                <tr>
                    <td>
                        {{ $i->id }}
                    </td>
                    <td>
                        {{ $i->action }}
                    </td>
                    <td>
                        {{ $i->who }}
                    </td>
                    <td>
                        {{ $i->created_at }}
                    </td>
                    <td>
                        <a href={{ route('delete-log', ['id' => $i->id]) }} class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </thead>
    </table>
@endsection
@section('active')
    <script>
        document.querySelector(".logs").classList.add("active")
        $(document).ready(function() {
            $('#logs').DataTable();
        });
        setTimeout(() => {
            $(".deleted-log").css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(".deleted-logs").css("display", 'none')
        }, 2000);
        setTimeout(() => {
            $(".no-logs").css("display", 'none')
        }, 2000);
    </script>
@endsection
