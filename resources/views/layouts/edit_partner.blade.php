@extends('index')
@section('title', 'Update Partner')
@section('content')
    <div style="width: 60%;margin:auto">
        <h3 class="text-center">Update Partner</h3>
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
                            echo 'Name Is Bigger Than 30 Characters';
                            break;
                        } elseif ($i == 'name-exists') {
                            echo 'This Name Is Already Exists';
                            break;
                        }
                    }
                @endphp
            </div>
        @endif
        <form action={{ route('update-partner', ['id' => $partner->partner_id]) }} method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name"
                    value="{{ isset($partner->name) ? $partner->name : old('name') }}" name="name" autofocus>
            </div>
            <input type="submit" value="Update Partner" class="btn btn-primary">
        </form>
    </div>
@endsection
