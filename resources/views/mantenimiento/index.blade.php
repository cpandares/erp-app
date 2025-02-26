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
                                @if ($item->empleado)
                                {{ $item->empleado->name }}
                                {{ $item->empleado->last_name }}
                                    
                                @endif
                            </td>
                            
                            
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="{{ route('mantenimientos.show', $item->id) }}" class="btn btn-success mb-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('mantenimientos.edit', $item->id) }}" class="btn btn-primary mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                             {{--    <form action="{{ route('mantenimientos.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form> --}}
                                <button
                                type="button"
                                onclick="deleteMantenimiento({{ $item->id }})"
                                class="btn btn-danger"
                                >
                                <i
                                    class="fas fa-trash"
                                    aria-hidden="true"
                                ></i>
                                </button>
                            </td>
                        </tr>
                       @endforeach                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.default>


<script>
    function deleteMantenimiento(id){
       
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/mantenimientos/${id}`,
                        type: 'DELETE',
                        /* csrf */
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if(response.ok){
                                Swal.fire({
                                title: 'Eliminado!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: true,
                                
                            }).then(() => {
                                window.location.reload();
                            });
                            }else{
                                Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                showConfirmButton: true,
                                
                            }).then(() => {
                                window.location.reload();
                            });
                            }
                            
                        },
                        error: function(response){
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                showConfirmButton: true,
                                
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                }
            })
        }
</script>
