<?php

use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


Route::get('/',function(){//Mostrar index
    $ControllerPedidos=new PedidoController();
    $pedidos=$ControllerPedidos->Listar();
    return view('pedidos.index',compact('pedidos'));
})->name('index');

Route::get('pedidos/create',function(){//Mostrar vista de pedido
    return view('pedidos.create');
})->name('pedidos.create');

Route::put('pedidos/{id}/finalizar',function($id){//Finalizar un pedido
    $ControllerPedidos=new PedidoController();
    $res=$ControllerPedidos->Finalizar($id);
    if($res)
    {return redirect()->route('index')->with('info','Pedido finalizado exitosamente');}
    else
    {return redirect()->route('index')->with('info','El pedido no pudo finalizarse');}
})->name('pedidos.finalizar');

Route::put('pedidos/actualizar',function(Request $request){//Actualizar las observaciones del pedido
    $ControllerPedidos=new PedidoController();
    $res=$ControllerPedidos->Actualizar($request);
    if($res)
    {return redirect()->route('index')->with('info','Pedido actualizado exitosamente');}
    else
    {return redirect()->route('index')->with('info','El pedido no pudo actualizarse');}
})->name('pedidos.actualizar');

Route::get('pedidos/{id}/details',function($id){//Mostrar pedido en particular
    $ControllerPedidos=new PedidoController();
    $pedido=$ControllerPedidos->Buscar($id);
    return view('pedidos.details',compact('pedido'));
})->name('pedidos.details');

Route::post('pedidos',function(Request $request){//Crear un pedido
    $request->validate([
        'descripcion'=>'max:255',
        'metrologo'=>'required',
        'codigo'=>'required',
    ]);
    $ControllerPedidos=new PedidoController();
    $res=$ControllerPedidos->Crear($request);
    if($res)
    {return redirect()->route('index')->with('info','Pedido creado exitosamente');}
    else
    {return redirect()->route('index')->with('info','El pedido no se puedo crear ya que el codigo ya esta registrado');}

})->name('pedidos.store');

Route::get('duracion',function(){
    $ControllerPedidos=new PedidoController();
    $dur=$ControllerPedidos->CalcularDuracion('2021-12-17 13:01:01','2021-12-18 13:10:00');
    return $dur;
})->name('duracion');

Route::get('pedidos/pendientes',function(){//Mostrar pedidos pendientes
    $ControllerPedidos=new PedidoController();
    $pedidos=$ControllerPedidos->Pendientes();
    return view('pedidos.index',compact('pedidos'));
})->name('pedidos.pendientes');


Route::get('/pedidos/administrar',function(){//Mostrar panel de administracion
    $ControllerPedidos=new PedidoController();
    $pedidos=$ControllerPedidos->Listar();
    return view('pedidos.control',compact('pedidos'));
})->name('pedidos.control');

Route::delete('/pedidos/eliminar/{id}',function($id){//Eliminar pedido
    $ControllerPedidos=new PedidoController();
    $pedidos=$ControllerPedidos->Eliminar($id);
    return redirect()->route('pedidos.control')->with('info','Pedido eliminado correctamente');
})->name('pedidos.eliminar');

