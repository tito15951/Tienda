@extends('layouts.main')
@section('contenido')
    <div class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Listado de pedidos</h1>
                        <a href="{{route('pedidos.create')}}" class="btn btn-primary btn-sm float-right">Nuevo pedido</a>
                        <a href="{{route('pedidos.control')}}" class="btn btn-warning btn-sm float-right">Administrar todos los pedidos</a>
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
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Duración</th>
                            <th>Accion</th>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->codigo}}</td>
                                <td>{{$pedido->metrologo}}</td>
                                <td>{{$pedido->tipo}}</td>
                                <td>{{$pedido->fecha_inic}}</td>
                                @if($pedido->fecha_fin==$pedido->fecha_inic)
                                    <td>Sin finalizar</td>
                                @else
                                    <td>{{$pedido->fecha_fin}}</td>
                                @endif
                                @if($pedido->fecha_fin==$pedido->fecha_inic)
                                    <td>Sin finalizar</td>
                                @else
                                    <td>{{intdiv($pedido->duracion, 60)}} Horas {{$pedido->duracion-intdiv($pedido->duracion, 60)*60}} Minutos</td>
                                @endif
                                <td>
                                    <a href="{{route('pedidos.details',$pedido->id)}}" class="btn btn-warning btn-sm">Ver detalles</a>
                                    @if($pedido->fecha_fin==$pedido->fecha_inic)
                                        <a href="javascript: document.getElementById('finalizar-{{ $pedido->id }}').submit()" class="btn btn-danger btn-sm">Finalizar</a>
                                        <form id="finalizar-{{ $pedido->id }}" action="{{route('pedidos.finalizar',$pedido->id)}}" method="POST">
                                            @method('put')
                                            @csrf
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div >
                        <a href="{{route('pedidos.pendientes')}}" class="btn btn-success btn-sm">Ver todos los pendientes</a>
                        <a href="{{route('index')}}" class="btn btn-success btn-sm">Ver todo</a>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

