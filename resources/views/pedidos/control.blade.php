@extends('layouts.main')
@section('contenido')
    <div class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Listado de pedidos</h1>
                        <a href="{{route('pedidos.create')}}" class="btn btn-primary btn-sm float-right">Nuevo pedido</a>
                    </div>

                    <div class="card-body">
                        @if(session('info'))
                            <div class="alert alert-success">{{session('info')}}</div>
                        @endif
                    <table class="table table-hovwe table-sm">
                        <thead>
                            <th>Codigo</th>
                            <th>Metrológo</th>
                            <th>Tipo</th>
                            <th>Accion</th>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->codigo}}</td>
                                <td>{{$pedido->metrologo}}</td>
                                <td>{{$pedido->tipo}}</td>
                                <td>
                                    <a href="javascript: document.getElementById('eliminar-{{ $pedido->id }}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                                    <form id="eliminar-{{ $pedido->id }}" action="{{route('pedidos.eliminar',$pedido->id)}}" method="POST">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div >
                        <a href="{{route('index')}}" class="btn btn-success btn-sm">Atras</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

