@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card mt-2">
        <div class="card-header">
            Création d'un nouvelle todo
        </div>
        <div class="card-body">
            <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Titre</label>
                <input id="name" class="form-control" type="text" name="name" aria-describedby="nameHelp">
                <small id="nameHelp" class="form-text text-muted">Entrez le titre de votre todo.</small>
            </div>
            <div class="form-group">
                <label for="descritption">Description</label>
                <input id="description" class="form-control" type="text" name="description" aria-describedby="nameHelp">
            </div>
            <button class="btn btn-primary" type="submit">Ajouter</button>
            </form>
        </div>

    </div>
</div>
@endsection
