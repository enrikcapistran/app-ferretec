<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <form action="{{ route('admin.surtidos.finalizarSurtido') }}" method="post">


                    <div class="sm:col-span-6 pt-5">
                        <label for="sucursal" class="block text-sm font-medium text-gray-700">Sucursal</label>
                        <div class="mt-1">
                            <select id="sucursal" name="sucursal" class="form-select block w-full mt-1">
                                @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->idSucursal }}">{{ $sucursal->nombreSucursal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @error('sucursal')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror

                    <!-- Product Selection -->
                    <div class="sm:col-span-6 pt-5">
                        <label for="productSelect" class="block text-sm font-medium text-gray-700">Producto</label>
                        <div class="mt-1 flex">
                            <select id="productSelect" class="form-select block w-full mt-1">
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                <option value="{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</option>
                                @endforeach
                            </select>
                            <input type="number" id="productQuantity" placeholder="Cantidad" class="form-input ml-2">
                            <button type="button" onclick="addProduct()" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white ml-2">
                                Agregar
                            </button>
                        </div>
                    </div>

                    <!-- Selected Products List -->
                    <div class="sm:col-span-6 pt-5">
                        <label class="block text-sm font-medium text-gray-700">Productos Seleccionados</label>
                        <ul id="selectedProductsList" class="list-disc pl-5 mt-2"></ul>
                    </div>
                    <div class="mt-6 p-4">
<form action="{{ route('admin.surtidos.finalizarSurtido') }}" method="post" id="productForm">
    <!-- Existing form content... -->
</form>

                    @csrf

                    <button type="submit" class="ml-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                        Enviar
                    </button>
                </form>
            </div>
        </div>

        <script>
            var selectedProducts = [];

            function addProduct() {
                var select = document.getElementById('productSelect');
                var idProduct = select.value;
                var quantity = document.getElementById('productQuantity').value;

                if (!idProduct || quantity <= 0) {
                    alert('Seleccione un producto y especifique la cantidad.');
                    return;
                }

                for (var i = 0; i < selectedProducts.length; i++) {
                    if (selectedProducts[i].idProducto == idProduct) {
                        alert('Este producto ya ha sido agregado.');
                        return;
                    }
                }

                var productName = select.options[select.selectedIndex].text;
                var selectedProductsList = document.getElementById('selectedProductsList');

                var li = document.createElement('li');
                li.id = 'product-' + idProduct;
                li.textContent = `${productName}, Cantidad: ${quantity} `;
                var removeButton = document.createElement('button');
                removeButton.textContent = 'Eliminar';
                removeButton.onclick = function() {
                    removeProduct(idProduct);
                };
                li.appendChild(removeButton);
                selectedProductsList.appendChild(li);

                selectedProducts.push({
                    idProducto: idProduct
                    , cantidad: quantity
                });

                // Reset the selection
                select.value = '';
                document.getElementById('productQuantity').value = '';
            }

            function removeProduct(idProduct) {
                var productElement = document.getElementById('product-' + idProduct);
                for (var i = 0; i < selectedProducts.length; i++) {
                    if (selectedProducts[i].idProducto == idProduct) {
                        selectedProducts.splice(i, 1);
                        break;
                    }
                }
            }

            document.getElementById('kitForm').onsubmit = function(e) {
                // Clear any previously created hidden inputs
                document.querySelectorAll('.dynamic-input').forEach(el => el.remove());

                selectedProducts.forEach(function(product, index) {
                    var inputIdProducto = document.createElement('input');
                    inputIdProducto.type = 'hidden';
                    inputIdProducto.name = 'productos[' + index + '][idProducto]';
                    inputIdProducto.value = product.idProducto;
                    inputIdProducto.className = 'dynamic-input'; // Add a class for easy removal if needed
                    this.appendChild(inputIdProducto);

                    var inputCantidad = document.createElement('input');
                    inputCantidad.type = 'hidden';
                    inputCantidad.name = 'productos[' + index + '][cantidad]';
                    inputCantidad.value = product.cantidad;
                    inputCantidad.className = 'dynamic-input'; // Add a class for easy removal if needed
                    this.appendChild(inputCantidad);
                }, this);
            };

        </script>

        @error('productos')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror


    </div>
    </div>
    </div>
</x-admin-layout>
