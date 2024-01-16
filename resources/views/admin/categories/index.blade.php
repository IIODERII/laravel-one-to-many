@extends('layouts.app')
@section('content')
    <section class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="py-4">Progetto di Oder Risi (<a href="https://github.com/IIODERII" class="clickable d-inline-block"
                    style="color: lightblue">Profilo GitHub</a>)</h1>
            <a href="{{ route('admin.categories.create') }}" style="max-width: 200px" class="fw-bold btn btn-primary">Aggiungi
                una nuova categoria</a>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <table class="table table-dark table-striped table-hover my-5 mx-auto w-auto">
            <thead>
                <tr>
                    <th scope="col" style="width: 200px">#</th>
                    <th scope="col">Titolo</th>
                    <th></th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td style="width: 200px"></td>
                        <td><a href="{{ route('admin.categories.show', $category->slug) }}"
                                class="btn btn-success">Mostra</a>
                            <a href="{{ route('admin.categories.edit', $category->slug) }}"
                                class="btn btn-warning">Modifica</a>
                            <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST"
                                class="d-inline" id="delete-form-{{ $category->slug }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white btn btn-danger cancel-button"
                                    data-item-title="{{ $category->name }}"
                                    data-form-id="{{ $category->slug }}">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    @include('partials.modal_delete')
@endsection
