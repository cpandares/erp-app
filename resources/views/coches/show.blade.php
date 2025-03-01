<x-layout.default>

    @session('success')
        <div x-data="{ open: true }" x-show="open"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline"> {{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="open = false">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path fill-rule="evenodd"
                        d="M14.95 5.05a.75.75 0 010 1.06l-4.89 4.89 4.89 4.89a.75.75 0 11-1.06 1.06l-4.89-4.89-4.89 4.89a.75.75 0 01-1.06-1.06l4.89-4.89-4.89-4.89a.75.75 0 011.06-1.06l4.89 4.89 4.89-4.89a.75.75 0 011.06 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </div>
    @endsession

    @session('error')
        <div x-data="{ open: true }" x-show="open"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline"> {{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="open = false">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path fill-rule="evenodd"
                        d="M14.95 5.05a.75.75 0 010 1.06l-4.89 4.89 4.89 4.89a.75.75 0 11-1.06 1.06l-4.89-4.89-4.89 4.89a.75.75 0 01-1.06-1.06l4.89-4.89-4.89-4.89a.75.75 0 011.06-1.06l4.89 4.89 4.89-4.89a.75.75 0 011.06 0z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </div>
    @endsession

    {{-- haz una vista aqui donde divida el row en 4 espacios para la imagen del coche y debajo informacion y en el otro lado una tabla con el historico de mantenimientoes realizadas con informacion de prueba, la fecha que se hizo el detalle el nombre del empleado y si fue cancelado en su totalidad --}}
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Coches</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>info</span>
            </li>
        </ul>
        <div class="pt-5">
            <h2 class="text-2xl font-semibold text-white-dark dark:text-white-light">Detalles del Coche</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                <div class="panel">

                    <div class="mb-5">
                        <div class="flex flex-col justify-center items-center">
                            <img src="/assets/images/profile-34.jpeg" alt="image"
                                class="w-24 h-24 rounded-full object-cover  mb-5" />
                            <p class="font-semibold text-primary text-xl">
                                Cliente: <span class="text-white">
                                    {{ $coche->cliente->name }}
                                    - {{ $coche->cliente->document }}
                                </span>
                            </p>
                        </div>
                        <ul class="mt-5 flex flex-col max-w-[160px] m-auto space-y-4 font-semibold text-white-dark">
                            <li class="flex items-center gap-2">

                                {{-- make svg icon for marca coche --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                    <path
                                        d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="text-primary truncate">
                                    Marca: <span class="text-white">
                                        {{ $coche->marca }}
                                    </span>
                                </span>


                            </li>
                            <li class="flex items-center gap-2">
                                {{-- make icon for model coche --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                    <path
                                        d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="text-primary truncate">
                                    Modelo: <span class="text-white">
                                        {{ $coche->model }}
                                    </span>
                                </span>


                            </li>
                            <li class="flex items-center gap-2">

                                {{-- make icon for placa coche --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                    <path
                                        d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="text-primary truncate">
                                    Placa: <span class="text-white">
                                        {{ $coche->placa }}
                                    </span>
                                </span>

                            </li>
                            <li class="flex items-center gap-2">
                                {{-- make svg  icon for year --}}
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                    <path
                                        d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                        d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="text-primary truncate">
                                    Año: <span class="text-white">
                                        {{ $coche->year }}
                                    </span>
                                </span>
                            </li>
                            <li class="flex items-center gap-2">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                    <path
                                        d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="whitespace-nowrap" dir="ltr">
                                    <span class="text-primary truncate">
                                        Número de contacto: <br> <span class="text-white">
                                            {{ $coche->cliente->phone }}
                                        </span>
                                    </span>
                                </span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="panel lg:col-span-2 xl:col-span-3">
                   
                    <h5 class="font-semibold text-lg dark:text-white-light text-center mb-2">Mantenimientos</h5>
                    <div class="mb-5 flex justify-between items-center">

                        {{-- add nuevo mantenimiento --}}
                        <a href="{{ url('mantenimientos/create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Mantenimiento
                        </a>
                        {{-- volver --}}
                        <a href="{{ url('coches') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                    <div class="mb-5">
                        <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                            <table class="whitespace-nowrap">
                                <thead>
                                    <tr>
                                        <th>Tipo de servicio</th>
                                        <th>Encargado</th>
                                        <th>Valor</th>
                                        <th>Iniciado en:</th>
                                        <th>Finalizado en:</th>

                                        <th>Estado</th>
                                        <th colspan="2">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="dark:text-white-dark">
                                    @if ($coche->mantenimientos->count() > 0)
                                        @foreach ($coche->mantenimientos as $mantenimiento)
                                            <tr>
                                                <td> <span class="text-primary">
                                                        {!! implode('<br>', $mantenimiento->servicios->pluck('name')->toArray()) !!}
                                                    </span></td>
                                                <td>
                                                    @if ($mantenimiento->empleado == null)
                                                        <span class="text-red-500">Sin asignar</span>
                                                    @else
                                                        {{ $mantenimiento->empleado->name }}
                                                        {{ $mantenimiento->empleado->last_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $mantenimiento->value }}</td>
                                                <td class="text-center">
                                                    {{ $mantenimiento->start_at }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($mantenimiento->end_at != null)
                                                        {{ $mantenimiento->end_at }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $mantenimiento->status }}</td>
                                                <td>
                                                    <a href="{{ url('mantenimientos/' . $mantenimiento->id) }}"
                                                        class="btn btn-outline-primary">
                                                        <i class="fas fa-eye"></i>

                                                    </a>

                                                    <button href="javascript:;" class="btn btn-outline-danger"
                                                        onClick="deletemantenimiento({{ $mantenimiento->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr></tr>
                                        <td colspan="6" class="text-center">No hay mantenimientoes registradas</td>
                                        </tr>

                                    @endif


                                </tbody>
                            </table>
                        </div>

                         <!-- Nueva sección para las imágenes del coche -->
                    <div class="panel mt-5" x-data="{ openUploadModal: false }">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="font-semibold text-lg dark:text-white-light">Imágenes del Coche</h5>
                            <button @click="openUploadModal = true" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Cargar Imágenes
                            </button>
                        </div>

                        <!-- Mostrar imágenes actuales del coche -->
                        <div class="mt-2 flex flex-wrap gap-4">
                            @if ($coche->images->count() > 0)
                            @foreach($coche->images as $imagen)
                            <div x-data="{ open: false }" class="relative inline-block">
                                <img
                                    src="{{ asset($imagen->path) }}"
                                    alt="Imagen del Coche"
                                    class="w-32 h-32 object-cover rounded cursor-pointer"
                                    @click="open = true"
                                />
                                <div
                                    x-show="open"
                                    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50"
                                    x-transition
                                    @click.self="open = false"
                                >
                                    <div class="bg-white rounded p-2 max-w-xl">
                                        <img
                                            src="{{ asset($imagen->path) }}"
                                            alt="Imagen del Coche"
                                            class="max-h-screen object-contain"
                                        />
                                        <button
                                            class="mt-2 btn btn-secondary"
                                            @click="open = false"
                                        >
                                            Cerrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <p class="text-white-dark">No hay imágenes asociadas a este coche.</p>
                            @endif
                        </div>

                        <!-- Modal para subir imágenes -->
                        <div x-show="openUploadModal"
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                            x-transition>
                            <div class="bg-white dark:bg-[#1b2e4b] p-6 rounded shadow max-w-md w-full relative">
                                <h2 class="text-xl font-semibold mb-4 dark:text-white-light">Subir Imágenes</h2>
                                <form method="POST" action="{{ route('coches.uploadImage', $coche->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="images[]" multiple class="mb-4" />
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" @click="openUploadModal = false"
                                            class="btn btn-secondary">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Subir
                                        </button>
                                    </div>
                                </form>
                                <!-- Botón de cierre (opcional) -->
                                <button @click="openUploadModal = false"
                                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>


</x-layout.default>


<script>
    function deletemantenimiento(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/mantenimientos/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.ok) {
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: true,

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        } else {
                            Swal.fire({
                                title: '¡Error!',
                                text: response.message,
                                icon: 'error',
                                showConfirmButton: true,

                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            title: '¡Error!',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: true,

                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload()
                            }
                        })
                    }

                })
            }

        })
    }
</script>
