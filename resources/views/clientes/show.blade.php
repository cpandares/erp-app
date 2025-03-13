<x-layout.default>

    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Cliente</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Información del Cliente</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Configuración</h5>
                <div class="mb-5">
                         
                    <div x-data="{ openCreateCoche: false }">

                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary" @click="openCreateCoche = true">
                            <i class="fas fa-plus"></i>
                            Crear Coche
                        </button>

                        <!-- Modal para creación de coche -->
                        <div
                            class="fixed inset-0 bg-[black]/60 z-50 overflow-y-auto flex items-center justify-center p-4"
                            x-show="openCreateCoche"
                            x-transition
                            style="display: none;"
                        >
                            <div class="bg-white dark:bg-[#1b2e4b] w-full max-w-xl rounded-md shadow-lg p-6 relative">
                                <!-- Cerrar modal -->
                                <button
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                                    @click="openCreateCoche = false"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 
                                            8.586l4.293-4.293a1 1 0 011.414 
                                            1.414L11.414 10l4.293 4.293a1 
                                            1 0 01-1.414 1.414L10 11.414 
                                            5.707 15.707a1 1 0 01-1.414-1.414L8.586 
                                            10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>

                                <h2 class="text-lg font-semibold mb-4 dark:text-white">
                                    Crear Nuevo Coche
                                </h2>

                                <form
                                    class="grid grid-cols-1 gap-6"
                                    id="cocheFormAdd"
                                    enctype="multipart/form-data"
                                >
                                    @csrf

                                    <!-- Cliente oculto -->
                                    <input id="cliente_id" type="hidden" name="cliente_id" value="{{ $cliente->id }}" />

                                    <div>
                                        <label for="marca" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            Marca
                                        </label>
                                        <input
                                            type="text"
                                            name="marca"
                                            id="marca"
                                            class="form-input mt-1 block w-full"
                                        />
                                    </div>

                                    <div>
                                        <label for="model" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            Modelo
                                        </label>
                                        <input
                                            type="text"
                                            name="model"
                                            id="model"
                                            class="form-input mt-1 block w-full"
                                        />
                                    </div>

                                    <div>
                                        <label for="placa" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            Placa
                                        </label>
                                        <input
                                            type="text"
                                            name="placa"
                                            id="placa"
                                            class="form-input mt-1 block w-full"
                                        />
                                    </div>

                                    <div>
                                        <label for="color" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            Color
                                        </label>
                                        <input
                                            type="text"
                                            name="color"
                                            id="color"
                                            class="form-input mt-1 block w-full"
                                        />
                                    </div>

                                    <div>
                                        <label for="year" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            Año
                                        </label>
                                        <input
                                            type="text"
                                            name="year"
                                            id="year"
                                            class="form-input mt-1 block w-full"
                                        />
                                    </div>

                                    <div>
                                        <label for="images" class="block text-sm font-medium text-gray-700 dark:text-white">
                                            Imagen
                                        </label>
                                        <input
                                            type="file"
                                            name="images[]"
                                            id="images"
                                            multiple
                                            class="form-input mt-1 block w-full"
                                        />
                                    </div>

                                    <div class="flex justify-end">
                                        <button
                                            type="submit"
                                            class="btn btn-primary mr-2"
                                        >
                                            Guardar
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            @click="openCreateCoche = false"
                                        >
                                            Cerrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div x-data="{ tab: 'home' }">
                <ul
                    class="sm:flex font-semibold border-b border-[#ebedf2] dark:border-[#191e3a] mb-5 whitespace-nowrap overflow-y-auto">
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'home' }" @click="tab='home'">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <path opacity="0.5"
                                    d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            Información del Cliente
                        </a>
                    </li>
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'payment-details' }"
                            @click="tab='payment-details'">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <circle opacity="0.5" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M12 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            Coches
                        </a>
                    </li>
                   
                 
                </ul>
                <template x-if="tab === 'home'">
                    <div>
                        <form
                            class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
                            <h6 class="text-lg font-bold mb-5">Información Generarl</h6>
                            <div class="flex flex-col sm:flex-row">
                                <div class="ltr:sm:mr-4 rtl:sm:ml-4 w-full sm:w-2/12 mb-5">
                                    <img src="/assets/images/profile-34.jpeg" alt="image"
                                        class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto" />
                                </div>
                                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label for="name">Nombre</label>
                                        <input 
                                            id="name" 
                                            type="text" 
                                            placeholder="Jimmy Turner"
                                            value="{{ $cliente->name }}"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label for="profession">Profesión</label>
                                        <input id="profession" type="text" placeholder="Web Developer"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label for="country">País</label>
                                        <select id="country" class="form-select text-white-dark">
                                            <option selected ="{{$cliente->country}}">{{$cliente->country}}</option>
                                            <option>All Countries</option>
                                            <option>United States</option>
                                            <option>India</option>
                                            <option>Japan</option>
                                            <option>China</option>
                                            <option>Brazil</option>
                                            <option>Norway</option>
                                            <option>Canada</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="address">Dirección</label>
                                        <input 
                                            id="address" 
                                            type="text" 
                                            placeholder="New York"
                                            value="{{ $cliente->address }}"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label for="location">Ciudad</label>
                                        <input id="location" type="text" placeholder="Ciudad"
                                            value="{{ $cliente->city }}"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label for="phone">Phone</label>
                                        <input 
                                            id="phone" 
                                            type="text" 
                                            placeholder="+1 (530) 555-12121"
                                            value="{{ $cliente->phone }}"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input 
                                            id="email" 
                                            type="email" 
                                            placeholder="Jimmy@gmail.com"
                                            value="{{ $cliente->email }}"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label for="web">Website</label>
                                        <input id="web" type="text" placeholder="Enter URL"
                                            class="form-input" />
                                    </div>
                                    <div>
                                        <label class="inline-flex cursor-pointer">
                                            <input type="checkbox" class="form-checkbox" />
                                            <span class="text-white-dark relative checked:bg-none">Make this my default
                                                address</span>
                                        </label>
                                    </div>
                                    <div class="sm:col-span-2 mt-3">
                                        <button type="button" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form
                            class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 bg-white dark:bg-[#0e1726]">
                            <h6 class="text-lg font-bold mb-5">Social</h6>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="flex">
                                    <div
                                        class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-5 h-5">
                                            <path
                                                d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                            </path>
                                            <rect x="2" y="9" width="4" height="12">
                                            </rect>
                                            <circle cx="4" cy="4" r="2"></circle>
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="jimmy_turner" class="form-input" />
                                </div>
                                <div class="flex">
                                    <div
                                        class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-5 h-5">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="jimmy_turner" class="form-input" />
                                </div>
                                <div class="flex">
                                    <div
                                        class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-5 h-5">
                                            <path
                                                d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="jimmy_turner" class="form-input" />
                                </div>
                                <div class="flex">
                                    <div
                                        class="bg-[#eee] flex justify-center items-center rounded px-3 font-semibold dark:bg-[#1b2e4b] ltr:mr-2 rtl:ml-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-5 h-5">
                                            <path
                                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="jimmy_turner" class="form-input" />
                                </div>
                            </div>
                        </form>
                    </div>
                </template>
                
                <template x-if="tab === 'payment-details'" x-init="() => { tab = 'payment-details' }">
                    <div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">

                            {{-- create a coche --}}

                            @if ($cliente->coches->count() > 0)
                            
                            
                               @foreach ($cliente->coches as $coche)
                               <div class="panel">
                                <div class="mb-5">
                                    <h5 class="font-semibold text-lg mb-4">
                                        {{ $coche->marca }} - {{ $coche->model }} - {{ $coche->year }}
                                    </h5>
                                    <p>Changes to your <span class="text-primary">Billing</span> information will take
                                        effect starting with scheduled payment and will be refelected on your next
                                        invoice.</p>
                                </div>
                                <div class="mb-5">
                                    
                                    <div class="flex flex-col items-center">
                                        @if ($coche->images->count() > 0)
                                            <img src="{{ asset($coche->images->first()->path) }}" alt="Imagen del coche"
                                                class="object-cover mb-5 w-40 h-40 rounded-full shadow-[0_4px_9px_0_rgba(31,45,61,0.31)]" />
                                        @else
                                            <img src="https://t4.ftcdn.net/jpg/09/33/57/79/360_F_933577966_8wtwxqH3JpEKVopTUkpNbiUB5PKcmwLH.jpg" alt="Imagen por defecto"
                                                class="object-cover mb-5 w-40 h-40 rounded-full shadow-[0_4px_9px_0_rgba(31,45,61,0.31)]" />
                                        @endif
                                        <h5 class="font-semibold text-lg dark:text-white-light">{{ $coche->marca }} - {{ $coche->model }} - {{ $coche->year }}</h5>
                                    </div>
                                
                                    <div class="mt-5">
                                        <div x-data="{ open: false }">
                                            <button @click="open = !open" class="btn btn-primary w-full text-left">
                                                Mantenimientos
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            <div x-show="open" x-transition class="mt-2">
                                                @if ($coche->mantenimientos->count() > 0)
                                                    @foreach ($coche->mantenimientos as $mantenimiento)
                                                        <div class="border border-gray-200 dark:border-gray-700 rounded-md p-4 mb-2">
                                                         
                                                            <h6 class="font-semibold text-base dark:text-white-light">{{ $mantenimiento->formatted_start_at }}</h6>
                                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                                Encargado: {{ $mantenimiento->empleado->name }} {{ $mantenimiento->empleado->lastname }}
                                                            </p>
                                                            <p class="text-sm text-gray-600 dark:text-gray-400 truncate">
                                                                Descripción: {{ $mantenimiento->description }}
                                                            </p>

                                                            {{-- ver --}}
                                                            <div class="flex justify-end mt-2">
                                                                <a href="{{ route('mantenimientos.show', $mantenimiento->id) }}" class="text-primary hover:underline">Ver</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-center text-gray-600 dark:text-gray-400">No hay mantenimientos registrados</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="mt-5 ">
                                    <a href="{{ url('mantenimientos/create?id=' . base64_encode($coche->id)) }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Crear Mantenimiento
                                    </a>
                                </div>
                            </div>
                               @endforeach
                            @else
                                {{-- no hay coches registrados --}}
                                <h2>
                                    No hay coches registrados
                                </h2>
                            @endif

                           
                        </div>
                        
                    </div>
                </template>
                <template x-if="tab === 'preferences'">
                    <div class="switch">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Choose Theme</h5>
                                <div class="flex justify-around">
                                    <label class="inline-flex cursor-pointer">
                                        <input class="form-radio ltr:mr-4 rtl:ml-4 cursor-pointer" type="radio"
                                            name="flexRadioDefault" checked="" />
                                        <span>
                                            <img class="ms-3" width="100" height="68" alt="settings-dark"
                                                src="/assets/images/settings-light.svg" />
                                        </span>
                                    </label>

                                    <label class="inline-flex cursor-pointer">
                                        <input class="form-radio ltr:mr-4 rtl:ml-4 cursor-pointer" type="radio"
                                            name="flexRadioDefault" />
                                        <span>
                                            <img class="ms-3" width="100" height="68" alt="settings-light"
                                                src="/assets/images/settings-dark.svg" />
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Activity data</h5>
                                <p>Download your Summary, Task and Payment History Data</p>
                                <button type="button" class="btn btn-primary">Download Data</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Public Profile</h5>
                                <p>Your <span class="text-primary">Profile</span> will be visible to anyone on the
                                    network.</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox1" />
                                    <span for="custom_switch_checkbox1"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Show my email</h5>
                                <p>Your <span class="text-primary">Email</span> will be visible to anyone on the
                                    network.</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox2" />
                                    <span for="custom_switch_checkbox2"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Enable keyboard shortcuts</h5>
                                <p>When enabled, press <span class="text-primary">ctrl</span> for help</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox3" />
                                    <span for="custom_switch_checkbox3"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Hide left navigation</h5>
                                <p>Sidebar will be <span class="text-primary">hidden</span> by default</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox4" />
                                    <span for="custom_switch_checkbox4"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Advertisements</h5>
                                <p>Display <span class="text-primary">Ads</span> on your dashboard</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox5" />
                                    <span for="custom_switch_checkbox5"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Social Profile</h5>
                                <p>Enable your <span class="text-primary">social</span> profiles on this network</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox6" />
                                    <span for="custom_switch_checkbox6"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="tab === 'danger-zone'">
                    <div class="switch">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Purge Cache</h5>
                                <p>Remove the active resource from the cache without waiting for the predetermined cache
                                    expiry time.</p>
                                <button class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Deactivate Account</h5>
                                <p>You will not be able to receive messages, notifications for up to 24 hours.</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox7" />
                                    <span for="custom_switch_checkbox7"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Delete Account</h5>
                                <p>Once you delete the account, there is no going back. Please be certain.</p>
                                <button class="btn btn-danger btn-delete-account">Delete my account</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

</x-layout.default>


<script>
     
        document.getElementById('cocheFormAdd').addEventListener('submit', function(event) {
          
            event.preventDefault();

            const marca = document.getElementById('marca').value;
            const placa = document.getElementById('placa').value;
            const color = document.getElementById('color').value;
            const year = document.getElementById('year').value;
            const cliente_id = document.getElementById('cliente_id').value;
            const model = document.getElementById('model').value;
            const images = document.getElementById('images').files;

            if (!marca || !placa || !color || !year || !cliente_id || !model) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Todos los campos son requeridos',
                });
            }

            const formData = new FormData();
            formData.append('marca', marca);
            formData.append('placa', placa);
            formData.append('color', color);
            formData.append('year', year);
            formData.append('cliente_id', cliente_id);
            formData.append('model', model);
            
            formData.append('_token', "{{ csrf_token() }}");

            for (let i = 0; i < images.length; i++) {
                formData.append('images[]', images[i]);
            }

            $.ajax({
                url: "{{ route('coches.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: response.message,
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                            showConfirmButton: true,
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocurrió un error al guardar el coche en la base de datos',
                    });
                }
            });
        });
     
</script>
