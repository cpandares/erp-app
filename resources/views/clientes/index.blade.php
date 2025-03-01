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
                            <div class="flex items-center justify-center min-h-screen px-4"
                                @click.self="addContactModal = false">
                                <div x-show="addContactModal" x-transition x-transition.duration.300
                                    class="panel border-0 p-0 rounded-lg overflow-hidden md:w-full max-w-lg w-[90%] my-8">
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
                                            <div class="mb-5">
                                                <label for="name">Nombre y Apellido</label>
                                                <input id="name" name="name" type="text"
                                                    placeholder="Enter Name" class="form-input" x-model="params.name" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="email">Email</label>
                                                <input id="email" name="email" type="email"
                                                    placeholder="Enter Email" class="form-input"
                                                    x-model="params.email" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="number">Numero de Contacto</label>
                                                <input id="number" name="phone" type="text"
                                                    placeholder="Ingresa el numero de contacto" class="form-input"
                                                    x-model="params.phone" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="document"># Dni</label>
                                                <input id="document" type="text" name="document"
                                                    placeholder="Numero de Documento" class="form-input"
                                                    x-model="params.document" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="Country">País</label>
                                                <input id="country" type="text" name="country" placeholder="Pais"
                                                    class="form-input" x-model="params.country" />
                                            </div>
                                            <div class="mb-5">
                                                <label for="address">Address</label>
                                                <textarea id="address" rows="3" name="address" placeholder="Ingresa la direccion"
                                                    class="form-textarea resize-none min-h-[130px]" x-model="params.location"></textarea>
                                            </div>
                                            <div class="flex justify-end items-center mt-8">
                                                <button type="button" class="btn btn-outline-danger"
                                                    @click="addContactModal = false">Cancel</button>
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
        <template x-if="displayType === 'grid'">
            <div class="grid 2xl:grid-cols-4 xl:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6 w-full">
                <template x-for="contact in filterdContactsList" :key="contact.id">
                    <div class="bg-white dark:bg-[#1c232f] rounded-md overflow-hidden text-center shadow relative">
                        <div
                            class="bg-white/40 rounded-t-md bg-[url('/assets/images/notification-bg.png')] bg-center bg-cover p-6 pb-0">
                            <template x-if="contact.path">
                                <img class="object-contain w-4/5 max-h-40 mx-auto"
                                    :src="`/assets/images/${contact.path}`" />
                            </template>
                        </div>
                        <div class="px-6 pb-24 -mt-10 relative">
                            <div class="shadow-md bg-white dark:bg-gray-900 rounded-md px-2 py-4">
                                <div class="text-xl" x-text="contact.name"></div>
                                <div class="text-white-dark" x-text="contact.role"></div>
                                <div class="flex items-center justify-between flex-wrap mt-6 gap-3">
                                    <div class="flex-auto">
                                        <div class="text-info" x-text="contact.posts"></div>
                                        <div>Posts</div>
                                    </div>
                                    <div class="flex-auto">
                                        <div class="text-info" x-text="contact.following"></div>
                                        <div>Following</div>
                                    </div>
                                    <div class="flex-auto">
                                        <div class="text-info" x-text="contact.followers"></div>
                                        <div>Followers</div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <ul class="flex space-x-4 rtl:space-x-reverse items-center justify-center">
                                        <li>
                                            <a href="javascript:;"
                                                class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <path
                                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                                class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <rect x="2" y="2" width="20" height="20" rx="5"
                                                        ry="5"></rect>
                                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                    <line x1="17.5" y1="6.5" x2="17.51"
                                                        y2="6.5"></line>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                                class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <path
                                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                                    </path>
                                                    <rect x="2" y="9" width="4" height="12"></rect>
                                                    <circle cx="4" cy="4" r="2"></circle>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                                class="btn btn-outline-primary p-0 h-7 w-7 rounded-full">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <path
                                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-4 ltr:text-left rtl:text-right">
                                <div class="flex items-center">
                                    <div class="flex-none ltr:mr-2 rtl:ml-2">Email :</div>
                                    <div class="truncate text-white-dark" x-text="contact.email"></div>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex-none ltr:mr-2 rtl:ml-2">Phone :</div>
                                    <div class="text-white-dark" x-text="contact.phone"></div>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex-none ltr:mr-2 rtl:ml-2">Address :</div>
                                    <div class="text-white-dark" x-text="contact.location"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex gap-4 absolute bottom-0 w-full ltr:left-0 rtl:right-0 p-6">
                            <button type="button" class="btn btn-outline-primary w-1/2"
                                @click="editUser(contact)">Edit</button>
                            <button type="button" class="btn btn-outline-danger w-1/2"
                                @click="deleteUser(contact)">Delete</button>
                        </div>
                    </div>
                </template>
            </div>
        </template>
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
                    location: ''
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
                    location: ''
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
                    posts: 0, // Ajusta según tu lógica
                    followers: '0', // Ajusta según tu lógica
                    following: 0 // Ajusta según tu lógica
                })),

                init() {
                    this.searchContacts();
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
                        this.showMessage('Name is required.', 'error');
                        return true;
                    }
                    if (!this.params.email) {
                        this.showMessage('Email is required.', 'error');
                        return true;
                    }
                    if (!this.params.phone) {
                        this.showMessage('Phone is required.', 'error');
                        return true;
                    }
                    if (!this.params.country) {
                        this.showMessage('Country is required.', 'error');
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
                                _token: "{{ csrf_token() }}",
                                _method: "PUT"
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
                        //update user
                       /*  let user = this.contactList.find((d) => d.id === this.params.id);
                        user.name = this.params.name;
                        user.email = this.params.email;
                        user.country = this.params.country;
                        user.phone = this.params.phone;
                        user.location = this.params.location;
                        user.document = this.params.document; */

                    


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
                                _token: "{{ csrf_token() }}"
                            },
                            success: (response) => {
                                console.log(response);
                                if (response.ok) {
                                    /* call toast */
                                    console.log(response.errors);
                                    
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
