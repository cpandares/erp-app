<x-layout.default>
    <script src="/assets/js/simple-datatables.js"></script>
    <div class="flex justify-end mt-4">
        <a href="{{ route('coches.create') }}" class="btn btn-primary">Nuevo Coche</a>
    </div>

    <div x-data="cochesData({{ $coches->toJson() }})">
        <div class="panel mt-6 no-number-pagination next-prev-pagination">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Coches</h5>
            <table id="myTable4" class="whitespace-nowrap">
                
            </table>
        </div>

        <!-- Modal para editar coche -->
        <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto hidden"
            :class="editCocheModal && '!block'">
            <div class="flex items-center justify-center min-h-screen px-4"
                @click.self="editCocheModal = false">
                <div x-show="editCocheModal" x-transition x-transition.duration.300
                    class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full max-w-lg w-[90%] my-8">
                    <button type="button"
                        class="absolute top-4 ltr:right-4 rtl:left-4 text-white-dark hover:text-dark"
                        @click="editCocheModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>

                    <h3 class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]"
                        x-text="cocheParams.id ? 'Actualizar Coche' : 'Agregar Coche'">
                    </h3>

                    <div class="p-5">
                        <form @submit.prevent="saveCoche" x-ref="editCocheForm" class="grid grid-cols-1 gap-5">
                            <!-- Marca -->
                            <div class="mb-5">
                                <label for="marca">Marca</label>
                                <input id="marca" name="marca" type="text" class="form-input"
                                    placeholder="Ej. Toyota" x-model="cocheParams.marca" />
                            </div>

                            <!-- Placa -->
                            <div class="mb-5">
                                <label for="placa">Placa</label>
                                <input id="placa" name="placa" type="text" class="form-input"
                                    placeholder="Ej. ABC-123" x-model="cocheParams.placa" />
                            </div>

                            <!-- Color -->
                            <div class="mb-5">
                                <label for="color">Color</label>
                                <input id="color" name="color" type="text" class="form-input"
                                    placeholder="Ej. Rojo" x-model="cocheParams.color" />
                            </div>

                            <!-- Año -->
                            <div class="mb-5">
                                <label for="year">Año</label>
                                <input id="year" name="year" type="number" class="form-input"
                                    placeholder="Ej. 2021" x-model="cocheParams.year" />
                            </div>

                            <div class="flex justify-end items-center mt-8">
                                <button type="button" class="btn btn-outline-danger"
                                    @click="editCocheModal = false">Cancelar</button>
                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                    x-text="cocheParams.id ? 'Actualizar' : 'Agregar'"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("cochesData", (coches) => ({
                coches: coches,
                editCocheModal: false,
                cocheParams: {
                    id: '',
                    images: '',
                    marca: '',
                    placa: '',
                    color: '',
                    year: '',

                },
                init() {
                    const tableData = this.coches.map((coche, index) => [                        
                        index + 1,
                        coche.images.length ? `<img src="{{ asset('/') }}${coche.images[0].path}" class="object-cover  w-20 h-20">` : 'N/A',
                        coche.cliente ? coche.cliente.name : 'N/A', // Asegúrate de que la relación 'cliente' esté cargada
                        coche.marca, // Enlace a la pantalla de detalle del coche
                        coche.placa,
                        coche.color,
                        coche.year,
                        ` 
                        <div class="flex gap-4 items-center justify-center">
                        <a href="{{ url('coches/${coche.id}') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-edit-id=="editCoche(${coche.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" data-delete-id="${coche.id}">
                            <i class="fas fa-trash"></i>
                        </button> </div>`
                        
                    ]);

                    const tableOptions = {
                        data: {
                            headings: ["#","Imagen", "Cliente", "Marca", "Placa", "Color", "Año", "Acciones"],
                            data: tableData
                        },
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{ select: 0, sort: "asc" }],
                        labels: { perPage: "{select}" },
                        layout: {
                            top: "{search}",
                            bottom: "<div class='flex items-center gap-4'>{info}{select}</div>{pager}",
                        },
                    };

                    const datatable4 = new simpleDatatables.DataTable('#myTable4', {
                        ...tableOptions,
                        prevText: 'Previous',
                        nextText: 'Next',
                    });

                    this.$nextTick(() => {
                        document.querySelectorAll('[data-delete-id]').forEach(btn => {
                            btn.addEventListener('click', (e) => {
                                const id = e.target.getAttribute('data-delete-id');
                                this.deleteCoche(id);
                            });
                        });
                    });

                    this.$nextTick(() => {
                        document.querySelectorAll('[data-edit-id]').forEach(btn => {
                            btn.addEventListener('click', (e) => {
                                const id = e.target.getAttribute('data-edit-id');
                                this.editCoche(id);
                            });
                        });
                    });
                },
                
                editCoche(id) {
                    const coche = this.coches.find(coche => coche.id === id);
                    this.cocheParams = { ...coche };
                    this.editCocheModal = true;
                },
                saveCoche() {
                    fetch(`/coches/${this.cocheParams.id}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.cocheParams)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.ok) {
                            Swal.fire('Actualizado!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', error, 'error');
                    });
                },
                deleteCoche(id) {
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
                            fetch(`/coches/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.ok) {
                                    Swal.fire('Eliminado!', data.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Error!', data.message, 'error').then(() => {
                                        
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!', error, 'error').then(() => {
                                    
                                });
                            });
                        }
                    });
                }
            }));
        });
    </script>
</x-layout.default>