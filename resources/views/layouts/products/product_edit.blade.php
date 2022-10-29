@extends('index')
@php
    $main_name = 'product';
    $message = 'Product';
    $title = 'Edit Product';
    $data = session()->get('data');
    $error = session()->get('error');
    if (isset($data) && !$data) {
        unset($data);
    }
    if (isset($error) && !$error) {
        unset($error);
    }
@endphp
@section('title', "Edit $message")
@section('content')
    <div style="width: 60%;margin:auto">
        <h3 class="text-center">Edit {{ $message }}</h3>
        @if ($errors->any() || isset($error))
            {{ $errors }}
            <div class="alert alert-danger text-center">
                @if ($error == 'cat-not-exists')
                    Category doesn't exists
                @elseif ($error == 'type-not-exists')
                    Type Doesn't Exists
                @endif
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
                        } elseif ($i == 'desc-required') {
                            echo 'Description Cannot Be Empty';
                            break;
                        } elseif ($i == 'cons-numeric') {
                            echo 'Consntration Accepts Numeric Values Only';
                            break;
                        } elseif ($i == 'cons-min') {
                            echo 'Consentration Must Be Greater Than Zero';
                            break;
                        } elseif ($i == 'cons-required') {
                            echo 'Consentration Cannot Be Empty';
                            break;
                        } elseif ($i == 'type-required') {
                            echo 'Medicine Type Cannot Be Empty';
                            break;
                        } elseif ($i == 'cat-required') {
                            echo 'Category Cannot Be Empty';
                            break;
                        }
                    }
                @endphp
            </div>
        @endif
        <form action={{ route("update-$main_name", ['id' => $prod->id]) }} method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name"
                    value="{{ isset($data['name']) ? $data['name'] : (old('name') ? old('name') : $prod->name) }}"
                    name="name" autofocus>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="desc">{{ isset($data['desc']) ? $data['desc'] : (old('desc') ? old('desc') : $prod->desc) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="consntration" class="form-label">Consntration</label>
                <input type="number" class="form-control" id="consntration"
                    value="{{ isset($data['consntration']) ? $data['consntration'] : (old('consntration') ? old('consntration') : $prod->cons) }}"
                    name="consntration">
            </div>
            <div class="mb-3">
                <label for="cat">Categories</label>
                <select name="cat">
                    {{-- print without scaping characters --}}
                    {!! $cats ? '' : "<option value='0'>No Category</option>" !!}
                    @foreach ($cats as $i)
                        <option value={{ $i->id }}
                            {{ isset($data['cat']) && $data['cat'] == $i->id ? 'selected' : ($prod->category_id == $i->id ? 'selected' : '') }}>
                            {{ $i->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="type">Medicine Type</label>
                <select name="type">
                    {{-- print without scaping characters --}}
                    {!! $types ? '' : "<option value='0'>No Type Exists</option>" !!}
                    @foreach ($types as $i)
                        <option value={{ $i->id }}
                            {{ isset($data['type']) && $data['type'] == $i->id ? 'selected' : ($prod->med_type == $i->id ? 'selected' : '') }}>
                            {{ $i->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="require">Requires Recepient</label>
                <input type="checkbox" name="require" id="require"
                    {{ isset($data['require']) && $data['require'] == 'on' ? 'checked' : ($prod->require == '1' ? 'checked' : '') }}>
            </div>
            <input type="submit" value="Edit {{ $message }}" class="btn btn-primary">
        </form>
    </div>
@endsection
@php
    unset($error);
    session()->forget('error');
@endphp
