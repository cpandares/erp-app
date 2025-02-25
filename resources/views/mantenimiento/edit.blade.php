<x-layout.default>
    <div class="container mx-auto">
        <div class="mb-5">
            <a href="{{ route('mantenimientos.index') }}" class="btn btn-primary inline-block">Volver</a>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
            <form id="formMantenimiento" action="{{ route('mantenimientos.store') }}" method="POST">
                @csrf
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="cliente_id" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Cliente</label>
                        <select name="cliente" id="cliente_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            
                        </select>
                        @error('cliente_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label for="numero_contacto" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Numero de Contacto</label>
                        <input type="text" name="numero_contacto" id="numero_contacto" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" placeholder="Ingrese el numero de contacto" value="{{ old('numero_contacto') }}">
                        @error('numero_contacto')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="coche" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Coche</label>
                        <select name="coche" id="coche" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></select>
                        @error('coche')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label for="placa" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Placa</label>
                        <input type="text" name="placa" id="placa" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" placeholder="Ingrese la placa del coche" value="{{ old('placa') }}">
                        @error('placa')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="fecha_ingreso" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Fecha de Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" value="{{ old('fecha_ingreso') }}">
                        @error('fecha_ingreso')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label for="tipo_servicio" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Tipo de Servicio</label>
                        <select name="servicios[]" id="servicio" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" multiple>
                            <option value="">Seleccione un servicio</option>
                            @foreach ($servicios as $item)
                                <option value="{{ $item->id }}" {{ in_array($item->id, old('servicios', [])) ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('tipo_servicio')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="encargado" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Encargado</label>
                        <select name="encargado" id="encargado" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                            
                        </select>
                        @error('encargado')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label for="valor" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Valor</label>
                        <input type="text" name="price" id="valor" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" placeholder="Ingrese el valor del servicio" value="{{ old('valor') }}">
                        @error('valor')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="iniciado" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Iniciado</label>
                        <select name="iniciado" id="iniciado" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                            <option value="1" {{ old('iniciado') == 1 ? 'selected' : '' }}>Si</option>
                            <option value="0" {{ old('iniciado') == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        @error('iniciado')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label for="estado" class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">Estado</label>
                        <select name="estado" id="estado" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded">
                            <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="En Proceso" {{ old('En Proceso') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="Finalizado" {{ old('Finalizado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                            <option value="Repoceso" {{ old('Repoceso') == 'Repoceso' ? 'selected' : '' }}>Repoceso</option>
                           {{--  ['Pendiente', 'En Proceso', 'Finalizado', 'Repoceso'] --}}

                        </select>
                        @error('estado')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3">
                        <button type="submit" class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
</x-layout.default>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
       
        $('#cliente_id').select2({
                ajax: {
                    dataType: 'json',
                    url: "{{ asset('') . 'cliente/data/ajax' }}",
                    delay: 250,
                    minimumInputLength: 3,
                    data: function(params) {
                        var query = {
                            search: params.term.toLowerCase(),
                        }

                        return query;
                    },
                    processResults: function(data, page) {
                        return {
                            results: data
                        };
                    },
                    theme: "classic"
                }
            });
        });

        /* enviar peticion al cargar el cliente y traer los coches del cliente */
        $('#cliente_id').on('select2:select', function(e) {
            const data = e.params.data;
            const cliente_id = data.id;
           const phone = data.phone;
            $('#numero_contacto').val(phone);
            $.ajax({
                url: "{{ asset('') . 'coche/data/ajax' }}",
                type: 'GET',
                data: {
                    cliente_id: cliente_id
                },
                success: function(response) {
                    if(response.ok) {
                        $('#coche').empty();
                        $('#coche').append('<option value="">Seleccione un coche</option>');
                        response.data.forEach(coche => {
                            $('#coche').append(`<option value="${coche.id}">${coche.marca} - ${coche.model}</option>`);

                            
                        });

                       

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                }
            });
        });

        $('#coche').on('change', function() {
            const coche_id = $(this).val();
            $.ajax({
                url: "{{ asset('') . 'coche/ajax' }}",
                type: 'GET',
                data: {
                    coche_id: coche_id
                },
                success: function(response) {
                    if(response.ok) {
                        $('#placa').val(response.data.placa);
                    }
                }
            });
        });

        $('#encargado').select2({
            ajax: {
                dataType: 'json',
                url: "{{ asset('') . 'empleados/data/ajax' }}",
                delay: 250,
                minimumInputLength: 3,
                data: function(params) {
                    var query = {
                        search: params.term.toLowerCase(),
                    }

                    return query;
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                },
                theme: "classic"
            }
        });

        $('#servicio').select2();

        $("#servicio").on('change', function() {
            const servicio_id = $(this).val();
            $.ajax({
                url: "{{ asset('') . 'servicios/ajax' }}",
                type: 'GET',
                data: {
                    servicio_id: servicio_id
                },
                success: function(response) {
                    if(response.ok) {
                        $('#valor').val(response.data.price);
                    }
                }
            });
        });


        $('#formMantenimiento').on('submit', function(e) {
            e.preventDefault();
            if($('#cliente_id').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo cliente es obligatorio'
                });
                return;
            }

            if($('#coche').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo coche es obligatorio'
                });
                return;
            }

            if($('#fecha_ingreso').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo fecha de ingreso es obligatorio'
                });
                return;
            }

            if($('#servicio').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo servicio es obligatorio'
                });
                return;
            }

            if($('#encargado').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo encargado es obligatorio'
                });
                return;
            }

            if($('#valor').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El campo valor es obligatorio'
                });
                return;
            }
            const data = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: data,
                success: function(response) {
                    if(response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: response.message
                        }).then(() => {
                            window.location.href = "{{ route('mantenimientos.index') }}";
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                }
            });
        });
      
</script>