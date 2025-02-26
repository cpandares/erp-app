<x-layout.default>

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
        <div class="pt-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Perfil del CLiente</h5>
                        <a href="/users/user-account-settings"
                            class="ltr:ml-auto rtl:mr-auto btn btn-primary p-2 rounded-full">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <path opacity="0.5" d="M4 22H20" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path
                                    d="M14.6296 2.92142L13.8881 3.66293L7.07106 10.4799C6.60933 10.9416 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.25745 16.2417L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L5.75834 17.7426L8.38334 16.8675L8.3834 16.8675C9.00284 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0583 15.3907 11.5201 14.929L11.5201 14.9289L18.3371 8.11195L19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M13.8879 3.66406C13.8879 3.66406 13.9806 5.23976 15.3709 6.63008C16.7613 8.0204 18.337 8.11308 18.337 8.11308M5.75821 17.7437L4.25732 16.2428"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-col justify-center items-center">
                            <img src="/assets/images/profile-34.jpeg" alt="image"
                                class="w-24 h-24 rounded-full object-cover  mb-5" />
                            <p class="font-semibold text-primary text-xl">
                                Cliente: <span class="text-white">
                                    {{ $cliente->name }}
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
                                    Documento: <span class="text-white">
                                        {{ $cliente->document }}
                                    </span>
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
                                    Email: <span class="text-white">
                                        {{ $cliente->email }}
                                    </span>
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
                                    Dirección: <span class="text-white">
                                        {{ $cliente->country }} - {{ $cliente->address }}
                                    </span>
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
                                    Teléfono: <span class="text-white">
                                        {{ $cliente->phone }}
                                    </span>
                                </span>
                            </li>
                        </ul>
                       
                    </div>
                </div>
                <div class="panel lg:col-span-2 xl:col-span-3">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Coches</h5>
                    </div>
                    <div class="mb-5">
                        <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                            <table class="whitespace-nowrap">
                                <thead>
                                    <tr>
                                        <th>Marca</th>
                                        <th>Plca</th>
                                        <th>Año</th>
                                        <th >Cantidad de servicios realizados</th>
                                        
                                        <th colspan="2">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="dark:text-white-dark">
                                    @if ($cliente->coches->count()  > 0)
                                    @foreach($cliente->coches as $coche)
                                    <tr>
                                        <td>{{ $coche->marca }}</td>
                                        <td>{{ $coche->placa }}</td>
                                        <td>{{ $coche->year }}</td>
                                        <td>{{ $coche->mantenimientos->count() }}</td>
                                        <td>
                                            <a href="{{url('coches/'.$coche->id)}}"
                                                class="btn btn-primary p-2 rounded-full">
                                                <i
                                                    class="fas fa-eye"></i>
                                                    ></i>
                                            </a>
                                        </td>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No hay coches registrados</td>
                                    </tr>
                                    
                                    @endif
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


</x-layout.default>