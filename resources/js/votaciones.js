$(document).ready(function() {

    const divAnswer1 = $("#answer1");
    const divAnswer2 = $("#answer2");
    const answerDetail1 = $("#answer_detail1");
    const answerDetail2 = $("#answer_detail2");

    tabla_votacion();

    const printLabel = (option) => {
        return `<label>${option}</label>`;
    };
    const swalDelete = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

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
            "language": espanol,
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
                        position: 'top-end',
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
                }else if(response == 'noaddactive'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hay una encuesta activa, desactivala o borrala primero!'
                    });
                }
                else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
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
                        position: 'top-end',
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
                        title: 'Encuesta desactivada'
                    })
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
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
            swalDelete.fire({
                title: '¿Desea eliminar el registro?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
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
                                icon: 'warning',
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
                }
            });

        });

        $('#tabla_votacion tbody').on('click', '.resultados', function() {

            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;

            $.post('/streamer/votaciones/getanswerdetail', {id}, (response) => {

                let option1 = response[0].answer;
                let option2 = response[1].answer;
                let totalAnswers = parseInt(response[0].total_answer_detail) + parseInt(response[1].total_answer_detail);
                let option1Percent = (parseInt(response[0].total_answer_detail) !== 0) ? Math.round(((parseInt(response[0].total_answer_detail)/totalAnswers) * 100)) + '%' : `0%`;
                let option2Percent = (parseInt(response[1].total_answer_detail) !== 0) ? Math.round(((parseInt(response[1].total_answer_detail)/totalAnswers) * 100)) + '%' : `0%`;

                divAnswer1.html(printLabel(option1));
                answerDetail1.html(printLabel(option1Percent));
                divAnswer2.html(printLabel(option2));
                answerDetail2.html(printLabel(option2Percent));

            });
        });

    }

    $('#create-votation-form').submit(e => {
            let question = $('#question').val();
            let option1 = $('#option1').val();
            let option2 = $('#option2').val();
            if (question.length > 0 && option1.length > 0 && option2.length > 0) {
                $.post('/streamer/votaciones/create_poll', {question, option1, option2}, function(response){
                    if (response == 'add') {
                        $('#add').hide('slow');
                        $('#add').show(2000);
                        $('#add').hide(4000);
                        $('#create-votation-form').trigger('reset');
                        var ref = $('#tabla_votacion').DataTable();
                        ref.ajax.reload();
                    }else if(response == 'noaddactive'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Posees una encuesta activa, desactivala para agregar una nueva!'
                        })
                    }
                    else{
                        $('#create-votation-form').trigger('reset');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ya pasaste el limite de encuestas por dia!'
                        })
                    }
                });
            }else{
                $('#noadd-emp').hide('slow');
                $('#noadd-emp').show(2000);
                $('#noadd-emp').hide(5000);
            }
        e.preventDefault();
    });


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
