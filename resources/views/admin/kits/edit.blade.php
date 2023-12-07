<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.kits.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Ver Kits
                </a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.kits.update', $kit->idProducto) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <div class="mt-1">
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $kit->nombre) }}" class="@error('nombre') border-red-500 @enderror block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('nombre')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="sm:col-span-6">
                        <label for="imagen" class="block text-sm font-medium text-gray-700"> Imagen </label>
                        <div>
                            <img class="w-32 h-32" src="{{ Storage::url($kit->imagen) }}">
                        </div>
                        <div class="mt-1">
                            <input type="file" id="imagen" name="imagen" class="class="@error('imagen') border-red-500 @enderror block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('imagen')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="sm:col-span-6">
                        <label for="precio" class="block text-sm font-medium text-gray-700"> Precio </label>
                        <div class="mt-1">
                            <input type="number" min="0.00" max="10000.00" step="0.01" id="precio" name="precio"
                            value="{{ $kit->precio }}" 
                            class="class="@error('precio') border-red-500 @enderror block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('precio')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                        </div>
                        
                        <div class="sm:col-span-6 pt-5">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <div class="mt-1">
                            <textarea id="descripcion" rows="3" name="descripcion"
                            class="class="@error('descripcion') border-red-500 @enderror shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            >{{$kit->descripcion}}</textarea>
                        </div>
                        @error('descripcion')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <div class="mt-1">
                                <input type="number" min="0" id="stock" name="stock" class="@error('stock') border-red-500 @enderror block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" value="{{ $kit->stock }}" />
                            </div>
                            @error('stock')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="productos" class="block text-sm font-medium text-gray-700">Productos</label>
                            <div class="mt-1">
                                <select multiple id="productos" name="productos[]"
                                    class="form-multiselect block w-full mt-1">
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->id }}" {{ in_array($producto->id, old('productos', $kit->productos->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $producto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('productos')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <div class="mt-6 p-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>