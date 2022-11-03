@extends('index')
@section('title', 'Database')
@section('content')
    <div class="container">
        <form action="{{ route('reset-tables') }}" method="POST" class="frm">
            @csrf
            <input type="submit" class="alert alert-danger reset-tables" value="Rest All Tables">
        </form>
    </div>
@endsection
@section('ajx')
    <script>
        let form = document.querySelector(".frm");
        form.addEventListener("click", function(e) {
            e.preventDefault();
            if (confirm("are u sure ? ")) {
                form.submit()
            }
        });
    </script>
@endsection
@section('active')
    <script>
        document.querySelector(".db").classList.add("active")
    </script>
@endsection
