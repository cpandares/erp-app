<x-layout.default>
    <!-- Incluir Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Incluir Select2 JS -->
    

    {{-- create form for create a coche info --}}
    <h5 class="">Nuevo Coche</h5>
    <div class="panel mt-6">
        <form action="{{ route('coches.store') }}" method="POST" class="grid grid-cols-1 gap-6" id="cocheForm">
            @csrf
            <div>
                <label for="cliente_id" class="block text-sm font-medium text-white">Cliente</label>
                <select
                     name="cliente_id" 
                     id="cliente_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                     @foreach ($clientes as $cliente)
                     <option value="{{ $cliente->id }}">{{ $cliente->name }} - {{ $cliente->document }}</option>
                 @endforeach
                </select>
            </div>
            <div>
                <label for="marca" class="block text-sm font-medium text-white">Marca</label>
                <input type="text" name="marca" id="marca" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="model" class="block text-sm font-medium text-white">Modelo</label>
                <input type="text" name="model" id="model" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="placa" class="block text-sm font-medium text-white">Placa</label>
                <input type="text" name="placa" id="placa" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="color" class="block text-sm font-medium text-white">Color</label>
                <input type="text" name="color" id="color" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-white">Año</label>
                <input type="text" name="year" id="year" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-white">Imagen</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                ">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

    <!-- Inicializar Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cliente_id').select2();
        });


        /* validate form */
        document.getElementById('cocheForm').addEventListener('submit', function(event) {
            const marca = document.getElementById('marca').value;
            const placa = document.getElementById('placa').value;
            const color = document.getElementById('color').value;
            const year = document.getElementById('year').value;
            const cliente_id = document.getElementById('cliente_id').value;
            const model = document.getElementById('model').value;

            if (!marca || !placa || !color || !year || !cliente_id || !model) {
                event.preventDefault();
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Todos los campos son requeridos',
                })
            }

            $('#cliente_id').on('change', function() {
                if (!this.value) {
                    event.preventDefault();
                    return Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El campo cliente es requerido',
                    })
                }
            });

            /* si todo esta validado submit */
            this.submit();


        });




    </script>
</x-layout.default>