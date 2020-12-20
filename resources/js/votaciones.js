$(document).ready(function(){
    tabla_votacion();

    function tabla_votacion(){
        let estado;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let datatable = $('#tabla_votacion').DataTable({
            processing: true,
            serverSide:true,
            "ajax": {
                "url": "/streamer/getvotaciones",
                "method": "POST",
            },
            columns: [
                {data: 'question', name: 'question'},
                {data: 'participants_number', name: 'participants_number'},
                {data: 'status', "render": function ( data, type, row ){
                        if (row["status"] == 1) {
                            estado = '<span class="badge badge-info">Activado</span>';
                        }else if(row["status"] == 2){
                            estado = '<span class="badge badge-warning">Desactivado</span>';
                        }else{
                            estado = '<span class="badge badge-danger">Sin estado</span>';
                        }
                        return estado;
                    }
                },
                { "defaultContent": `
                                    <button class="btn btn-success btn-sm activar" type="button" data-toggle="modal" title="Activar"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-warning btn-sm desactivar" title="Desactivar"><i class="fas fa-times"></i></button>
                                    <button class="btn btn-danger btn-sm borrar" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                    <button class="btn btn-info btn-sm resultados" title="Ver Resultados" data-toggle="modal" data-target="#pollAnswersDetailModal"><i class="fas fa-trophy"></i></button>
                `}
            ],
            "language": espanol
        });

        $('#tabla_votacion tbody').on('click', '.activar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;

            $.post('/streamer/votaciones/activatevotacion', {id}, (response) => {
                if (response == 'activado') {
                    var ref = $('#tabla_votacion').DataTable();
                    ref.ajax.reload();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Encuesta activada'
                    })
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo activar la encuesta seleccionada'
                    })
                }
            });

        });

        $('#tabla_votacion tbody').on('click', '.desactivar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;

            $.post('/streamer/votaciones/deactivatevotacion', {id}, (response) => {
                if (response == 'desactivado') {
                    var ref = $('#tabla_votacion').DataTable();
                    ref.ajax.reload();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'warning',
                        title: 'Encuesta desactivada'
                    })
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo desactivar la encuesta seleccionada'
                    })
                }
            });
        });

        $('#tabla_votacion tbody').on('click', '.borrar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;

            $.post('/streamer/votaciones/deletevotacion', {id}, (response) => {
                if (response == 'deleted') {
                    var ref = $('#tabla_votacion').DataTable();
                    ref.ajax.reload();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'info',
                        title: 'Encuesta borrada'
                    })
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'No se pudo borrar la encuesta seleccionada'
                    })
                }
            });
        });

    }

    $('#tabla_votacion tbody').on('click', '.desactivar', function() {
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id;

        $.post('/streamer/votaciones/deactivatevotacion', {id}, (response) => {
            if (response == 'desactivado') {
                var ref = $('#tabla_votacion').DataTable();
                ref.ajax.reload();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'warning',
                    title: 'Encuesta desactivada'
                })
            }else{
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'No se pudo desactivar la encuesta seleccionada'
                })
            }
        });
    });

    /*$('#form-generar').submit(e => {
        let reward = $('#reward').val();
        if (reward.length > 0) {
            $.post('/streamer/roulette/create_roulette', {reward}, function(response){
                if (response == 'add') {
                    $('#add').hide('slow');
                    $('#add').show(2000);
                    $('#add').hide(2000);
                    $('#form-generar').trigger('reset');
                    tabla_votacion();
                }else{
                    $('#noadd').hide('slow');
                    $('#noadd').show(2000);
                    $('#noadd').hide(2000);
                }
            });
        }else{
            $('#noadd-emp').hide('slow');
            $('#noadd-emp').show(2000);
            $('#noadd-emp').hide(2000);
        }
        e.preventDefault();
    });*/



});

let espanol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};
