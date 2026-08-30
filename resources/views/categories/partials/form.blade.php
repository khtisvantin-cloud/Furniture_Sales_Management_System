<div class="card mt-3">
    <div class="card-body-clean">
        <form method="POST" action="{{ $action }}">
            @csrf
            @if ($method !== 'POST') @method($method) @endif

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="name">Category Name *</label>
                    <input id="name" name="name" value="{{ old('name', $category->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="description">Description</label>
                    <input id="description" name="description" value="{{ old('description', $category->description) }}" class="form-control @error('description') is-invalid @enderror">
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <button class="btn btn-primary mt-4">{{ $method === 'POST' ? 'Save' : 'Update' }} Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-soft mt-4">Cancel</a>
        </form>
    </div>
</div>
