<x-layout.default>
    <div x-data="servicios" class="panel lg:col-span-2 xl:col-span-3">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Servicios</h5>
        </div>
        <div class="mb-5">
            {{-- button for modal to add servicios --}}
            <button 
                class="btn btn-primary mb-2" 
                @click="openModal()"
                x-transition x-transition.duration.300ms
            >Agregar Servicio</button>
            {{-- end button for modal to add servicios --}}
            
            {{-- modal to add/edit servicios --}}
            <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-xl font-semibold mb-4" x-text="modalTitle"></h2>
                    <form id="formService" @submit.prevent="submitForm">
                        @csrf
                        <div class="mb-5">
                            <label for="nombre" class="block text-sm font-semibold dark:text-white-light">Nombre</label>
                            <input type="text" name="name" id="nombre" class="form-input" x-model="formData.name" required>
                        </div>
                        <div class="mb-5">
                            <label for="descripcion" class="block text-sm font-semibold dark:text-white-light">Descripción</label>
                            <textarea name="description" id="description" class="form-input" x-model="formData.description" required></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="valor" class="block text-sm font-semibold dark:text-white-light">Valor</label>
                            <input type="number" name="price" id="valor" class="form-input" x-model="formData.price" required>
                        </div>
                        <div class="mb-5 flex justify-end">
                            <button type="button" class="btn btn-secondary mr-2" @click="closeModal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- end modal to add/edit servicios --}}
            
            <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                <table class="whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Valor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dark:text-white-dark">
                        @foreach ($servicios as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->price }}</td>

                            <td>
                                @if ($item->active == 0)
                                <span class="text-red-500">Inactivo</span>
                                @else
                                <span class="text-green-500">Activo</span>
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" @click="editService({{ $item }})" class="text-blue-500">Editar</a>
                                
                                <button 
                                    onclick="deleteService({{ $item->id }})"
                                    class="text-red-500">
                                    Eliminar
                                </button>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('servicios', () => ({
                modalOpen: false,
                modalTitle: 'Agregar Servicio',
                formData: {
                    id: null,
                    name: '',
                    description: '',
                    price: ''
                },
                openModal() {
                    this.modalTitle = 'Agregar Servicio';
                    this.formData = { id: null, name: '', description: '', price: '' };
                    this.modalOpen = true;
                },
                closeModal() {
                    this.modalOpen = false;
                },
                editService(service) {
                    this.modalTitle = 'Editar Servicio';
                    this.formData = { ...service };
                    this.modalOpen = true;
                },
                submitForm() {
                    let url = this.formData.id ? `/servicios/${this.formData.id}` : "{{ route('servicios.store') }}";
                    let method = this.formData.id ? 'PUT' : 'POST';
                    $.ajax({
                        url: url,
                        type: method,
                        data: this.formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (res) => {
                            if(res.ok){
                                Swal.fire({
                                    title: 'Servicio guardado',
                                    text: res.message,
                                    icon: 'success',
                                    confirmButtonText: 'Aceptar'
                                }).then(() => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: res.message,
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                })
                            }
                        },
                        error: (error) => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ha ocurrido un error',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            })
                        }
                    });
                }
            }));
        });

        deleteService = (id) => {
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
                        url: `/servicios/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if(res.ok){
                                Swal.fire({
                                    title: 'Servicio eliminado',
                                    text: res.message,
                                    icon: 'success',
                                    confirmButtonText: 'Aceptar'
                                }).then(() => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: res.message,
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                })
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ha ocurrido un error',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            })
                        }
                    });
                }
            })
        }
    </script>
</x-layout.default>