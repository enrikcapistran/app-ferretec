CREATE DATABASE refacciones;
use refacciones;


CREATE TABLE status  (
  idStatus TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,    
  nombreStatus VARCHAR(15) NOT NULL,    
  creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE pago  (
  idPago TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,    
  metodoDePago VARCHAR(15) NOT NULL,    
  idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
  creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE roles (
  idRol TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
  tipoDeUsuario VARCHAR(20) NOT NULL,   
  creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tipoProducto (
  idTipoProducto TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
  tipoDeProducto VARCHAR(20) NOT NULL,   
  creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
  idUsuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
  email VARCHAR(60) NOT NULL UNIQUE, 
  contraseña VARCHAR(255) NOT NULL,   
  apellidoPaterno VARCHAR(15) NOT NULL,   
  apellidoMaterno VARCHAR(15) NOT NULL,   
  nombre VARCHAR(30) NOT NULL,   
  fechaNacimiento DATE NOT NULL,  
  idRol TINYINT UNSIGNED NOT NULL,  
  idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
  creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (idRol) REFERENCES roles(idRol),
  FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE direcciones (
    idDireccion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT UNSIGNED,
    calle VARCHAR(30) NOT NULL,
    colonia VARCHAR(30) NOT NULL,
    numero INT UNSIGNED NOT NULL,
    CP INT UNSIGNED NOT NULL,
    referencia VARCHAR(50) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
	idStatus  TINYINT UNSIGNED NOT NULL DEFAULT 1,  
    creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idUsuario ) REFERENCES usuarios (idUsuario),
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE sucursales (
    idSucursal INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombreSucursal VARCHAR(50) NOT NULL,
    calle VARCHAR(50) NOT NULL, 	
    colonia VARCHAR(50) NOT NULL,
    numero INT UNSIGNED NOT NULL,
    CP INT UNSIGNED NOT NULL,  
    telefono VARCHAR(10) NOT NULL,
    idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
    creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE productos (
    idProducto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombreProductos VARCHAR(50) NOT NULL,
    descripcion TEXT,
    imágen TEXT,
    precioUnitario DECIMAL (10,2) NOT NULL,
    idTipoProducto TINYINT UNSIGNED NOT NULL CHECK (idTipoProducto BETWEEN 1 AND 2),
    idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
	creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idTipoProducto) REFERENCES tipoProducto(idTipoProducto),
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE refacciones (
    idProducto INT UNSIGNED PRIMARY KEY,
    SKU VARCHAR(20) NOT NULL UNIQUE,
    idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
	creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idProducto ) REFERENCES productos (idProducto),
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE kits (
    idProducto INT UNSIGNED PRIMARY KEY,
    idSucursal INT UNSIGNED NOT NULL,
    idUsuarioCreador INT UNSIGNED NOT NULL,
    idUsuarioAutorizador INT UNSIGNED,
    idstatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
	creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idProducto ) REFERENCES productos (idProducto),
	FOREIGN KEY (idSucursal) REFERENCES sucursales (idSucursal),
	FOREIGN KEY (idUsuarioCreador ) REFERENCES usuarios (idUsuario),
	FOREIGN KEY (idUsuarioAutorizador ) REFERENCES usuarios (idUsuario),
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE detalleKits (
    idKit INT UNSIGNED NOT NULL,
    idRefaccion INT UNSIGNED NOT NULL,
    cantidad SMALLINT UNSIGNED NOT NULL,
    INDEX idxIdKitIdRefaccion (idKit, idRefaccion),
    FOREIGN KEY (idKit) REFERENCES kits(idProducto)	,
    FOREIGN KEY (idRefaccion) REFERENCES refacciones(idProducto)
);

CREATE TABLE inventarioSucursales (
    idSucursal INT UNSIGNED NOT NULL,
    idProducto INT UNSIGNED NOT NULL,
    existencia INT UNSIGNED NOT NULL,
    stockMaximo INT UNSIGNED NOT NULL,
    stockMinimo INT UNSIGNED NOT NULL,
    idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
    INDEX idxIdSucursalIdProducto (idSucursal, idProducto),
    FOREIGN KEY (idSucursal) REFERENCES sucursales(idSucursal),
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto),
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE kitsPendientes (
    idSucursal INT UNSIGNED NOT NULL,
    idKit INT UNSIGNED NOT NULL,
    existenciaFaltante SMALLINT UNSIGNED NOT NULL,
    INDEX idxIdSucursalIdProducto (idSucursal, idKit),
    FOREIGN KEY (idSucursal) REFERENCES sucursales(idSucursal),
    FOREIGN KEY (idKit) REFERENCES kits(idProducto)
    );

CREATE TABLE ventas (
    folio INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idSucursal INT UNSIGNED NOT NULL,
    idEmpleado INT UNSIGNED NOT NULL,
    idCliente INT UNSIGNED NOT NULL,
    idPago TINYINT UNSIGNED NOT NULL,  
    fechaVenta TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    totalPago DECIMAL(10,2) UNSIGNED NOT NULL,
    idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
    creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	status  TINYINT UNSIGNED NOT NULL  DEFAULT 1, 
    FOREIGN KEY (idSucursal) REFERENCES sucursales(idSucursal),
    FOREIGN KEY (idEmpleado) REFERENCES usuarios(idUsuario),
    FOREIGN KEY (idCliente) REFERENCES usuarios(idUsuario),
    FOREIGN KEY (idPago) REFERENCES pago(idPago),
    FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE lineaDeVenta (
    idLineaDeVenta INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idVenta INT UNSIGNED NOT NULL,
	idProducto INT UNSIGNED,
    cantidad INT UNSIGNED NOT NULL,
    precioUnitario DECIMAL(10, 2) NOT NULL,
	idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
    creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (idVenta) REFERENCES ventas(folio),
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto),
    FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE carritoDeCompra (
    idCarrito INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT UNSIGNED UNIQUE NOT NULL,  
    idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
    creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (idUsuario ) REFERENCES usuarios (idUsuario),
    FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE detalleCarrito (
  idCarrito INT UNSIGNED NOT NULL,  
  idProducto  INT UNSIGNED NOT NULL,
  cantidad TINYINT UNSIGNED NOT NULL,
  INDEX idxIdCarritoIdProducto (idCarrito, idProducto),
  FOREIGN KEY (idCarrito ) REFERENCES carritoDeCompra (idCarrito),
  FOREIGN KEY (idProducto ) REFERENCES productos (idProducto)
);

CREATE TABLE almacen (
    idAlmacen INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombreAlmacen VARCHAR(50) NOT NULL,
    calle VARCHAR(50) NOT NULL,
    colonia VARCHAR(50) NOT NULL,
    numero INT UNSIGNED NOT NULL,
    CP INT UNSIGNED NOT NULL,
	idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 1,  
    creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus)
);

CREATE TABLE inventarioAlmacen (
    idAlmacen INT UNSIGNED NOT NULL,
    idRefaccion INT UNSIGNED NOT NULL,
    existencia INT UNSIGNED NOT NULL,
    INDEX idxIdAlmacenIdRefaccion (idAlmacen, idRefaccion),
	FOREIGN KEY (idAlmacen) REFERENCES almacen(idAlmacen),
    FOREIGN KEY (idRefaccion) REFERENCES refacciones(idProducto)
);

CREATE TABLE pedidoSurtido (
    idSurtido INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idAlmacen INT UNSIGNED NOT NULL DEFAULT 1,
    idSucursal  INT UNSIGNED NOT NULL,
    fechaDePedido TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaDeRecibido DATETIME,
	idStatus  TINYINT UNSIGNED NOT NULL  DEFAULT 3,  
	FOREIGN KEY (idStatus ) REFERENCES status (idStatus),
	FOREIGN KEY (idAlmacen) REFERENCES almacen(idAlmacen),
    FOREIGN KEY (idSucursal) REFERENCES sucursales(idSucursal)
);


CREATE TABLE detalleSurtido (
    idSurtido INT UNSIGNED,
    idRefaccion INT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL,
	creadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizadoEn TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	INDEX idxIdSurtidoIdRefaccion (idSurtido, idRefaccion),
    FOREIGN KEY (idSurtido) REFERENCES pedidoSurtido(idSurtido),
    FOREIGN KEY (idRefaccion) REFERENCES refacciones(idProducto)
);
