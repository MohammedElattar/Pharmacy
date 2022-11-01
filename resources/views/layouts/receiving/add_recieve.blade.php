@extends('index')
@php
    $main_name = 'receiving';
    $message = 'Receiving';
    $title = 'Add Receiving';
    $data = session()->get('data');
    $error = session()->get('error');
    if (isset($data) && !$data) {
        unset($data);
    }
    if (isset($error) && !$error) {
        unset($error);
    }
@endphp
@section('title', "Add $message")
@section('content')
    <div style="width: 60%;margin:auto">
        <h3 class="text-center">Add {{ $message }}</h3>
        <div class="alert alert-info">Total Price : <span class="tprice" style="font-weight: bold">0.0</span></div>
        @if ($errors->any() || isset($error))
            <div class="alert alert-danger text-center">
                @if ($error == 'supp')
                    Supplier doesn't exists
                @elseif ($error == 'prod')
                    Product doesn't Exists
                @endif
                @php
                    $er = [
                        'prod-required' => 'No Products Exists',
                        'prod-exists' => 'Some Receive Has The Same Product ID',
                        'supp-required' => 'No Suppliers Exist',
                        'qty.required' => 'Quantity Cannot Be Empty',
                        'qty-num' => 'Quantity Must Be Numeric',
                        'qty-min' => 'Quantity Must Be Greater Than 0',
                        'price-required' => 'Price Cannot Be Empty',
                        'price-num' => 'price Must Be Numeric',
                        'price-min' => 'price must be breater than 0',
                        'exp-required' => 'Expiration Date Cannot Be Empty',
                    ];
                    foreach ($errors->all() as $i) {
                        if (isset($er[$i])) {
                            echo $er[$i];
                            break;
                        }
                    }
                @endphp
            </div>
        @endif
        <form action={{ route("store-$main_name") }} method="POST">
            @csrf
            <div class="mb-3">
                <label for="product">Products</label>
                <select name="product"class="form-control">
                    {{-- print without scaping characters --}}
                    {!! $products ? '' : "<option value='0'>No Product</option>" !!}
                    @foreach ($products as $i)
                        <option value={{ $i->id }}
                            {{ @$data['product'] == $i->id || old('product') == $i->id ? 'selected' : '' }}>
                            {{ $i->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier">Suppliers</label>
                <select name="supplier" class="form-control"class="form-control">
                    {{-- print without scaping characters --}}
                    {!! $suppliers ? '' : "<option value='0'>No Type Supplier</option>" !!}
                    @foreach ($suppliers as $i)
                        <option value={{ $i->id }}
                            {{ @$data['supplier'] == $i->id || old('supplier') == $i->id ? 'selected' : '' }}>
                            {{ $i->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" id="qty"class="form-control"
                    value="{{ @$data['qty'] or old('qty') }}">
            </div>
            <div class="mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price"class="form-control"
                    value="{{ @$data['price'] or old('price') }}">
            </div>
            <div class="mb-3">
                <label for="exp">Expiration Date</label>
                <input type="date" name="exp" id="exp"
                    value={{ isset($date['exp']) ? $data['exp'] : (old('exp') ? old('exp') : date('Y-m-d')) }}>
            </div>
            <input type="submit" value="Add {{ $message }}" class="btn btn-primary">
        </form>
    </div>
    <script>
        document.querySelector("#qty").addEventListener("keyup", function() {
            let qty = parseInt(this.value),
                price = parseFloat(document.querySelector("#price").value);
            let total = 0.0;
            if (typeof qty == 'number' && qty >= 0 && typeof price == 'number' && price >= 0)
                total = (qty * price).toFixed(2);
            document.querySelector(".tprice").textContent = total;
        })
        document.querySelector("#price").addEventListener("keyup", function() {
            let price = parseInt(this.value),
                qty = parseFloat(document.querySelector("#qty").value);
            let total = 0.0;
            if (typeof qty == 'number' && qty >= 0 && typeof price == 'number' && price >= 0)
                total = (qty * price).toFixed(2);
            document.querySelector(".tprice").textContent = total;
        })
    </script>
@endsection
@php
    if (isset($error)) {
        unset($error);
    }
    if (isset($data)) {
        unset($data);
    }
    session()->forget('error');
    session()->forget('data');
@endphp
