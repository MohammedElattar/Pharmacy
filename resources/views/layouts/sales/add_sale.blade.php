@extends('index')
@php
    $main_name = 'sale';
    $message = 'Sale';
    $data = session()->get('data');
    $error = session()->get('error');
    if (isset($data) && !$data) {
        unset($data);
    }
    if (isset($error) && !$error) {
        unset($error);
    }
    // print_r(session()->all());
@endphp
@section('title', "Add $message")
@section('content')
    <div style="width: 60%;margin:auto">
        <h3 class="text-center">Add {{ $message }}</h3>
        <div class="alert alert-info">Total Price : <span class="tprice" style="font-weight: bold">0.0</span></div>
        @if ($errors->any() || isset($error))
            {{-- {{ $errors }} --}}
            <div class="alert alert-danger text-center">
                @if ($error == 'prod')
                    Product doesn't Exists
                @elseif ($error == 'qty')
                    Qty Is Bigger Than Existing Qty
                @elseif($error == 'price')
                    Price Must Be Greater Than 0
                @endif
                @php
                    $er = [
                        'prod-required' => 'No Products Exists',
                        'qty-required' => 'Quantity Cannot Be Empty',
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
                <label for="customer">Customers</label>
                <select name="customer"class="form-control">
                    {{-- print without scaping characters --}}
                    {!! $customers ? '' : "<option value='0'>No Customer</option>" !!}
                    @foreach ($customers as $i)
                        <option value={{ $i->id }}
                            {{ @$data['customer'] == $i->id || old('customer') == $i->id ? 'selected' : '' }}>
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
                <input type="number" id="price"class="form-control" value="{{ @$data['price'] or old('price') }}"
                    disabled>
                <input type="hidden" name="price_val" id="price_val" value="">
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

@section('ajx')
    <script>
        let prod = document.querySelector("[name=product]");
        prod.addEventListener("change", () => {
            getData(document.querySelector('[name=product]').value)
        })

        function getData(id) {
            $.ajax({
                type: "POST",
                url: `{{ route('ajx', ['obj' => 'products', 'operation' => 'show']) }}`,
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    res = JSON.parse(res);
                    if ('success' in res) {
                        let qty = res['data']['qty'],
                            price = res['data']['price'];
                        $("#price").val(price);
                        $("#price_val").val(price)
                    } else console.log(res)
                },
                error: (xhr) => {
                    console.log("Your Error is ", xhr.responseText)
                }
            });
        }
        getData(prod.value);
    </script>
@endsection
