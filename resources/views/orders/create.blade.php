@extends('layouts.app') @section('content')
    <h1 class="page-title">
        Create Order</h1>
    <form method="POST" action="{{ route('orders.store') }}" class="card mt-3">
        <div class="card-body-clean">@csrf<label class="form-label">Customer *</label><select class="form-select mb-4"
                name="customer_id">
                @foreach ($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <div id="items">
                <div class="row g-2 item">
                    <div class="col-md-8"><select class="form-select" name="items[0][furniture_id]">
                            @foreach ($furnitures as $f)
                                <option value="{{ $f->id }}">{{ $f->name }} — ${{ number_format($f->price, 2) }}
                                    ({{ $f->quantity }} left)</option>
                            @endforeach
                        </select></div>
                    <div class="col-md-3"><input class="form-control" name="items[0][quantity]" type="number"
                            min="1" value="1"></div>
                </div>
            </div><button type="button" id="add" class="btn btn-soft mt-3">+ Add Item</button>
            <div class="mt-4"><button class="btn btn-primary">Place Order</button><a class="btn btn-soft"
                    href="{{ route('orders.index') }}">Cancel</a></div>
        </div>
    </form>
    @endsection @push('scripts')
    <script>
        let i = 1;
        document.getElementById('add').onclick = () => {
            let e = document.querySelector('.item').cloneNode(true);
            e.querySelectorAll('[name]').forEach(x => x.name = x.name.replace('[0]', '[' + i + ']'));
            document.getElementById('items').append(e);
            i++
        }
    </script>
@endpush
