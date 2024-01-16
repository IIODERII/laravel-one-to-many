@extends('layouts.app')
@section('content')
    <section class="container">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-dark mt-3"><i class="fa-solid fa-left-long"></i></a>

        <h1 class="display-1 fs-bold py-3">Modifica {{ $project->title }}</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="title">Titolo</label>
            <input value="{{ old('title', $project->title) }}" required type="text" id="title" name="title"
                class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="category_id">Select Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="description">Descrizione</label>
            <textarea rows="8" id="description" name="description"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="my-3" style="width: 600px;">
                <img class="w-100" id="uploadPreview" src="{{ asset('storage/' . $project->image) }}" alt="Placeholder">
            </div>
            <label for="image">Immagine</label>
            <input value="{{ old('image', $project->image) }}" type="file" id="image" name="image"
                class="form-control @error('description') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="url">Url</label>
            <input value="{{ old('url', $project->url) }}" required type="url" id="url" name="url"
                class="form-control @error('description') is-invalid @enderror">
            @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="tecnologies">Tecnologie utilizzate (scrivere con uno spazio tra una e l'altra, es.
                htmll css JavaScript)</label>
            <input value="{{ old('tecnologies', $project->tecnologies) }}" type="text" id="tecnologies"
                name="tecnologies" class="form-control @error('description') is-invalid @enderror">
            @error('tecnologies')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-3">Save</button>
            <input type="reset" class="btn btn-warning mt-3">
        </form>
    </section>
@endsection
