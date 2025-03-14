<x-layout.default>

    <div x-data="contacts({{ $clientes->toJson() }})" x-init="init()">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="text-xl">Clientes</h2>
            <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                <div class="flex gap-3">
                    <div>
                        <button type="button" class="btn btn-primary" @click="editUser">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
                                <circle cx="10" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M18 17.5C18 19.9853 18 22 10 22C2 22 2 19.9853 2 17.5C2 15.0147 5.58172 13 10 13C14.4183 13 18 15.0147 18 17.5Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            Nuevo Cliente
                        </button>
                        
                        <div class="fixed inset-0 bg-[black]/60 z-[999] overflow-y-auto hidden"
                            :class="addContactModal && '!block'">
                            <div class="flex items-center justify-center  px-4"
                                @click.self="addContactModal = false">
                                <div x-show="addContactModal" x-transition x-transition.duration.300
                                    class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full  w-[90%] my-8">
                                    <button type="button"
                                        class="absolute top-4 ltr:right-4 rtl:left-4 text-white-dark hover:text-dark"
                                        @click="addContactModal = false">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    <h3 class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]"
                                        x-text="params.id ? 'Actualizar Cliente' : 'Agregar Cliente'"></h3>
                                    <div class="p-5">
                                        <form @submit.prevent="saveUser" x-ref="addContactForm"
                                            class="grid grid-cols-1 gap-5">

                                            <div class="mb-5 flex gap-4">
                                                <div class="w-full">
                                                    <label for="name">Nombre <span class="text-red-500">*</span></label>
                                                    <input 
                                                        id="name" 
                                                        name="name" 
                                                        type="text"
                                                        autocomplete="false"
                                                        placeholder="Nombre" 
                                                        class="form-input"
                                                        x-model="params.name" />

                                                </div>

                                                <div class="w-full">
                                                    <label for="role">Apellido <span class="text-red-500">*</span></label>
                                                    <input 
                                                        id="lastname" 
                                                        name="lastname" 
                                                        type="text"
                                                        autocomplete="false"
                                                        placeholder="Apellido" 
                                                        class="form-input"
                                                        x-model="params.lastname" />
                                                </div>
                                            </div>
                                            <div class="mb-5 flex gap-4">
                                                <div class="w-full">

                                                    <label for="email">Email <span class="text-red-500">*</span></label>
                                                    <input id="email" name="email" type="email"
                                                        placeholder="Enter Email" class="form-input"
                                                        x-model="params.email" />
                                                </div>

                                                <div class="w-full">

                                                    <div class="mb-5">
                                                        <label for="document"># Documento <span class="text-red-500">*</span></label>
                                                        <input 
                                                            id="document" 
                                                            type="text" 
                                                            name="document"
                                                            autocomplete="false"
                                                            placeholder="Numero de Documento" 
                                                            class="form-input"
                                                            x-model="params.document" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-5 flex gap-4">
                                                <div class="w-full">
                                                    <label for="codigo_telefono_pais" class="block mb-1 font-medium">
                                                        Código Teléfono <span class="text-red-500">*</span>
                                                    </label>
                                                    <select
                                                        name="codigo_telefono_pais"
                                                        id="codigo_telefono_pais"
                                                        class="form-select block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                        x-model="params.codigo_telefono_pais"
                                                        x-ref="codigo_telefono_pais"
                                                    >
                                                        <option value="">Seleccione</option>
                                                        @foreach ($countries as $country)
                                                            <option  value="{{ $country->dial_code }}"
                                                                >
                                                                {{ $country->name }} ({{ $country->dial_code }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            
                                                <div class="w-full">
                                                    <label for="number" class="block mb-1 font-medium">
                                                        Número de Contacto <span class="text-red-500">*</span>
                                                    </label> 
                                                    <input
                                                        id="number"
                                                        name="phone"
                                                        type="text"
                                                        placeholder="Ingresa el número de contacto"
                                                        class="form-input block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                        x-model="params.phone"
                                                    />
                                                </div>
                                            </div>
                                            
                                            <div class="mb-5 flex gap-4">
                                                <div class="w-full">
                                                    <label for="country">País <span class="text-red-500">*</span></label>
                                                    <select 
                                                        name="country" 
                                                        id="country" 
                                                        class="form-select"
                                                        x-model="params.country"
                                                        x-ref="countrySelect"
                                                        >
                                                        <option value="">Seleccione</option>
                                                        @foreach ($countries as $country)
                                                            
                                                            <option 
                                                                value="{{ $country->id }}"
                                                                >
                                                                {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-full">
                                                    <label for="city">Ciudad <span class="text-red-500">*</span></label>
                                                    <input id="city" name="city" type="text"
                                                        placeholder="Ciudad" class="form-input"
                                                        x-model="params.city" />
                                                </div>
                                                
                                            </div>
                                            <div class="mb-5 flex gap-4">
                                                
                                                
                                                <div class="w-full">
                                                    <label for="Country">Oficio (opcional)</label>
                                                    <input id="occupation" name="occupation" type="text"
                                                        placeholder="Ocupacion u Oficio" class="form-input"
                                                        x-model="params.occupation" />
                                                </div>
                                                <div class="w-full">
                                                    {{-- <label for="Country">Oficio (opcional)</label>
                                                    <input id="occupation" name="occupation" type="text"
                                                        placeholder="Ocupacion u Oficio" class="form-input"
                                                        x-model="params.occupation" /> --}}
                                                </div>
                                            </div>
                                            <div class="mb-5">
                                                <label for="address">Dirección <span class="text-red-500">*</span></label>
                                                <textarea id="address" rows="3" name="address" placeholder="Ingresa la direccion"
                                                    class="form-textarea resize-none min-h-[130px]" x-model="params.location"></textarea>
                                            </div>
                                            <div class="flex justify-end items-center mt-8">
                                                <button type="button" class="btn btn-outline-danger"
                                                    @click="addContactModal = false">Cancelar</button>
                                                <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4"
                                                    x-text="params.id ? 'Actualizar' : 'Agregar'"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="relative ">
                    <input type="text" placeholder="Buscar Cliente"
                        class="form-input py-2 ltr:pr-11 rtl:pl-11 peer" x-model="searchUser"
                        @keyup="searchContacts" />
                    <div
                        class="absolute ltr:right-[11px] rtl:left-[11px] top-1/2 -translate-y-1/2 peer-focus:text-primary">

                        <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                opacity="0.5"></circle>
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 panel p-0 border-0 overflow-hidden">
            <template x-if="displayType === 'list'">
                <div class="table-responsive">
                    <table class="table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Dirección</th>
                                <th>Número de contacto</th>
                                <th class="!text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="contact in filterdContactsList" :key="contact.id">
                                <tr>
                                    <td>
                                        <div class="flex items-center w-max">
                                            <div x-show="contact.path" class="w-max">
                                                <img :src="`/assets/images/${contact.path}`"
                                                    class="h-8 w-8 rounded-full object-cover ltr:mr-2 rtl:ml-2"
                                                    alt="avatar" />
                                            </div>
                                            <div x-show="!contact.path && contact.name"
                                                class="grid place-content-center h-8 w-8 ltr:mr-2 rtl:ml-2 rounded-full bg-primary text-white text-sm font-semibold"
                                                x-text="contact.name.charAt(0) + '' + contact.name.charAt(contact.name.indexOf(' ') + 1)">
                                            </div>
                                            <div x-show="!contact.path && !contact.name"
                                                class="border border-gray-300 dark:border-gray-800 rounded-full p-2 ltr:mr-2 rtl:ml-2">

                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4.5 h-4.5">
                                                    <circle cx="12" cy="6" r="4" stroke="currentColor"
                                                        stroke-width="1.5"></circle>
                                                    <ellipse opacity="0.5" cx="12" cy="17"
                                                        rx="7" ry="4" stroke="currentColor"
                                                        stroke-width="1.5"></ellipse>
                                                </svg>
                                            </div>
                                            <div x-text="contact.name"></div>
                                        </div>
                                    </td>
                                    <td x-text="contact.email"></td>
                                    <td x-text="contact.location" class="whitespace-nowrap"></td>
                                    <td x-text="contact.phone" class="whitespace-nowrap"></td>
                                    <td>
                                        <div class="flex gap-4 items-center justify-center">
                                            <button type="button" class="btn btn-sm btn-outline-info"
                                                @click="showUser(contact)"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                @click="editUser(contact)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                @click="deleteUser(contact)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>
        
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            
            
            Alpine.data("contacts", (clientes) => ({
                
                defaultParams: {
                    id: null,
                    name: '',
                    email: '',
                    role: '',
                    phone: '',
                    document: '',
                    country: '',
                    location: '',
                    lastname: '',
                    occupation: '',
                    city: '',
                },
                displayType: 'list',
                addContactModal: false,
                params: {
                    id: null,
                    name: '',
                    email: '',
                    role: '',
                    phone: '',
                    document: '',
                    country: '',
                    location: '',
                    lastname: '',
                    occupation: '',
                    city: '',
                },
                filterdContactsList: [],
                searchUser: '',
                contactList: clientes.map(cliente => ({
                    id: cliente.id,
                    name: cliente.name,
                    email: cliente.email,
                    location: cliente.address,
                    phone: cliente.phone,
                    document: cliente.document,
                    country: cliente.country,
                    city: cliente.city,
                    occupation: cliente.occupation,
                    lastname: cliente.lastname,
                   
                })),

                init() {
                    this.searchContacts();
                    this.$nextTick(() => {
                        $(this.$refs.countrySelect).select2(
                            {
                                width: '100%',
                                dropdownAutoWidth: true,
                            }
                        )
                            .on('change', (e) => {
                                this.params.country = e.target.value;

                            });
                    });

                    this.$nextTick(() => {
                        $(this.$refs.codigo_telefono_pais).select2(
                            {
                                width: '100%',
                                dropdownAutoWidth: true,
                            }
                        )
                            .on('change', (e) => {
                                this.params.codigo_telefono_pais = e.target.value;
                            });
                    });
                },

                searchContacts() {
                    this.filterdContactsList = this.contactList.filter((d) => d.name.toLowerCase()
                        .includes(this.searchUser.toLowerCase()));
                },

                editUser(user) {
                    this.params = this.defaultParams;
                    if (user) {
                        this.params = JSON.parse(JSON.stringify(user));
                    }

                    this.addContactModal = true;
                },

                showUser(user){
                    /* redirect to show */
                    window.location.href = "{{url('clientes')}}"+"/"+user.id;
                },

                saveUser() {
                    
                    if (!this.params.name) {
                        this.showMessage('Nombre es requerido.', 'error');
                        return true;
                    }
                    if (!this.params.email) {
                        this.showMessage('Email ies requerido.', 'error');
                        return true;
                    }
                    if (!this.params.phone) {
                        this.showMessage('Télefono es requerido', 'error');
                        return true;
                    }
                 
                    if(!this.params.document){
                        this.showMessage('Documento es requerido.', 'error');
                        return true;
                    }
                    if(!this.params.location){
                        this.showMessage('Direccón es requeridoa.', 'error');
                        return true;
                    }
                    if(!this.params.city){
                        this.showMessage('Ciudad es requerida.', 'error');
                        return true;
                    }
                    
                    if(!this.params.lastname){
                        this.showMessage('Apellido es requerido.', 'error');
                        return true;
                    }

                    if(!this.params.country){
                        this.showMessage('País es requerido.', 'error');
                        return true;
                    }

                    if (this.params.id) {

                        $.ajax({
                            url: "{{ url('clientes/') }}" + "/" + this.params.id,
                            type: "POST",
                            data: {
                                id: this.params.id,
                                name: this.params.name,
                                email: this.params.email,
                                phone: this.params.phone,
                                address: this.params.location,
                                country: this.params.country,
                                document: this.params.document,
                                codigo_telefono_pais: document.getElementById('codigo_telefono_pais').value,
                                _token: "{{ csrf_token() }}",
                                _method: "PUT"
                            },
                            success: (response) => {
                               
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Exito!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 3000,
                                        showConfirmButton: true,
                                    }).then(() => {
                                        /* show cliente */
                                        window.location.href = "{{url('clientes')}}"+"/"+this.params.id;
                                    });
                                    
                                } else {
                                    this.showMessage(response.message, 'error');
                                }
                            },
                            error: (error) => {
                                this.showMessage(response.message, 'error');
                            }
                        });
                      

                    } else {
                        //add user



                        $.ajax({
                            url: "{{ route('clientes.store') }}",
                            type: "POST",
                            data: {
                                name: this.params.name,
                                email: this.params.email,
                                phone: this.params.phone,
                                address: this.params.location,
                                country: this.params.country,
                                document: this.params.document,
                                lastname: this.params.lastname,
                                occupation: this.params.occupation,
                                city: this.params.city,
                                codigo_telefono_pais: document.getElementById('codigo_telefono_pais').value,
                                
                                _token: "{{ csrf_token() }}"
                            },
                            success: (response) => {
                               
                                if (response.ok) {
                                   
                                    
                                   Swal.fire({
                                        title: 'Success!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 3000,
                                        showConfirmButton: true,
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    this.showMessage(response.message, 'error');
                                }
                            },
                            error: (error) => {
                                this.showMessage(response.message, 'error');
                            }
                        });

                    }

                    //this.showMessage('User has been saved successfully.');
                    this.addContactModal = false;
                },

                deleteUser(user) {
                    
                    Swal.fire({
                        title: 'Estas seguro?',
                        text: "No podras revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ url('clientes/') }}" + "/" + user.id,
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    _method: "DELETE"
                                },
                                success: (response) => {
                                    if (response.ok) {
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: 'Your file has been deleted.',
                                            icon: 'success',
                                            timer: 3000,
                                            showConfirmButton: true,
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    } else {
                                        this.showMessage(response.message, 'error');
                                    }
                                },
                                error: (error) => {
                                    this.showMessage(response.message, 'error');
                                }
                            });
                        }
                    })

                    
                },

                setDisplayType(type) {
                    this.displayType = type;
                },

                showMessage(msg = '', type = 'success') {
                    const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    toast.fire({
                        icon: type,
                        title: msg,
                        padding: '10px 20px',
                    });
                },
            }));
        });
    </script>
</x-layout.default>
