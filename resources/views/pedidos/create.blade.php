@extends('layouts.main')
@section('contenido')
    <div class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Crear pedidos</h1>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('pedidos.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="text" class="form-control" autocomplete="off" name="codigo">

                            </div>
                            <div class="form-group">
                                <label for="">Metrológo</label>
                                <input type="text" class="form-control" name="metrologo">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="tipo">
                                    <option value="Calibracion">Calibración</option>
                                    <option value="Ajuste">Ajuste</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" class="form-control" autocomplete="off" name="descripcion">
                            </div>
                            <button type="submit" class="btn btn-primary">Finalizar</button>
                            <a href="{{route('index')}}" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
