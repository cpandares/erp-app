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

    <div x-data="mantenimiento({{ $mantenimiento->id }})">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Coches</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>info</span>
            </li>
        </ul>
        
        <div class="panel gap-10 lg:flex" >
            <div class="mx-auto sm:w-1/2 lg:w-1/3">
                <div class="sticky top-20 z-[1]">
                    <div class="relative">
                        @if (count($mantenimiento->coche->images) > 0)
                        <img src="{{ asset($mantenimiento->coche->images->first()->path) }}" alt="" class="h-auto w-full rounded">
                        @else
                        <img src="assets/images/product/product-7.jpg" alt="" class="h-auto w-full rounded">
                        @endif
                        
                        {{-- <a href="javascript:;" class="swiper-button-prev-ex1 swiper-button-disabled absolute top-1/2 grid -translate-y-1/2 place-content-center rounded-full border border-primary p-1 text-primary transition hover:border-primary hover:bg-primary hover:text-white ltr:left-2 rtl:right-2" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-10d386118d4e4d5fd" aria-disabled="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left h-5 w-5 rtl:rotate-180">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </a>

                        <a href="javascript:;" class="swiper-button-next-ex1 absolute top-1/2 grid -translate-y-1/2 place-content-center rounded-full border border-primary p-1 text-primary transition hover:border-primary hover:bg-primary hover:text-white ltr:right-2 rtl:left-2" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-10d386118d4e4d5fd" aria-disabled="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right h-5 w-5 rtl:rotate-180">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a> --}}
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-4">
                        @if (count($mantenimiento->coche->images) > 1)
                            @foreach ($mantenimiento->coche->images as $image)
                                <img src="{{ asset($image->path)  }}" alt="" class="h-auto w-full rounded">
                            @endforeach
                       
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-10 lg:mt-0 lg:w-2/3">
                <h2 class="mb-3 text-lg font-bold text-dark dark:text-white md:text-xl">Cliente:  {{ $mantenimiento->cliente->name }}</h2>
                <div class="flex flex-wrap gap-4">
                    <div class="">
                        Coche : <b>{{ $mantenimiento->coche->marca }} {{ $mantenimiento->coche->model }}</b>
                    </div>
                    <div>|</div>
                    <div class="">Placa : <b>{{ $mantenimiento->coche->placa }}</b></div>
                    <div>|</div>
                    <div class="">Color : <b>{{ $mantenimiento->coche->color }}</b></div>
                </div>
                {{-- <div class="mt-6 flex gap-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" fill="#ffc107" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" fill="#ffc107" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" fill="#ffc107" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffc107" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" fill="#ffc107" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#E0E6ED" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" fill="#E0E6ED" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"></path>
                    </svg>
                    <div class="ltr:ml-2 rtl:mr-2">( <strong>5.50k</strong> Customer Review )</div>
                </div> --}}
                <div class="my-4">
                    <div class="mb-1 font-bold text-success">Valor</div>
                    <span class="text-xl"><b>
                        @php
                        $total = 0;
                        foreach ($mantenimiento->servicios as $item) {
                            $total += $item->price;
                        }
                        echo $total;
                    @endphp    
                    </b></span>
                </div>
            
                <div class="mt-8">
                    <h5 class="mb-3 font-bold">Descripción :</h5>
                    <p>
                        {{ $mantenimiento->description }}
                    </p>
                </div>
                <div class="mt-8 grid gap-5 md:grid-cols-2">
                    <div>
                    {{--  <h5 class="mb-3 font-bold">Features :</h5>
                        <ul class="list-inside list-disc space-y-2">
                            <li>Full Sleeve</li>
                            <li>Cotton</li>
                            <li>All Sizes available</li>
                            <li>4 Different Color</li>
                        </ul> --}}
                    </div>
                    <div>
                        <h5 class="mb-3 font-bold">Servicios :</h5>
                        <ul class="list-inside list-disc space-y-2">
                            @foreach ($mantenimiento->servicios as $item)
                                <li>{{ $item->name }} - {{ $item->price }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="flex gap-2">
                        <h5 class="mb-3 font-bold">Estado :</h5>
                        <button class="px-2 py-1 bg-success text-white"> {{ $mantenimiento->status }} </button>
                        <button @click="openModal('edit', {{ $mantenimiento->id }})" class="btn btn-primary">Actualizar</button>
                        <button @click="openModal('factura', {{ $mantenimiento->id }})" class="btn btn-primary">Reportar Pago</button>
                    </div>
                    {{-- actualizar --}}
                    <div class="mt-4">
                    </div>
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
                                    <option value="Finalizado">Finalizado</option>
                                    <option value="Repoceso">Repoceso</option>
                                </select>
                            </div>
                            <div class="mb-5" x-show="params.status === 'Finalizado'">
                                <label for="end_at">Fecha y hora de Finalización</label>
                                {{-- <input id="end_at" name="end_at" type="date" class="form-input" x-model="params.end_at" /> --}}
                                <input type="datetime-local" name="end_at" id="end_at" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" x-model="params.end_at">
                            </div>
                            <div class="mb-5" x-show="params.status === 'Finalizado'">
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

</x-layout.default>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data('mantenimiento', () => ({
            addContactModal: false,
            facturaModal: false,
            params: {
                id: null,
                status: '',
                end_at: '',
                value: '',
                payment_date: '',
                payment_amount: '',
                payment_method: '',
                comprobante: ''
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
                } else if (type === 'factura') {
                    this.facturaModal = true;
                }
            },
            saveMaintenance() {
                $.ajax({
                    url: `/mantenimiento/${this.params.id}`,
                    type: 'PATCH',
                    data: this.params,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: (data) => {
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
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Ha ocurrido un error al intentar reportar el pago.',
                            showConfirmButton: true,
                        });
                    }
                });
            }
        }));
    });
</script>

