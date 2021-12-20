<?php

namespace App\Http\Controllers;
use App\Models\Pedido;
use DateTime;
use DateInterval;
use Exception;
use Illuminate\Http\Request;


class PedidoController extends Controller
{
    public function Listar()
    {
        $pedidos=Pedido::all()->where('estado','=','activo');
        return $pedidos;
    }

    public function Buscar($id)
    {
        $pedido=Pedido::findOrFail($id);
        return $pedido;
    }

    public function Crear(Request $request)
    {
        try{
            date_default_timezone_set('America/Bogota');
            $now =new \DateTime();
            $new_pedido=new Pedido();
            $new_pedido->codigo=$request->input('codigo');
            $new_pedido->descripcion=$request->input('descripcion');
            $new_pedido->metrologo=$request->input('metrologo');
            $new_pedido->tipo=$request->input('tipo');
            $new_pedido->fecha_inic=$now->format('Y-m-d H:i:s');
            $new_pedido->fecha_fin=$now->format('Y-m-d H:i:s');
            $new_pedido->duracion=0;
            $new_pedido->estado='activo';
            $new_pedido->save();
            return true;}
        catch(Exception $e)
        {
            return false;
        }
    }

    public function Pendientes()
    {
        $pendientes=Pedido::all()->where('duracion','=',0)->where('estado','=','activo');
        return $pendientes;
    }

    public function CalcularDuracion($fecha_inic, $fecha_fin)
    {
        date_default_timezone_set('America/Bogota');
        $hora_inicio=7;
        $hora_fin=17;
        $inicio_almuerzo=12;
        $fin_almuerzo=13;
        $duracion=0;
        $fin=true;
        $intervalo = new DateInterval("PT1H");
        $actual=new DateTime($fecha_inic);
        $fecha_fin=new DateTime($fecha_fin);
        while($fin)
        {
            $actual->add($intervalo);
            $ano=$actual->format('Y');
            $mes=$actual->format('m');
            $dia=$actual->format('d');
            $hora=$actual->format('H');
            $min=$actual->format('i');
            $actual=new DateTime($actual->format('Y-m-d H:i:s'));
            $nombreDia=$actual->format('w');
            if($actual>=$fecha_fin)
                {$fin=false;}
            else
                {
                    if(($hora>=$hora_inicio && $hora<=$inicio_almuerzo) || ($hora>=$fin_almuerzo && $hora<=$hora_fin))//Revisa que este en los horaro adecuados
                        {   if($nombreDia!=0 && $nombreDia!=6)//Que no sea ni domingo ni lunes
                                {$duracion+=1;}
                            }
                }
        }
        return $duracion;
    }

    public function Finalizar($id)
    {

        try{
            date_default_timezone_set('America/Bogota');
            $now =new \DateTime();
            $pedido=Pedido::findOrFail($id);
            $pedido->fecha_fin=$now->format('Y-m-d H:i:s');
            $fecha1 = new DateTime($pedido->fecha_inic);
            $fecha2 = new DateTime($pedido->fecha_fin);
            $pedido->duracion=$this->CalcularDuracion($pedido->fecha_inic,$pedido->fecha_fin);
            $pedido->save();
            return true;}
        catch(Exception $e)
        {
            return false;
        }
    }
    public function Actualizar(Request $request)
    {
        try{
            $pedido=Pedido::findOrFail($request->id);
            $pedido->descripcion=$request->observaciones;
            $pedido->save();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    public function Eliminar($id)
    {
        $pedido=Pedido::findOrFail($id);
        $pedido->estado='eliminado';
        $pedido->delete();
    }
}
