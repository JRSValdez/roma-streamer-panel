$(document).ready(function(){
    tabla_ruleta();

    function tabla_ruleta(){
        let estado;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let datatable = $('#tabla_ruleta').DataTable({
            processing: true,
            serverSide:true,
            "ajax": {
                "url": "/streamer/roulette/getroulette",
                "method": "POST",
            },
            columns: [
                {data: 'reward', name: 'reward'},
                {data: 'participants_number', name: 'participants_number'},
                {data: 'status', "render": function ( data, type, row ){
                        if (row["status"] == 1) {
                            estado = '<span class="badge badge-info">Activado</span>';
                        }else if(row["status"] == 0){
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
                                    <button class="btn btn-info btn-sm ganadores" title="Ir a Ruleta"><i class="fas fa-trophy"></i></button>
                `}
            ],
            "language": espanol
        });

        $('#tabla_ruleta tbody').on('click', '.activar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;

            $.post('/streamer/roulette/activateroulette', {id}, (response) => {
                alert('activado codigo con id: '+id);
                if (response == 'activado') {
                    var ref = $('#tabla_ruleta').DataTable();
                    ref.ajax.reload();
                }else{

                }
            });

        });

        $('#tabla_ruleta tbody').on('click', '.desactivar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;

            $.post('/streamer/roulette/deactivateroulette', {id}, (response) => {
                alert('desactivando codigo con id: '+id);
                if (response == 'desactivado') {
                    var ref = $('#tabla_ruleta').DataTable();
                    ref.ajax.reload();
                }else{

                }
            });
        });

        $('#tabla_ruleta tbody').on('click', '.borrar', function() {
            let datos = datatable.row($(this).parents()).data();
            let id = datos.id;
            alert('borrando codigo con id: '+id);
        });
    }

    /*$('#form-generar').submit(e => {
        let reward = $('#reward').val();
        if (reward.length > 0) {
            $.post('/streamer/roulette/create_roulette', {reward}, function(response){
                if (response == 'add') {
                    $('#add').hide('slow');
                    $('#add').show(2000);
                    $('#add').hide(2000);
                    $('#form-generar').trigger('reset');
                    tabla_ruleta();
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
