@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Modification de la todo <span class="badge badge-dark">#{{ $todo->id }}</span></h4>
        </div>

        <div class="card-body">
            <form action="{{ route('todos.update', $todo->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Titre</label>
                <input id="name" class="form-control" type="text" name="name" aria-describedby="nameHelp" value="{{ old('name',$todo->name) }}">
                <small id="nameHelp" class="form-text text-muted">Entrez le titre de votre todo.</small>
            </div>
            <div class="form-group">
                <label for="descritption">Description</label>
                <input id="description" class="form-control" type="text" name="description" aria-describedby="nameHelp" value="{{ old('descritpion',$todo->description) }}">
            </div>
            <div class="form-group form-check">
                <input id="my-input" class="form-check-input" type="checkbox" name="done" {{ $todo->done ? 'checked' : '' }} value=1>
                <label for="form-check-label" for="done"> Done ?</label>
            </div>
            <button class="btn btn-primary" type="submit">Mettre à jour</button>
            </form>
        </div>

    </div>
    </div>
</div>
@endsection
