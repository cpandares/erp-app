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
                <a href="javascript:;" class="text-primary hover:underline">Users</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Profile</span>
            </li>
        </ul>

        <div class="pt-5">


            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Perfil del Coche</h5>
                        
                    </div>
                    <div class="mb-5">
                        <div x-data="{ open: false }" class="relative inline-block">
                        <div class="flex flex-col justify-center items-center">
                            @if ($coche->images->count() > 0)
                            <img src="{{ asset($coche->images->first()->path) }}" alt="image"
                                alt="image"
                                class="object-cover  mb-5 w-40 h-40 rounded-full shadow-[0_4px_9px_0_rgba(31,45,61,0.31)] cursor-pointer" 
                                @click="open = true"
                                />
                            @else
                            <img src="https://t4.ftcdn.net/jpg/09/33/57/79/360_F_933577966_8wtwxqH3JpEKVopTUkpNbiUB5PKcmwLH.jpg" alt="image"
                                alt="image"
                                class="object-cover  mb-5 w-40 h-40 rounded-full shadow-[0_4px_9px_0_rgba(31,45,61,0.31)] cursor-pointer" 
                               
                                />
                            @endif
                           

                            <div
                                    x-show="open"
                                    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50"
                                    x-transition
                                    @click.self="open = false"
                                >
                                    <div class="bg-white rounded p-2 max-w-xl">
                                        @if ($coche->images->count() > 1)
                                            
                                            <img
                                                    src="{{ asset($coche->images->first()->path) }}"
                                                alt="Imagen del Coche"
                                                class="max-h-screen object-contain"
                                            />
                                            <button
                                                class="mt-2 btn btn-secondary"
                                                @click="open = false"
                                            >
                                                Cerrar
                                            </button>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        </div>
                        <ul class="mt-5 flex flex-col max-w-[160px] m-auto space-y-4 font-semibold text-white-dark">
                            <li class="flex items-center gap-2">

                                <i class="fas fa-car"></i>
                                {{ $coche->marca }}
                            </li>
                            
                            <li class="flex items-center gap-2">

                                <i class="fas fa-car"></i>
                                {{ $coche->model }}
                                
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-id-card"></i>
                                {{ $coche->placa }}
                               
                            </li>
                            <li>
                                <i
                                    class="fas fa-calendar-alt"></i>
                                
                                    {{ $coche->year }}
                               
                            </li>
                            <li class="flex items-center gap-2">

                                <i class="fas fa-user"></i>
                                {{ $coche->cliente->name }} {{ $coche->cliente->lastname }}
                                
                                {{ $coche->cliente->phone }}
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <div class="panel lg:col-span-2 xl:col-span-3">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Mantenimientos</h5>
                    </div>
                    
                        <div class="flex justify-between items-center mb-5">
                            {{-- crear mantenimiento --}}
                            <a href="{{ url('mantenimientos/create?id=' . base64_encode($coche->id)) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Crear Mantenimiento
                            </a>
                            {{-- volver --}}
                            <a href="{{ url('coches') }}" class="btn btn-secondary m-2">
                                <i class="fas fa-arrow-left"></i>
                                Volver
                            </a>
                        </div>
                        @if (count($coche->mantenimientos) == 0)
                            
                            <div class="flex justify-center items-center h-40">
                                <p class="text-white-dark font-bold text-lg">No hay mantenimientos registrados</p>
                            </div>
                        @else
                            
                            @foreach ($coche->mantenimientos  as $mantenimiento)
                                
                            <div class="mb-5">
                                <p class="text-white-dark font-bold mb-5 text-base">
                                    {{ $mantenimiento->start_at }}
                                </p>
                                <div class="sm:flex">
                                    <div
                                        class="relative mx-auto mb-5 sm:mb-0 ltr:sm:mr-8 rtl:sm:ml-8 z-[2] before:absolute before:top-12 before:left-1/2 before:-bottom-[15px] before:-translate-x-1/2 before:border-l-2 before:border-[#ebedf2] before:w-0 before:h-auto before:-z-[1] dark:before:border-[#191e3a] before:hidden sm:before:block">
                                        <img src="/assets/images/profile-16.jpeg" alt="image"
                                            class="w-12 h-12 mx-auto rounded-full shadow-[0_4px_9px_0_rgba(31,45,61,0.31)]" />
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-primary text-xl font-bold text-center ltr:sm:text-left rtl:sm:text-right">
                                        <span class="text-white">Encargado:</span>   {{ $mantenimiento->empleado->name }} {{ $mantenimiento->empleado->lastname }}
                                        </h4>
                                        <p class="text-center ltr:sm:text-left rtl:sm:text-right">5 sec</p>
                                        <div class="mt-4 sm:mt-7 mb-16">
            
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-white-dark ltr:mr-2.5 rtl:ml-2.5 inline-block align-text-bottom">
                                                <path opacity="0.5"
                                                    d="M2 12H22M16 12C16 13.3132 15.8965 14.6136 15.6955 15.8268C15.4945 17.0401 15.1999 18.1425 14.8284 19.0711C14.457 19.9997 14.016 20.7362 13.5307 21.2388C13.0454 21.7413 12.5253 22 12 22C11.4747 22 10.9546 21.7413 10.4693 21.2388C9.98396 20.7362 9.54301 19.9997 9.17157 19.0711C8.80014 18.1425 8.5055 17.0401 8.30448 15.8268C8.10346 14.6136 8 13.3132 8 12C8 10.6868 8.10346 9.38642 8.30448 8.17316C8.5055 6.95991 8.80014 5.85752 9.17157 4.92893C9.54301 4.00035 9.98396 3.26375 10.4693 2.7612C10.9546 2.25866 11.4747 2 12 2C12.5253 2 13.0454 2.25866 13.5307 2.76121C14.016 3.26375 14.457 4.00035 14.8284 4.92893C15.1999 5.85752 15.4945 6.95991 15.6955 8.17317C15.8965 9.38642 16 10.6868 16 12Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                <path
                                                    d="M22 12C22 13.3132 21.7413 14.6136 21.2388 15.8268C20.7362 17.0401 19.9997 18.1425 19.0711 19.0711C18.1425 19.9997 17.0401 20.7362 15.8268 21.2388C14.6136 21.7413 13.3132 22 12 22C10.6868 22 9.38642 21.7413 8.17317 21.2388C6.95991 20.7362 5.85752 19.9997 4.92893 19.0711C4.00035 18.1425 3.26375 17.0401 2.7612 15.8268C2.25866 14.6136 2 13.3132 2 12C2 10.6868 2.25866 9.38642 2.76121 8.17316C3.26375 6.95991 4.00035 5.85752 4.92893 4.92893C5.85752 4.00035 6.95991 3.26375 8.17317 2.7612C9.38642 2.25866 10.6868 2 12 2C13.3132 2 14.6136 2.25866 15.8268 2.76121C17.0401 3.26375 18.1425 4.00035 19.0711 4.92893C19.9997 5.85752 20.7362 6.95991 21.2388 8.17317C21.7413 9.38642 22 10.6868 22 12L22 12Z"
                                                    stroke="currentColor" stroke-width="1.5" />
                                            </svg>
                                            <h6 class="inline-block font-bold mb-2 text-lg">
                                                {!! implode(' - ', $mantenimiento->servicios->pluck('name')->toArray()) !!}
                                            </h6>
                                            <p class="ltr:pl-8 rtl:pr-8 text-white-dark font-semibold"> 
                                                {{ $mantenimiento->description}}    
                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>

                            
                            </div>
                            @endforeach
                        @endif


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
