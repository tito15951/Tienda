@extends('layouts.main')
@section('contenido')
    <div class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Detalles del pedido</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('pedidos.actualizar')}}" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" style="display: none" name="id" value={{$pedido->id;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Codigo:</label>
                                <input type="text" class="form-control" name="codigo" disabled value={{$pedido->codigo;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Metrologo:</label>
                                <input type="text" class="form-control" name="metrologo" disabled value={{$pedido->metrologo;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de inicio:</label>
                                <input type="text" class="form-control" name="inicio" disabled value={{$pedido->fecha_inic;}}>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de finalizacion:</label>
                                @if($pedido->fecha_fin==$pedido->fecha_inic)
                                    <input type="text" class="form-control" name="fin" disabled value="Sin finalizar">
                                @else
                                    <input type="text" class="form-control" name="fin" disabled value={{$pedido->fecha_fin;}}>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Observaciones:</label><br>
                                <div class="form-floating">
                                    <textarea class="form-control" name="observaciones">{{$pedido->descripcion;}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Duracion:</label>
                                @if($pedido->duracion==0)
                                    <input type="text" class="form-control" name="duracion" disabled value="Sin finalizar">
                                @else
                                <input type="text" class="form-control" name="duracion" disabled value='{{intdiv($pedido->duracion,24)}} Dias {{$pedido->duracion % 24}} Horas'>
                                @endif
                            </div>
                            <button class="btn btn-success btn-sm" type="submit">Actualizar datos</button>
                            <a href="{{route('index')}}" class="btn btn-danger btn-sm">Atras</a>

                             @method('put')
                             @csrf
                        </form><br>
                        @if($pedido->fecha_fin==$pedido->fecha_inic)
                                <a href="javascript: document.getElementById('finalizar-{{ $pedido->id }}').submit()" class="btn btn-warning btn-sm">Finalizar</a>
                                <form id="finalizar-{{ $pedido->id }}" action="{{route('pedidos.finalizar',$pedido->id)}}" method="POST">
                                    @method('put')
                                    @csrf
                                </form>
                             @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
