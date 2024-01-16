<?php
$technologies = explode(' ', $project->tecnologies);
?>

@extends('layouts.app')
@section('content')
    <section class="container">
        <div class="d-flex justify-content-between align-items-center"><a href="{{ route('admin.projects.index') }}"
                class="btn btn-dark mt-3"><i class="fa-solid fa-left-long"></i></a>
            <div>
                <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning mt-3">Modifica</a>
                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST" class="d-inline"
                    id="delete-form-{{ $project->slug }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white btn btn-danger mt-3 cancel-button"
                        data-item-title="{{ $project->title }}" data-form-id="{{ $project->slug }}">Elimina</button>
                </form>
            </div>
        </div>

        <div><img src="{{ asset('storage/' . $project->image) }}" alt="" class="w-100 my-3"></div>

        <h1 class="display-1 fs-bold pb-3">{{ $project->title }}</h1>

        <div class="row mb-5 ">
            <div class="pe-5 col-3">
                <a class="btn btn-primary" href="{{ $project->url }}" style="max-width: 200px">Scopri questo
                    progetto su GitHub</a>
                <h3 class="mt-4">Tecnologie utilizzate:</h3>
                <ul>
                    @foreach ($technologies as $technology)
                        <li>{{ $technology }}</li>
                    @endforeach
                </ul>
                <div>
                    <h4>Tipo di progetto:</h4>
                    <p>
                        @if ($project->category)
                            {{ $project->category->name }}
                        @else
                            Nessuna
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-9">
                <p>{{ $project->description }}</p>


            </div>
        </div>
    </section>

    @include('partials.modal_delete')
@endsection
