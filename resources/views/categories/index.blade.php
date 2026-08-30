@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="page-title">Category Management</h1>
            <div class="breadcrumb-lite">Management <span>/</span> Categories</div>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Category</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th class="ps-3">#</th><th>CATEGORY</th><th>DESCRIPTION</th><th>FURNITURE</th><th>CREATED</th><th class="text-end pe-3">ACTION</th></tr></thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="ps-3">{{ $category->id }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td>{{ $category->description ?? '—' }}</td>
                            <td>{{ $category->furnitures_count }}</td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td class="text-end pe-3">
                                <a class="action-btn d-inline-grid place-items-center" href="{{ route('categories.edit', $category) }}"><i class="bi bi-pencil"></i></a>
                                <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category) }}">
                                    @csrf @method('DELETE')
                                    <button class="action-btn danger" data-confirm="Delete this category?"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-5 text-muted">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $categories->links() }}</div>
@endsection
