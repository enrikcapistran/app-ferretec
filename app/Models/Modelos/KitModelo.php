<?php

namespace App\Models\Modelos;

use App\Models\Clases\Kit;
use App\Models\Clases\Status;
use App\Models\Clases\Producto;
use App\Models\Clases\Sucursal;
use App\Models\Clases\DetalleKit;
use App\Models\Clases\Usuario;

use App\Models\Kit as kitServicios;
use App\Models\Producto as productoServicios;
use App\Models\DetalleKit as detalleKitServicios;
use App\Models\Sucursal as sucursalServicios;
use App\Models\Usuario as usuarioServicios;
use App\Models\InventarioSucursal as inventarioSucursalServicios;


class KitModelo
{

    protected ?Kit $kit;

    private kitServicios $kitServicios;
    private productoServicios $productoServicios;
    private detalleKitServicios $detalleKitServicios;
    private sucursalServicios $sucursalServicios;
    private usuarioServicios $usuarioServicios;
    private inventarioSucursalServicios $inventarioSucursalServicios;

    public function __construct(Kit $kit = null)
    {
        $this->kit = session()->get('kit') ?? $kit;

        $this->productoServicios = new productoServicios();
        $this->kitServicios = new kitServicios();
        $this->detalleKitServicios = new detalleKitServicios();
        $this->sucursalServicios = new sucursalServicios();
        $this->usuarioServicios = new usuarioServicios();
        $this->inventarioSucursalServicios = new inventarioSucursalServicios();
    }

    public function iniciarNuevoKit()
    {
        $this->kit = new Kit();
        session()->put('kit', $this->kit) ?? new Kit();
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

        foreach ($this->kit->getDetallesKit() as $detalleKit) {
            $this->detalleKitServicios->create([
                'idKit' => $kit->idProducto,
                'idRefaccion' => $detalleKit->getIdRefaccion(),
                'cantidad' => $detalleKit->getCantidad(),
            ]);
        }

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

    public function obtenerKitsAprovados()
    {
        $kits = $this->productoServicios->where('idTipoProducto', '=', 2)->where('idStatus', '=', 13)->get();

        $kitsArray = array_values($kits->map(function ($kitEloquent) {

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

            $stock = $this->inventarioSucursalServicios->all()->where('idProducto', '=', $kitEloquent->idProducto)->where('idSucursal', '=', $kitJson->idSucursal)->first();
            $stock = $stock->existencia ?? 0;


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
            $kitObj->setStock($stock);

            return $kitObj;
        })->toArray());

        return $kitsArray;
    }

    public function obtenerKitConDetalle(int $idKit): Kit
    {
        $productoJson = $this->productoServicios->all()->where('idTipoProducto', '=', 2)->where('idProducto', '=', $idKit)->first();

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

        //dd($productoJson);
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

        $kitProducto->setstatus(new Status(13));

        $this->productoServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 1,
        ]);

        $this->kitServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 13,
        ]);
    }

    public function rechazarKit(Producto $kitProducto)
    {

        $kitProducto->setstatus(new Status(14));

        $this->productoServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 2,
        ]);

        $this->kitServicios->where('idProducto', '=', $kitProducto->getIdProducto())->update([
            'idStatus' => 4,
        ]);
    }

    public function maxKitsPosibles(int $idKit)
    {
        $kitJson = $this->obtenerKitConDetalle($idKit);

        $maxPosible = 100000000;

        foreach ($kitJson->getDetallesKit() as $detalleKit) {

            $stock = $this->inventarioSucursalServicios->all()->where('idProducto', '=', $detalleKit->getIdRefaccion())->where('idSucursal', '=', $kitJson->getSucursal()->getIdSucursal())->first();
            $stock = $stock->existencia ?? 0;
            //dd($stock);

            $maxPosible = $stock / $detalleKit->getCantidad() < $maxPosible ? $stock / $detalleKit->getCantidad() : $maxPosible;
        }

        return $maxPosible;
    }

    public function materializarKit(int $idKit, int $cantidad)
    {
        $kitJson = $this->obtenerKitConDetalle($idKit);

        foreach ($kitJson->getDetallesKit() as $detalleKit) {
            $stock = $this->inventarioSucursalServicios->all()->where('idProducto', '=', $detalleKit->getIdRefaccion())->where('idSucursal', '=', $kitJson->getSucursal()->getIdSucursal())->first();
            $stock = $stock->existencia ?? 0;

            $this->inventarioSucursalServicios->where('idProducto', '=', $detalleKit->getIdRefaccion())->where('idSucursal', '=', $kitJson->getSucursal()->getIdSucursal())->update([
                'existencia' => $stock - ($detalleKit->getCantidad() * $cantidad),
            ]);
        }

        // Check if kit already exists in inventory
        $existe = $this->inventarioSucursalServicios->where('idProducto', '=', $idKit)->where('idSucursal', '=', $kitJson->getSucursal()->getIdSucursal())->first();

        if ($existe) {
            // Increment existing stock
            $this->inventarioSucursalServicios->where('idProducto', '=', $idKit)->where('idSucursal', '=', $kitJson->getSucursal()->getIdSucursal())->increment('existencia', $cantidad);
        } else {
            // Create new inventory record
            $this->inventarioSucursalServicios->create([
                'idSucursal' => $kitJson->getSucursal()->getIdSucursal(),
                'idProducto' => $idKit,
                'existencia' => $cantidad,
                'stockMaximo' => 0,
                'stockMinimo' => 0,
                'idStatus' => 1,
            ]);
        }
    }
}
