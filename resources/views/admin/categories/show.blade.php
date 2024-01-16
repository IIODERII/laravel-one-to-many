@extends('layouts.app')
@section('content')
    <section class="container">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-dark my-3"><i class="fa-solid fa-left-long"></i></a>
        <h1>{{ $category->name }}</h1>

        @if (count($category->projects) > 0)
            <h3>Lista dei progetti in questa categoria</h3>


            <table class="table table-dark table-striped table-hover my-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->projects as $key => $project)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ substr($project->description, 0, 100) . '...' }}</td>
                            <td><a href="{{ route('admin.projects.show', $project->slug) }}"
                                    class="btn btn-success">Mostra</a>
                                <a href="{{ route('admin.projects.edit', $project->slug) }}"
                                    class="btn btn-warning">Modifica</a>
                                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST"
                                    class="d-inline" id="delete-form-{{ $project->slug }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white btn btn-danger cancel-button"
                                        data-item-title="{{ $project->title }}"
                                        data-form-id="{{ $project->slug }}">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Non ci sono progetti in questa categoria</h3>
        @endif
    </section>
    @include('partials.modal_delete')
@endsection
