<?php

namespace App\Models\Modelos;

use App\Models\Clases\PedidoDeSurtido;
use App\Models\DetalleSurtido;
use App\Models\Sucursal as sucursalModelo;
use App\Models\PedidoSurtido as SurtidosServicios;


class SurtidoModelo
{

    protected ?SurtidoModelo $SurtidoModelo;

    private SurtidosServicios $SurtidosServicios;


    public function __construct(Kit $SurtidoModelo = null)
    {
        $this->SurtidosServicios = new SurtidosServicios();
    }

    public function index()
    {
        $pedidoSurtido = SurtidosServicios::query();
        return $pedidoSurtido;
    }



    public function guardarInventario($idSurtido, $cantidadLlegoData)
    {
    }


    public function edit($id)
    {
        $pedidoSurtido = SurtidosServicios::find($id);

        if (!$pedidoSurtido) {
            return redirect()->route('ruta_de_error');
        }

        $detalleSurtido = DetalleSurtido::where('idSurtido', $id)->get();

        if ($detalleSurtido->isEmpty()) {
            return redirect()->route('admin.surtidos.index')->with('success', 'No se encontraron datos.');
        }

        return view('admin.surtidos.edit', compact('detalleSurtido', 'pedidoSurtido'));
    }



    public function FinalizarRevicion($id)
    {
        $pedidoSurtido = SurtidosServicios::find($id);

        if (!$pedidoSurtido) {
            return redirect()->route('ruta_de_error');
        }

        $pedidoSurtido->update(['idStatus' => 2]);

        $detalleSurtido = DetalleSurtido::where('idSurtido', $id)->get();

        if ($detalleSurtido->isEmpty()) {
            return redirect()->route('admin.surtidos.index')->with('success', 'No se encontraron datos.');
        }

        return view('admin.surtidos.edit', compact('detalleSurtido', 'pedidoSurtido'));
    }








    public function crearSurtido(Request $request)
    {
        $surtido = new Surtido();
        $surtido->idSucursal = $request->input('sucursal');
        $surtido->save();

        $idSurtido = $surtido->id;

        foreach ($productos as $producto) {
            $detalleSurtido = new DetalleSurtido();
            $detalleSurtido->idSurtido = $idSurtido;
            $detalleSurtido->idProducto = $producto['idProducto'];
            $detalleSurtido->cantidad = $producto['cantidad'];
            $detalleSurtido->save();
        }

        return $idSurtido;
    }







    public function añadirRefaccion($idRefaccion, $cantidad)
    {
        $bool = $this->kit->añadirRefaccion($idRefaccion, $cantidad);
        session()->put('kit', $this->kit);
        return $bool;
    }

    public function eliminarRefaccion($idRefaccion)
    {
        $this->kit->eliminarRefaccion($idRefaccion);
        session()->put('kit', $this->kit);
    }

    public function setInformacion($nombreProducto, $descripcion, $precioUnitario, $imagen, $idSucursal)
    {
        $this->kit->setNombreProducto($nombreProducto);
        $this->kit->setDescripcion($descripcion);
        $this->kit->setPrecioUnitario($precioUnitario);
        $this->kit->setImagen($imagen);
        $sucursal = new Sucursal();
        $sucursal->setIdSucursal($idSucursal);
        $this->kit->setSucursal($sucursal);
        session()->put('kit', $this->kit);
    }

    public function grabarKit()
    {

        $producto = $this->productoServicios->create([
            'nombreProducto' => $this->kit->getNombreProducto(),
            'descripcion' => $this->kit->getDescripcion(),
            'imagen' => $this->kit->getImagen(),
            'precioUnitario' => $this->kit->getPrecioUnitario(),
            'idTipoProducto' => $this->kit->getIdTipoProducto(),
            'idSucursal' => $this->kit->getSucursal()->getIdSucursal(),
            'idUsuarioCreador' => $this->kit->getUsuarioCreador()->getIdUsuario(),
            'idStatus' => $this->kit->getStatus()->getIdStatus(),
        ]);


        $kit = $this->kitServicios->create([
            'idProducto' => $producto->idProducto,
            'idSucursal' => $this->kit->getSucursal()->getIdSucursal(),
            'idUsuarioCreador' => $this->kit->getUsuarioCreador()->getIdUsuario(),
            'idStatus' => $this->kit->getStatus()->getIdStatus(),
        ]);

        session()->forget('kit');
    }

