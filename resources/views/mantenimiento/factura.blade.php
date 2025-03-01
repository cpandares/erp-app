<x-layout.default>
    <div x-data="invoicePreview">
        <div class="flex items-center lg:justify-end justify-center flex-wrap gap-4 mb-6">
            <button type="button" class="btn btn-info gap-2" @click="sendInvoice({{ $mantenimiento->id }})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                    <path d="M17.4975 18.4851L20.6281 9.09373C21.8764 5.34874 22.5006 3.47624 21.5122 2.48782C20.5237 1.49939 18.6511 2.12356 14.906 3.37189L5.57477 6.48218C3.49295 7.1761 2.45203 7.52305 2.13608 8.28637C2.06182 8.46577 2.01692 8.65596 2.00311 8.84963C1.94433 9.67365 2.72018 10.4495 4.27188 12.0011L4.55451 12.2837C4.80921 12.5384 4.93655 12.6658 5.03282 12.8075C5.22269 13.0871 5.33046 13.4143 5.34393 13.7519C5.35076 13.9232 5.32403 14.1013 5.27057 14.4574C5.07488 15.7612 4.97703 16.4131 5.0923 16.9147C5.32205 17.9146 6.09599 18.6995 7.09257 18.9433C7.59255 19.0656 8.24576 18.977 9.5522 18.7997L9.62363 18.79C9.99191 18.74 10.1761 18.715 10.3529 18.7257C10.6738 18.745 10.9838 18.8496 11.251 19.0285C11.3981 19.1271 11.5295 19.2585 11.7923 19.5213L12.0436 19.7725C13.5539 21.2828 14.309 22.0379 15.1101 21.9985C15.3309 21.9877 15.5479 21.9365 15.7503 21.8474C16.4844 21.5244 16.8221 20.5113 17.4975 18.4851Z" stroke="currentColor" stroke-width="1.5" />
                    <path opacity="0.5" d="M6 18L21 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                Enviar Factura
            </button>

            <a href="{{ url('download-factura/' . $mantenimiento->id) }}" target="_blank" class="btn btn-success gap-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                    <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Descargar PDF
            </a>
        </div>
        <div class="panel">
            <div class="flex justify-between flex-wrap gap-4 px-4">
                <div class="text-2xl font-semibold uppercase">Factura</div>
                <div class="shrink-0">
                    <img src="/assets/images/logo.svg" alt="image" class="w-14 ltr:ml-auto rtl:mr-auto" />
                </div>
            </div>
            <div class="ltr:text-right rtl:text-left px-4">
                <div class="space-y-1 mt-6 text-white-dark">
                    <div>13 Tetrick Road, Cypress Gardens, Florida, 33884, US</div>
                    <div>email@prueba.com</div>
                    <div>+1 (070) 123-4567</div>
                </div>
            </div>

            <hr class="border-[#e0e6ed] dark:border-[#1b2e4b] my-6">
            <div class="flex justify-between lg:flex-row flex-col gap-6 flex-wrap">
                <div class="flex-1">
                    <div class="space-y-1 text-white-dark">
                        <span>Nombre Cliente:</span>
                        <div class="text-black dark:text-white font-semibold">
                            {{ $mantenimiento->cliente->name }}
                        </div>
                        <div>
                            <span>Dirección:</span>
                            {{ $mantenimiento->cliente->address }}
                        </div>
                        <div>
                            <span>Email:</span>
                            {{ $mantenimiento->cliente->email }}
                        </div>
                        <div>
                            <span>Teléfono:</span>
                            {{ $mantenimiento->cliente->phone }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-between sm:flex-row flex-col gap-6 lg:w-2/3">
                    <div class="xl:1/3 lg:w-2/5 sm:w-1/2">
                        <div class="flex items-center w-full justify-between mb-2">
                            <div class="text-white-dark"># Factura :</div>
                            <div>#{{ $factura->numero_factura }}</div>
                        </div>
                        <div class="flex items-center w-full justify-between mb-2">
                            <div class="text-white-dark">Fecha de ingreso :</div>
                            <div>{{ $mantenimiento->start_at }}</div>
                        </div>
                       {{--  <div class="flex items-center w-full justify-between mb-2">
                            <div class="text-white-dark">Order ID :</div>
                            <div>#OD-85794</div>
                        </div>
                        <div class="flex items-center w-full justify-between">
                            <div class="text-white-dark">Shipment ID :</div>
                            <div>#SHP-8594</div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-6">
                <table class="table-striped">
                    <thead>
                        <tr>
                            <th>
                                <div class="text-white *:text-center">ID</div>
                            </th>
                            <th>
                                <span class="text-white *:text-center">
                                    Servicio
                                </span>
                            </th>
                            <th>
                                <span class="text-white *:text-center">
                                    Cantidad
                                </span>
                            </th>
                            <th>
                                <span class="text-white *:text-center
                                    ltr:text-right rtl:text-left">
                                    Precio Unitario
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mantenimiento->servicios as $servicio)
                        <tr>
                            <td>
                                <div class="text-white
                                    *:text-center">{{ $servicio->id }}</div>
                            </td>
                            <td>
                                <span class="text-white
                                    *:text-center">{{ $servicio->name }}</span>
                            </td>
                            <td>
                                <span class="text-white
                                    *:text-center">1</span>
                            </td>
                            <td>
                                <span class="text-white
                                    ltr:text-right rtl:text-left">{{ $servicio->price }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="grid sm:grid-cols-2 grid-cols-1 px-4 mt-6">
                <div></div>
                <div class="ltr:text-right rtl:text-left space-y-2">
                    <div class="flex items-center">
                        <div class="flex-1">Subtotal</div>
                        <div class="w-[37%]">${{ $mantenimiento->servicios->sum('price') }}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-1">Inpuesto ( {{ env('APP_IVA') * 100 }} % )</div>
                        <div class="w-[37%]">
                            @php
                                $iva = env('APP_IVA');
                                echo '$' . number_format($mantenimiento->servicios->sum('price') * $iva / 100, 2);
                            @endphp
                        </div>
                    </div>
                    {{-- <div class="flex items-center">
                        <div class="flex-1">Shipping Rate</div>
                        <div class="w-[37%]">$0</div>
                    </div> --}}
                   {{--  <div class="flex items-center">
                        <div class="flex-1">Discount</div>
                        <div class="w-[37%]">$10</div>
                    </div> --}}
                    <div class="flex items-center font-semibold text-lg">
                        <div class="flex-1">Grand Total</div>
                        <div class="w-[37%]">
                            @php
                                $total = $mantenimiento->servicios->sum('price') + ($mantenimiento->servicios->sum('price') * $iva / 100);
                                echo '$' . number_format($total, 2);
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('invoicePreview', () => ({
              
                sendInvoice(id) {
                    Swal.fire({
                        title: 'Estas seguro?',
                        text: "Estas seguro de enviar la factura por correo?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                      
                    }).then((result) => {
                        if (result.isConfirmed) {
                            /* mostrar loader */

                            Swal.fire({
                                title: 'Enviando',
                                text: 'Enviando factura por correo',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                }
                            })

                            $.ajax({
                                url: '/send-factura-email/' + id,
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                },
                                success: function(response) {

                                    

                                   if(response.ok){
                                    Swal.fire(
                                        'Enviada',
                                        'La factura ha sido enviada con éxito',
                                        'success'
                                    )
                                   }else{
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message,
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                    }
                                    )
                                   }
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Ha ocurrido un error al enviar la factura',
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                    })
                                }
                            });
                        }
                    })
                }
            }));
        });
    </script>
</x-layout.default>