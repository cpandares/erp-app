<x-layout.default>
    <div x-data="empleados" class="panel lg:col-span-2 xl:col-span-3">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Empleados</h5>
        </div>
        <div class="mb-5">
            {{-- button for modal to add servicios --}}
            <button 
                class="btn btn-primary mb-2" 
                @click="openModal()"
                x-transition x-transition.duration.300ms
            >Agregar Empleado</button>
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
                            <label for="nombre" class="block text-sm font-semibold dark:text-white-light">Apellido</label>
                            <input type="text" name="lastname" id="lastname" class="form-input" x-model="formData.lastname" required>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="block text-sm font-semibold dark:text-white-light">Email</label>
                            <input type="email" name="email" id="email" class="form-input" x-model="formData.email" required>
                        </div>
                        <div class="mb-5">
                            <label for="phone" class="block text-sm font-semibold dark:text-white-light">Email</label>
                            <input type="text" name="phone" id="phone" class="form-input" x-model="formData.phone" required>
                        </div>
                        <div class="mb-5">
                            <label for="age" class="block text-sm font-semibold dark:text-white-light">Edad</label>
                            <input type="number" name="age" id="age" class="form-input" x-model="formData.age" required>
                        </div>
                        <div class="mb-5">
                            <label for="start_at" class="block text-sm font-semibold dark:text-white-light">Inicio en:</label>
                            <input type="date" name="start_at" id="start_at" class="form-input" x-model="formData.start_at" required>
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
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Número de contacto</th>
                            <th>Edad</th>
                            <th>Fecha de Inicio</th>
                            <th>
                                Estado
                            </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dark:text-white-dark">
                        @foreach ($empleados as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->lastname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->age }}</td>
                            <td>
                                {{ $item->start_at }}
                            </td>
                            <td>
                                @if ($item->status == 0)
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
            Alpine.data('empleados', () => ({
                modalOpen: false,
                modalTitle: 'Agregar Empleado',
                formData: {
                    id: null,
                    name: '',
                    description: '',
                    price: ''
                },
                openModal() {
                    this.modalTitle = 'Agregar Empleado';
                    this.formData = {
                        id: null,
                        name: '',
                        lastname: '',
                        email: '',
                        phone: '',
                        age: '',
                        start_at: ''
                    };
                    this.modalOpen = true;
                },
                closeModal() {
                    this.modalOpen = false;
                },
                editService(empleado) {
                    this.modalTitle = 'Editar Empleado';
                    this.formData = { ...empleado };
                    this.modalOpen = true;
                },
                submitForm() {
                    let url = this.formData.id ? `/empleados/${this.formData.id}` : "{{ route('empleados.store') }}";
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
                                    title: 'Guardado',
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
                        url: `/empleados/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if(res.ok){
                                Swal.fire({
                                    title: 'Empleado eliminado',
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