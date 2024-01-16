@extends('layouts.app')
@section('content')
    <section class="container">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-3"><i class="fa-solid fa-left-long"></i></a>

        <h1 class="display-1 fs-bold py-3">Modifica {{ $category->name }}</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.categories.update', $category->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nome della categoria</label>
            <input value="{{ old('name', $category->name) }}" required type="text" id="name" name="name"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Save</button>
            <input type="reset" class="btn btn-warning mt-3">
        </form>
    </section>
@endsection
