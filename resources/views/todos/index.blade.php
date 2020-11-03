@extends('layouts.app')
@section('content')

<div class="container p-0">
    <div class="row justify-content-center">
        <div class="col-xs">
            <a class="btn btn-primary my-2" href="{{ route('todos.create') }}" type="button">Ajouter un Todo</a>
        </div>

        <div class="col-xs">
            @if (Route::currentRouteName() == 'todos.index')
            <a class="btn btn-warning my-2 ml-2" href="{{ route('todos.undone') }}" type="button">Voir les todos ouvertes</a>
        </div>
        <div class="col-xs">
            <a class="btn btn-success my-2 ml-2" href="{{ route('todos.done') }}" type="button">Voir les todos terminées</a>
            @elseif (Route::currentRouteName()=='todos.done')
            <a class="btn btn-dark my-2 ml-2" href="{{ route('todos.index') }}" type="button">Voir toutes les todos</a>
        </div>
        <div class="col-xs">
            <a class="btn btn-success my-2 ml-2" href="{{ route('todos.undone') }}" type="button">Voir les todos terminées</a>
            @elseif (Route::currentRouteName() == 'todos.undone')
            <a class="btn btn-dark my-2 ml-2" href="{{ route('todos.index') }}" type="button">Voir toutes les todos</a>
        </div>
        <div class="col-xs">
            <a class="btn btn-success my-2 ml-2" href="{{ route('todos.done') }}" type="button">Voir les todos terminées</a>
            @endif
        </div>
    </div>

    @foreach ($datas as $data )
        <div class="alert alert-{{ $data->done ? 'success' : 'warning' }}" role="alert">
            <div class="row">
                <div class="col-sm">
                    <p>
                        <strong>
                            <span class="badge badge-dark">#{{ $data->id }}</span>
                        </strong>
                        <small>
                            Créée {{ $data ->created_at->from() }} par
                            {{ Auth::user()->id ==$data->user->id ? 'moi' : $data->user->name }}
                            @if($data->todoAffectedTo && $data->todoAffectedTo->id == Auth::user()->id)
                            affectée à moi
                            @elseif($data->todoAffectedTo)
                            {{ $data->todoAffectedTo ? ',affectée à' . $data->todoAffectedTo->name:'' }}
                            @endif

                            @if ($data->todoAffectedTo && $data->todoAffectedBy && $data->todoAffectedBy->id == Auth::user()->id)
                            par moi même :d
                            @elseif ($data->todoAffectedTo && $data->todoAffectedBy && $data->todoAffectedBy->id != Auth::user()->id)
                            par {{ $data->todoAffectedBy->name }}
                            @endif
                        </small>
                    </p>

                    <details>
                        <summary> <strong>{{ $data->name }} @if($data->done)<span class="badge badge-success">done</span>@endif</strong></summary>
                        <p>{{ $data->description }}</p>


                    </details>
                    @if($data->done)
                    <small>
                        <p>
                            Terminée
                            {{ $data->updated_at->from() }} - termineé en
                            {{ $data->updated_at->diffForHumans($data->created_at, 1) }}
                        </p>
                    </small>
                    @endif

                </div>
                <div class="col-sm form-inline justify-content-end">
                    {{-- Button affected to --}}
                    <div class="dropdown open">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                    Affecter à
                                </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($users as $user)
                                <a href="/todos/{{ $data->id }}/affectedTo/{{ $user->id }}" class="dropdown-item">{{ $user->name }}</a>
                            @endforeach
                        </div>
                    </div>



                    {{-- Button done/undone --}}
                    @if($data->done==0)
                    <form action="{{ route('todos.makedone',$data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn btn-success mx-1" style="min-width: 100px">Done</button>

                    </form>
                    @else
                    <form action="{{ route('todos.makeundone',$data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn btn-warning mx-1" style="min-width: 100px">Undone</button>

                    </form>
                    @endif
                    {{-- Button edit --}}
                    @can('edit', $data)
                    <a name="" id="" class="btn btn-info mx-1" href="{{ route('todos.edit', $data->id) }}" role="button" >Editer</a>
                    @elsecannot('edit', $data)
                    <a name="" id="" class="btn btn-info mx-1 disabled" href="{{ route('todos.edit', $data->id) }}" role="button" >Editer</a>
                    @endcan

                    {{-- Button delete  --}}
                    @can('delete', $data)
                     <form action="{{ route('todos.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger mx-1" >Effacer</button>

                    </form>
                     @elsecannot('delete', $data)
                     <form action="{{ route('todos.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger mx-1 disabled" >Effacer</button>

                    </form>
                    @endcan
                </div>
            </div>

        </div>


    @endforeach
    <div class="row justify-content-center">

        {{ $datas->links() }}
    </div>
</div>
@endsection


