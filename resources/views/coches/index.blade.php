<x-layout.default>
    <script src="/assets/js/simple-datatables.js"></script>
    <div class="flex justify-end mt-4">
        <a href="{{ route('coches.create') }}" class="btn btn-primary">Nuevo Coche</a>
    </div>
    <div x-data="cochesData({{ $coches->toJson() }})">
        <div class="panel mt-6 no-number-pagination next-prev-pagination">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Coches</h5>
            <table id="myTable4" class="whitespace-nowrap"></table>
        </div>


    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("cochesData", (coches) => ({
                init() {
                    const tableData = coches.map((coche, index) => [
                        index + 1,
                        coche.cliente ? coche.cliente.name : 'N/A', // Asegúrate de que la relación 'cliente' esté cargada
                        coche.marca, // Enlace a la pantalla de detalle del coche
                        coche.placa,
                        coche.color,
                        coche.year,
                        `<a href="{{ url('coches/${coche.id}') }}" class="btn btn-primary">Ver</a>
                        <button class="btn btn-danger" @click="deleteCoche(${coche.id})">Eliminar</button>
                        `
                    ]);

                    const tableOptions = {
                        data: {
                            headings: ["#", "Cliente", "Marca", "Placa", "Color", "Año","Acciones"],
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
                }
            }));
        });

        deleteCoche = (id) => {
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
                        url: `/coches/${id}`,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire({
                                title: 'Eliminado!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: true,
                                
                            }).then(() => {
                                window.location.reload();
                            });
                            
                        }
                    });
                }
            })
        }
    </script>
</x-layout.default>