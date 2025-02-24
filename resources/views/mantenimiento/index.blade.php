<x-layout.default>

    <div class="panel lg:col-span-2 xl:col-span-3">
        <div class="mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Mantenimientos</h5>
        </div>
        <div class="mb-5">
            <div class="table-responsive text-[#515365] dark:text-white-light font-semibold">
                <table class="whitespace-nowrap">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Numero de Contacto</th>
                            <th>Coche</th>
                            <th>Placa</th>
                            <th>Fecha de Ingreso</th>
                            <th>Tipo de servicio</th>
                            <th>Encargado</th>
                            <th>Valor</th>
                            <th class="text-center">Iniciado</th>
                            <th>Estado</th>
                            <th colspan="2">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="dark:text-white-dark">
                        <tr>
                            
                            <td>Aaron carter</td>
                            <td>123456789</td>
                            <td>Toyota</td>
                            <td>123456</td>
                            <td>12/12/2021</td>
                            <td>Reparacion</td>
                            <td>Carlos</td>
                            <td>100.000</td>
                            <td class="text-center">
                                <span class="text-green-500">Si</span>
                            </td>
                            <td>
                                <span class="text-green-500">Activo</span>
                            </td>

                            <td>
                                <a {{-- href="{{ route('mantenimiento.show', 1) }}" --}} class="text-blue-500">Ver</a>
                                <a {{-- href="{{ route('mantenimiento.edit', 1) }}" --}} class="text-blue-500">Editar</a>
                                <form {{-- action="{{ route('mantenimiento.destroy', 1) }}" --}} method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Eliminar</button>
                                </form>
                            </td>
                            

                            
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout.default>
