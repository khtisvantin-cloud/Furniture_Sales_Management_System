@extends('layouts.app')

@section('content')
    <h1 class="page-title">{{ $furniture->exists ? 'Edit' : 'Add' }} Furniture</h1>

    <div class="card mt-3">
        <div class="card-body-clean">
            <form method="POST" enctype="multipart/form-data"
                action="{{ $furniture->exists ? route('furnitures.update', $furniture) : route('furnitures.store') }}">
                @csrf
                @if ($furniture->exists) @method('PUT') @endif

                <div class="row g-3">
                    @foreach (['furniture_code' => 'Furniture Code', 'name' => 'Furniture Name', 'material' => 'Material', 'color' => 'Color', 'size' => 'Size', 'price' => 'Price', 'quantity' => 'Quantity'] as $name => $label)
                        <div class="col-md-6">
                            <label class="form-label" for="{{ $name }}">{{ $label }} *</label>
                            <input id="{{ $name }}" name="{{ $name }}"
                                type="{{ $name === 'price' || $name === 'quantity' ? 'number' : 'text' }}"
                                step="{{ $name === 'price' ? '0.01' : '1' }}"
                                class="form-control @error($name) is-invalid @enderror"
                                value="{{ old($name, $furniture->$name) }}" required>
                            @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endforeach

                    <div class="col-md-6">
                        <label class="form-label" for="category_id">Category *</label>
                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $furniture->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="image">Main Image</label>
                        <input id="image" type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $furniture->description) }}</textarea>
                    </div>
                </div>

                <button class="btn btn-primary mt-4">Save Furniture</button>
                <a href="{{ route('furnitures.index') }}" class="btn btn-soft mt-4">Cancel</a>
            </form>
        </div>
    </div>
@endsection
