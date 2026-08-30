@extends('layouts.app')

@section('content')
    <h1 class="page-title">Add Category</h1>
    @include('categories.partials.form', ['action' => route('categories.store'), 'method' => 'POST', 'category' => new App\Models\Category()])
@endsection
