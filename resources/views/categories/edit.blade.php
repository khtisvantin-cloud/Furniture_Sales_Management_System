@extends('layouts.app')

@section('content')
    <h1 class="page-title">Edit Category</h1>
    @include('categories.partials.form', ['action' => route('categories.update', $category), 'method' => 'PUT', 'category' => $category])
@endsection
