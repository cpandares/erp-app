<x-layout.default>

    @session('success')
        <div x-data="{ open: true }" x-show="open" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline"> {{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="open = false">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path fill-rule="evenodd" d="M14.95 5.05a.75.75 0 010 1.06l-4.89 4.89 4.89 4.89a.75.75 0 11-1.06 1.06l-4.89-4.89-4.89 4.89a.75.75 0 01-1.06-1.06l4.89-4.89-4.89-4.89a.75.75 0 011.06-1.06l4.89 4.89 4.89-4.89a.75.75 0 011.06 0z" clip-rule="evenodd" />
                </svg>
            </span>
        </div>
    @endsession

    {{-- haz una vista aqui donde divida el row en 4 espacios para la imagen del coche y debajo informacion y en el otro lado una tabla con el historico de reparaciones realizadas con informacion de prueba, la fecha que se hizo el detalle el nombre del empleado y si fue cancelado en su totalidad --}}
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Coches</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>info</span>
            </li>
        </ul>
        <div class="pt-5" x-data="mantenimiento({{ $mantenimiento->id }})">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                <div class="panel">
                    <div class="flex items-center justify-between mb-5 text-center" >
                        <h5 class="font-semibold text-lg dark:text-white-light ">Detalle del Coche</h5>
                        
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-col justify-center items-center">
                            <img src="/assets/images/profile-34.jpeg" alt="image"
                                class="w-24 h-24 rounded-full object-cover  mb-5" />
                            <p class="font-semibold text-primary text-xl">
                                Cliente: <span class="text-white">
                                    {{ $mantenimiento->cliente->name }}
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
                                    Marca: <span class="text-white">Toyota</span>
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
                                    Modelo: <span class="text-white">Corolla</span>
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
                                    Placa: <span class="text-white">ABC-123</span>
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
                                    Año: <span class="text-white">2021</span>
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
                                    Número de contacto: <br><span class="text-white">
                                        {{ $mantenimiento->cliente->phone }}
                                    </span>
                                </span>
                            </li>
                        </ul>
                       
                    </div>
                </div>
                <div class="panel lg:col-span-2 xl:col-span-3">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Mantenimientos</h5>
                    </div>
                    <div class="mb-5">
                        <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                            <table class="whitespace-nowrap">
                                <thead>
                                    <tr>
                                        <th>Servicios</th>
                                        <th>Encargado</th>
                                        <th>Valor</th>
                                        <th >Iniciado en:</th>
                                        @if($mantenimiento->status == 'Finalizado')
                                        <th>
                                            Finalizado:
                                        </th>
                                        @endif
                                        <th>Estado</th>
                                        <th >

                                        </th>
                                    </tr>
                                </thead>
                                
                                <tbody class="dark:text-white-dark">
                                    
                                            <tr>
                                                <td>
                                                    <span class="text-primary">
                                                        {!! implode('<br>', $mantenimiento->servicios->pluck('name')->toArray()) !!}
                                                    </span>
                                                </td>
                                                <td>{{ $mantenimiento->empleado->name }}</td>
                                                <td>
                                                    @php
                                                        $total = 0;
                                                        foreach ($mantenimiento->servicios as $item) {
                                                            $total += $item->price;
                                                        }
                                                        echo $total;
                                                    @endphp
                                                </td>
                                                <td >{{ $mantenimiento->start_at }}</td>
                                                @if($mantenimiento->status == 'Finalizado')
                                                <td>
                                                    {{ $mantenimiento->end_at }}
                                                </td>
                                                @endif
                                                <td>{{ $mantenimiento->status }}</td>
                                                <td>
                                                   {{-- icono de ver y abrir un modal --}}
                                                    

                                                    {{-- icono de editar y abrir un modal --}}
                                                    <button 
                                                    @click="openModal('edit', {{ $mantenimiento->id }})"
                                                     class="btn btn-primary mb-1" 
                                                       

                                                        >
                                                        <i class="fa-solid fa-edit"></i>
                                                    </button>

                                                    {{-- icono de eliminar y abrir un modal --}}    
                                                    <a 
                                                        x-tooltip="Eliminar Mantenimiento" 
                                                             :data-placement="$store.app.rtlClass === 'rtl' ? 'left' : 'right'" role="tooltip"
                                                        href="javascript:;" class="btn btn-danger mb-1">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>

                                                    {{-- imprimir factura --}}
                                                    @if ($mantenimiento->status == 'Finalizado')
                                                    <a href="{{url('mantenimientos/factura/' . $mantenimiento->id)}}" 
                                                         x-tooltip="Exportar Factura" 
                                                             :data-placement="$store.app.rtlClass === 'rtl' ? 'left' : 'right'" role="tooltip"
                                                        class="btn btn-info mb-1" 
                                                        target="_blank"
                                                        >
                                                        <i class="fa-solid fa-print"></i>
                                                    </a>
                                                        
                                                    @endif
                                                   
                                                    {{-- Reportar Pago --}}
                                                    @if ($mantenimiento->status == 'En Proceso')
                                                    
                                                        <a 
                                                            href="javascript:;"
                                                             class="btn btn-success mb-1"
                                                             x-tooltip="Reportar Pago" 
                                                             :data-placement="$store.app.rtlClass === 'rtl' ? 'left' : 'right'" role="tooltip"
                                                            @click="openModal('factura', {{ $mantenimiento->id }})"
                                                             >
                                                            <i class="fa-solid fa-money-check"></i>
                                                        </a>
                                                        
                                                    @endif
                                                   
                                                </td>
                                            </tr>                                  
                                   
                                </tbody>
                            </table>
                        </div>
                        {{-- total de horas invertidas --}}
                        @if ($mantenimiento->status == 'Finalizado')
                            <div class="flex justify-end items-center mt-8">
                                <p class="font-semibold text-white-dark">
                                    Total de horas invertidas: <span class="text-primary">
                                        @php
                                            $start = new DateTime($mantenimiento->start_at);
                                            $end = new DateTime($mantenimiento->end_at);
                                            $interval = $end->diff($start);
                                            echo $interval->format('%H horas %i minutos');
                                        @endphp
                                    </span>
                                </p>    
                            </div>
                            
                        @endif
                        
                    </div>
                </div>
            </div>

            <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto hidden" :class="addContactModal && '!block'">
                <div class="flex items-center justify-center min-h-screen px-4" @click.self="addContactModal = false">
                    <div x-show="addContactModal" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full max-w-lg w-[90%] my-8">
                        <button type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-white-dark hover:text-dark" @click="addContactModal = false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <h3 class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]" x-text="params.id ? 'Actualizar Mantenimiento' : 'Agregar Mantenimiento'"></h3>
                        <div class="p-5">
                            <form @submit.prevent="saveMaintenance" x-ref="editMaintenanceForm" class="grid grid-cols-1 gap-5">
                                <div class="mb-5">
                                    <label for="status">Estado</label>
                                    <select id="status" name="status" class="form-select" x-model="params.status">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="En Proceso">En Proceso</option>
                                        {{-- <option value="Finalizado">Finalizado</option> --}}
                                        <option value="Repoceso">Repoceso</option>
                                    </select>
                                </div>
                                <div class="mb-5">
                                    <label for="end_at">Fecha y hora de Finalización</label>
                                    {{-- <input id="end_at" name="end_at" type="date" class="form-input" x-model="params.end_at" /> --}}
                                    <input type="datetime-local" name="end_at" id="end_at" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" x-model="params.end_at">
                                </div>
                                <div class="mb-5">
                                    <label for="end_at">Valor Final</label>
                                    <input id="value" name="value" type="number" class="form-input" x-model="params.value" />
                                </div>
                                <div class="flex justify-end items-center mt-8">
                                    <button type="button" class="btn btn-outline-danger" @click="addContactModal = false">Cancelar</button>
                                    <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4" x-text="params.id ? 'Actualizar' : 'Agregar'"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto hidden" :class="facturaModal && '!block'">
                <div class="flex items-center justify-center min-h-screen px-4" @click.self="facturaModal = false">
                    <div x-show="facturaModal" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full max-w-lg w-[90%] my-8">
                        <button type="button" class="absolute top-4 ltr:right-4 rtl:left-4 text-white-dark hover:text-dark" @click="facturaModal = false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <h3 class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">Reportar Pago</h3>
                        <div class="p-5">
                            <form @submit.prevent="reportPayment" x-ref="reportPaymentForm" class="grid grid-cols-1 gap-5">

                                <div class="mb-5">
                                    <label for="payment_date">Fecha de Pago</label>
                                    <input id="payment_date" name="payment_date" type="date" class="form-input" x-model="params.payment_date" required />
                                </div>
                                <div class="mb-5">
                                    <label for="payment_date">Forma de Pago</label>
                                    <select id="payment_method" name="payment_method" class="form-select" x-model="params.payment_method" required>
                                        @foreach ($formaPago as $method)
                                            <option value="{{ $method }}">{{ $method }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-5 hidden" id="chckComprobante">
                                    <label for="comprobante"># Comprobante</label>
                                    <input id="comprobante" name="comprobante" type="text" class="form-input" x-model="params.comprobante" />
                                </div>
                                <div class="mb-5">
                                    <label for="payment_amount">Monto del Pago</label>
                                    <input id="payment_amount" name="payment_amount" type="number" class="form-input" x-model="params.payment_amount" required />
                                </div>
                                <div class="flex justify-end items-center mt-8">
                                    <button type="button" class="btn btn-outline-danger" @click="facturaModal = false">Cancelar</button>
                                    <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Reportar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


</x-layout.default>


{{-- 
    1. Crear un modal para editar el mantenimiento
    2. Crear un modal para eliminar el mantenimiento
    3. Crear un modal para imprimir la factura
    4. Crear un modal para ver el mantenimiento
     --}}

     <script>

        $("#payment_method").change(function() {
            if ($(this).val() === 'Efectivo' || $(this).val() === 'Tarjeta') {
                $("#chckComprobante").addClass('hidden');
            } else {
                $("#chckComprobante").removeClass('hidden');
            }
        });


        document.addEventListener("alpine:init", () => {
            Alpine.data('mantenimiento', () => ({
                addContactModal: false,
                facturaModal: false,
                params: {
                    id: null,
                    status: '',
                    end_at: '',
                    value: ''
                },
                openModal(type, id) {
                    this.params.id = id;
                    if (type === 'edit') {
                       
                        $.ajax({
                            url: `/mantenimiento/${id}`,
                            type: 'GET',
                            success: (data) => {
                                
                                this.params.status = data.data.status;
                                this.params.end_at = data.data.end_at;
                                this.params.value = data.data.value;
                                this.addContactModal = true;
                            }
                        });

                    }
                    else if (type === 'delete') {
                        // Show the delete modal
                    }
                    else if (type === 'print') {
                        // Show the print modal
                    }
                    else if (type === 'view') {
                        // Show the view modal
                    }
                    else if (type === 'factura') {
                        // Show the view modal
                        
                        this.facturaModal = true;
                    }
                },
                saveMaintenance() {
                    // Save the maintenance data
                    /* fetch(`/mantenimientos/update/${this.params.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.params)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.addContactModal = false;
                            // Optionally, refresh the page or update the table
                        }
                    }); */

                    $.ajax({
                        url: `/mantenimiento/${this.params.id}`,
                        type: 'PATCH',
                        data: this.params,
                        /* csrf */
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        success: (data) => {
                            console.log(data)
                            if (data.ok) {
                                this.addContactModal = false;
                               
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: data.message,
                                    showConfirmButton: true,
                                    
                                }).then(() => {
                                    location.reload();
                                });

                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Error!',
                                    text: data.message,
                                    showConfirmButton: true,
                                    
                                });
                            }
                        },
                        error: (error) => {
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error!',
                                text: 'Ha ocurrido un error al intentar actualizar el mantenimiento',
                                showConfirmButton: true,
                                
                            });
                        }
                    });
                },
                reportPayment() {
                // Report the payment data
                $.ajax({
                    url: `/mantenimiento/reportar-pago/${this.params.id}`,
                    type: 'POST',
                    data: {
                        payment_date: this.params.payment_date,
                        payment_amount: this.params.payment_amount,
                        payment_method: this.params.payment_method,
                        comprobante: this.params.comprobante

                    },
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: (data) => {
                        if (data.ok) {
                            this.facturaModal = false;
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: data.message,
                                showConfirmButton: true,
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error!',
                                text: data.message,
                                showConfirmButton: true,
                            });
                        }
                    },
                    error: (error) => {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Ha ocurrido un error al intentar reportar el pago .' + error,
                            showConfirmButton: true,
                        });
                    }
                });
            }
        }));

            
        });
    </script>

