<x-layout.default>

    <div class="panel lg:col-span-2 xl:col-span-3">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Mantenimientos</h5>
        </div>
        <div class="mb-5">
            <div class="flex justify-end mb-2">
                {{-- <input type="text" class="form-input" placeholder="Buscar..."> --}}
                <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary">Crear Mantenimiento</a>

            </div>
            <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                <table class="whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Numero de Contacto</th>
                            <th>Coche</th>
                            <th>Placa</th>
                            <th>Fecha de Ingreso</th>
                            
                            <th>Encargado</th>
                            
                            <th class="text-center">Fecha de Registro</th>
                            <th>Estado</th>
                            <th >

                            </th>
                        </tr>
                    </thead>
                    <tbody class="dark:text-white-dark">
                       @foreach ($mantenimientos as $item)
                        <tr>
                            <td>{{ $item->cliente->name }}</td>
                            <td>{{ $item->cliente->phone }}</td>
                            <td>{{ $item->coche->marca }}</td>
                            <td>{{ $item->coche->placa }}</td>
                            <td>{{ $item->fecha_ingreso }}</td>
                            
                            <td>
                                {{ $item->empleado->name }}
                                {{ $item->empleado->last_name }}
                            </td>
                            
                            
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="{{ route('mantenimientos.show', $item->id) }}" class="btn btn-success mb-1">Ver</a>
                                <a href="{{ route('mantenimientos.edit', $item->id) }}" class="btn btn-primary mb-1">Editar</a>
                                <form action="{{ route('mantenimientos.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                       @endforeach                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.default>
