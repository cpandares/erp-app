<x-layout.default>
    <script src="/assets/js/simple-datatables.js"></script>
    <div class="flex justify-end mt-4">
        <a href="{{ route('coches.create') }}" class="btn btn-primary">Nuevo Coche</a>
    </div>

    <div x-data="mantenimientosData({{ $mantenimientos->toJson() }})">
        <div class="panel mt-6 no-number-pagination next-prev-pagination">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Coches</h5>
            <table id="myTable4" class="whitespace-nowrap">

            </table>
        </div>

        <!-- Modal para editar coche -->


    </div>

</x-layout.default>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("mantenimientosData", (servicios) => ({
            servicios: servicios,

            init() {
                const tableData = this.servicios.map((mantenimiento, index) => [
                    index + 1,
                    mantenimiento.cliente ? mantenimiento.cliente.name : 'No asignado',
                    mantenimiento.coche ? mantenimiento.coche.marca : 'No asignado',
                    mantenimiento.coche ? mantenimiento.coche.placa : 'No asignado',
                    mantenimiento.diffForHumans ? mantenimiento.diffForHumans : 'No asignado',
                    mantenimiento.status,
                    `<div class="flex gap-4 items-center justify-center">
                    <a href="/mantenimientos/${mantenimiento.id}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger" data-delete-id="${mantenimiento.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>`
                ]);

                const tableOptions = {
                    data: {
                        headings: ["#", "Cliente", "Marca", "Placa", "Fecha Ingreso", "Estado",
                            "Acciones"
                        ],
                        data: tableData
                    },
                    searchable: true,
                    perPage: 10,
                    perPageSelect: [10, 20, 30, 50, 100],
                    columns: [{
                        select: 0,
                        sort: "asc"
                    }],
                    labels: {
                        perPage: "{select}"
                    },
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
                        const id = e.currentTarget.getAttribute('data-delete-id');
                        this.deleteMantenimiento(id);
                    });
                });
            });
            },
            
            deleteMantenimiento(id) {
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
                            url: `/mantenimientos/${id}`,
                            type: 'DELETE',
                            /* csrf */
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(response) {
                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Eliminado!',
                                        text: response.message,
                                        icon: 'success',
                                        showConfirmButton: true,

                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message,
                                        icon: 'error',
                                        showConfirmButton: true,

                                    }).then(() => {
                                        window.location.reload();
                                    });
                                }

                            },
                            error: function(response) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    showConfirmButton: true,

                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })
            }
        }));
    });
</script>
