@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    - {{ $error }} <br>
                                @endforeach
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('developers.update', $developer) }}" method="POST">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{ old('name', $developer->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="profession">Profesión</label>
                                <input type="text" name="profession" class="form-control" required
                                    value="{{ old('profession', $developer->profession) }}">
                            </div>
                            <div class="form-group">
                                <label for="position">Puesto</label>
                                <select name="position" class="form-control form-select"
                                    aria-label="Default select example">
                                    <option selected value="{{ $developer->position }}">{{ $developer->position }}
                                    </option>
                                    @if ($developer->position == 'Frontend')
                                        <option value="Frontend" hidden>Frontend</option>
                                    @else
                                        <option value="Frontend">Frontend</option>
                                    @endif
                                    @if ($developer->position == 'Backend')
                                        <option value="Backend" hidden>Backend</option>
                                    @else
                                        <option value="Backend">Backend</option>
                                    @endif
                                    @if ($developer->position == 'Fullstack')
                                        <option value="FullStack" hidden>FullStack</option>
                                    @else
                                        <option value="FullStack">FullStack</option>
                                    @endif
                                </select>
                                {{-- <input type="text" name="position" class="form-control" required value="{{ old('position', $developer->position) }}"> --}}
                            </div>
                            <div class="form-group">
                                <label for="technology">Tecnología</label>
                                <select name="technology" class="form-control form-select"
                                    aria-label="Default select example">
                                    <option selected value="{{ $developer->technology }}">{{ $developer->technology }}
                                    </option>
                                    @if ($developer->technology == 'React')
                                        <option value="React" hidden>React</option>
                                    @else
                                        <option value="React">React</option>
                                    @endif
                                    @if ($developer->technology == 'Laravel')
                                        <option value="Laravel" hidden>Laravel</option>
                                    @else
                                        <option value="Laravel">Laravel</option>
                                    @endif
                                    @if ($developer->technology == 'Nodejs')
                                        <option value="Nodejs" hidden>Nodejs</option>
                                    @else
                                        <option value="Nodejs">Nodejs</option>
                                    @endif
                                </select>
                                {{-- <input type="text" name="technology" class="form-control" required value="{{ old('technology', $developer->technology) }}"> --}}
                            </div>
                            <div class="form-group">
                                @csrf
                                @method('PUT')
                                <input type="submit" value="Actualizar" class="btn btn-sm btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