    public function obtenerKitsEnDiseño()
    {
        $kitsEnDiseño = $this->productoServicios->all()->where('idTipoProducto', '=', 2)->where('idStatus', '=', 11);

        $kitsArray = array_values($kitsEnDiseño->map(function ($kitEloquent) {

            $kitJson = $this->kitServicios->all()->where('idProducto', '=', $kitEloquent->idProducto)->first();

            $sucursalJson = $this->sucursalServicios->all()->where('idSucursal', '=', $kitJson->idSucursal)->first();
            $sucursalObj =  new Sucursal();
            $sucursalObj->setIdSucursal($sucursalJson->idSucursal);
            $sucursalObj->setNombreSucursal($sucursalJson->nombreSucursal);
            $sucursalObj->setCalle($sucursalJson->calle);
            $sucursalObj->setColonia($sucursalJson->colonia);
            $sucursalObj->setNumero($sucursalJson->numero);
            $sucursalObj->setCP($sucursalJson->CP);
            $sucursalObj->setTelefono($sucursalJson->telefono);
            $sucursalObj->setStatus(new Status($sucursalJson->status->idStatus, $sucursalJson->status->nombreStatus));


            $detallesKitJson = $this->detalleKitServicios->all()->where('idKit', '=', $kitEloquent->idProducto);

            $usuarioCreadorJson = $this->usuarioServicios->all()->where('idUsuario', '=', $kitJson->idUsuarioCreador)->first();

            $usuarioCreadorObj = new Usuario();
            $usuarioCreadorObj->setIdUsuario($usuarioCreadorJson->idUsuario);
            $usuarioCreadorObj->setNombre($usuarioCreadorJson->nombre);
            $usuarioCreadorObj->setApellidoPaterno($usuarioCreadorJson->apellidoPaterno);
            $usuarioCreadorObj->setApellidoMaterno($usuarioCreadorJson->apellidoMaterno);
            $usuarioCreadorObj->setEmail($usuarioCreadorJson->email);
            $usuarioCreadorObj->setFechaNacimiento($usuarioCreadorJson->fechaNacimiento);
            $usuarioCreadorObj->setIdRol($usuarioCreadorJson->idRol);


            $detallesKitArr = $detallesKitJson->map(function ($detalleKit) {

                return new DetalleKit(
                    $detalleKit->idKit,
                    $detalleKit->idRefaccion,
                    $detalleKit->cantidad,
                );
            });

            $kitObj = new Kit();
            $kitObj->setIdProducto($kitEloquent->idProducto);
            $kitObj->setNombreProducto($kitEloquent->nombreProducto);
            $kitObj->setDescripcion($kitEloquent->descripcion);
            $kitObj->setImagen($kitEloquent->imagen);
            $kitObj->setPrecioUnitario($kitEloquent->precioUnitario);
            $kitObj->setIdTipoProducto($kitEloquent->idTipoProducto);
            $kitObj->setStatus(new Status($kitEloquent->status->idStatus, $kitEloquent->status->nombreStatus));
            $kitObj->setSucursal($sucursalObj);
            $kitObj->setUsuarioCreador($usuarioCreadorObj);
            $kitObj->setDetallesKit($detallesKitArr->toArray());

            return $kitObj;
        })->toArray());

        return $kitsArray;
    }

    public function obtenerKitConDetalle(int $idKit): Kit
    {
        $productoJson = $this->productoServicios->all()->where('idTipoProducto', '=', 2)->where('idStatus', '=', 11)->where('idProducto', '=', $idKit)->first();

        $kitJson = $this->kitServicios->all()->where('idProducto', '=', $idKit)->first();

        $sucursalJson = $this->sucursalServicios->all()->where('idSucursal', '=', $kitJson->idSucursal)->first();
        $sucursalObj =  new Sucursal();
        $sucursalObj->setIdSucursal($sucursalJson->idSucursal);
        $sucursalObj->setNombreSucursal($sucursalJson->nombreSucursal);
        $sucursalObj->setCalle($sucursalJson->calle);
        $sucursalObj->setColonia($sucursalJson->colonia);
        $sucursalObj->setNumero($sucursalJson->numero);
        $sucursalObj->setCP($sucursalJson->CP);
        $sucursalObj->setTelefono($sucursalJson->telefono);
        $sucursalObj->setStatus(new Status($sucursalJson->status->idStatus, $sucursalJson->status->nombreStatus));


        $detallesKitJson = $this->detalleKitServicios->all()->where('idKit', '=', $idKit);

        $usuarioCreadorJson = $this->usuarioServicios->all()->where('idUsuario', '=', $kitJson->idUsuarioCreador)->first();

        $usuarioCreadorObj = new Usuario();
        $usuarioCreadorObj->setIdUsuario($usuarioCreadorJson->idUsuario);
        $usuarioCreadorObj->setNombre($usuarioCreadorJson->nombre);
        $usuarioCreadorObj->setApellidoPaterno($usuarioCreadorJson->apellidoPaterno);
        $usuarioCreadorObj->setApellidoMaterno($usuarioCreadorJson->apellidoMaterno);
        $usuarioCreadorObj->setEmail($usuarioCreadorJson->email);
        $usuarioCreadorObj->setFechaNacimiento($usuarioCreadorJson->fechaNacimiento);
        $usuarioCreadorObj->setIdRol($usuarioCreadorJson->idRol);


        $detallesKitArr = $detallesKitJson->map(function ($detalleKit) {

            return new DetalleKit(
                $detalleKit->idKit,
                $detalleKit->idRefaccion,
                $detalleKit->cantidad,
            );
        });

        $kitObj = new Kit();
        $kitObj->setIdProducto($productoJson->idProducto);
        $kitObj->setNombreProducto($productoJson->nombreProducto);
        $kitObj->setDescripcion($productoJson->descripcion);
        $kitObj->setImagen($productoJson->imagen);
        $kitObj->setPrecioUnitario($productoJson->precioUnitario);
        $kitObj->setIdTipoProducto($productoJson->idTipoProducto);
        $kitObj->setStatus(new Status($productoJson->status->idStatus, $productoJson->status->nombreStatus));
        $kitObj->setSucursal($sucursalObj);
        $kitObj->setUsuarioCreador($usuarioCreadorObj);
        $kitObj->setDetallesKit($detallesKitArr->toArray());

        return $kitObj;
    }

    public function eliminarDiseñoKit(Producto $kitProducto)
    {

        $kitProducto->setstatus(new Status(2));

        $this->productoServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 2,
        ]);

        $this->kitServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 2,
        ]);
    }

    public function aprobarKit(Producto $kitProducto)
    {

        $kitProducto->setstatus(new Status(12));

        $this->productoServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 1,
        ]);

        $this->kitServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 13,
        ]);
    }

    public function rechazarKit(Producto $kitProducto)
    {

        $kitProducto->setstatus(new Status(13));

        $this->productoServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 2,
        ]);

        $this->kitServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 4,
        ]);
    }
}
