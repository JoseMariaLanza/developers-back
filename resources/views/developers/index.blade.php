@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">

                <div class="card border-0 shadow">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    - {{ $error }} <br>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('developers.store') }}" method="POST">
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" name="name" placeholder="Nombre" class="form-control"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="profession" placeholder="Profesión" class="form-control"
                                        value="{{ old('profession') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" name="position" placeholder="Puesto" class="form-control"
                                        value="{{ old('position') }}">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="technology" placeholder="Tecnología" class="form-control"
                                        value="{{ old('technology') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>PROFESION</th>
                            <th>TECNOLOGÍA</th>
                            <th>PUESTO</th>
                            <th colspan="2">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($developers as $developer)
                            <tr>
                                <td>{{ $developer->id }}</td>
                                <td>{{ $developer->name }}</td>
                                <td>{{ $developer->profession }}</td>
                                <td>{{ $developer->position }}</td>
                                <td>{{ $developer->technology }}</td>
                                <td>
                                    <a href="{{ route('developers.edit', $developer) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ route('developers.destroy', $developer) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" value="Eliminar" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Desea eliminar... ?')" />
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
