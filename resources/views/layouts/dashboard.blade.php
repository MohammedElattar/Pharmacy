@extends('index')

@section('title', 'Dashboard')
@section('content')
    This is Dashoard Content
@endsection
@section('active')
    <script>
        document.querySelector(".dashboard").classList.add("active")
    </script>
@endsection
