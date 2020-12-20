$(document).ready(function(){
  
    let estado;
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    let datatable = $('#codigo_lista').DataTable({
      processing: true,
      serverSide:true,  
      "ajax": {
                "url": "/streamer/getcodigos",
                "method": "POST",
            },
      columns: [
         { data: 'codigo', name: 'codigo' },
         { data: 'premiop', name: 'premiop' },
         { data: 'maximo_ganadores', name: 'maximo_ganadores' },
         { data: 'elegir_ganador', name: 'elegir_ganador' },
         {data: 'estado', "render": function ( data, type, row ){
               if (row["estado"] == 'a') {
                  estado = '<span class="badge badge-info">Activado</span>';
               }else if(row["estado"] == 'i'){
                  estado = '<span class="badge badge-warning">Desactivado</span>';                       
               }else{
                  estado = '<span class="badge badge-danger">Sin estado</span>';
               }
               return estado;
            }
         },
         { data: 'fecha_creacion', name: 'fecha_creacion' },
         { "defaultContent": `
            <button class="btn btn-success btn-sm activar" type="button" data-toggle="modal" data-target="#crear_membresia" title="Activar"><i class="fas fa-check"></i></button>
            <button class="btn btn-warning btn-sm desactivar" title="Desactivar"><i class="fas fa-times"></i></button>
            <button class="btn btn-danger btn-sm borrar" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
            <button class="btn btn-info btn-sm ganadores" title="Ver Ganadores"><i class="fas fa-trophy"></i></button>
         `}
      ],
      "language": espanol
    });

    $('#codigo_lista tbody').on('click', '.activar', function() {
      let datos = datatable.row($(this).parents()).data();
      id_code = datos.id_codigo

      $.post('/streamer/activarcodigo', {id_code}, (response) => {
        if (response == 'activado') {            
            var ref = $('#codigo_lista').DataTable();
            ref.ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'success',
              title: 'Código activado'
            })
        }else{
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'error',
              title: 'Código desactivado'
            })
        }
      });
      
    });

    $('#codigo_lista tbody').on('click', '.desactivar', function() {
      let datos = datatable.row($(this).parents()).data();
      id_code = datos.id_codigo

      $.post('/streamer/desactivarcodigo', {id_code}, (response) => {
        if (response == 'desactivado') {            
            var ref = $('#codigo_lista').DataTable();
            ref.ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'warning',
              title: 'Código desactivado'
            })
        }else{
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'error',
              title: 'No se pudo desactivar el código seleccionado'
            })
        }
      });
    });

    $('#codigo_lista tbody').on('click', '.borrar', function() {
      let datos = datatable.row($(this).parents()).data();
      id_code = datos.id_codigo
      
      $.post('/streamer/borrarcodigo', {id_code}, (response) => {
        if (response == 'borrado') {            
            var ref = $('#codigo_lista').DataTable();
            ref.ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'info',
              title: 'Código borrado'
            })
        }else{
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'error',
              title: 'No se pudo borrar el código seleccionado'
            })
        }
      });
    });

    $('#codigo_lista tbody').on('click', '.ganadores', function() {
      let datos = datatable.row($(this).parents()).data();
      id_code = datos.id_codigo
      window.open('/streamer/codigos/ganadores/'+id_code, '_blank');
    });

  $('#form-generar-codigo').submit(e => {
      let regalo = $('#regalo').val();
      let ganador = $('#ganador').val();
      let max_reclamo = $('#max_reclamo').val();
      if (max_reclamo > 0) {
        $.post('/streamer/nuevocodigo', {regalo, ganador, max_reclamo}, function(response){
          if (response == 'add') {
            $('#add').hide('slow');
            $('#add').show(2000);
            $('#add').hide(2000);
            $('#form-generar-codigo').trigger('reset');
            var ref = $('#codigo_lista').DataTable();
            ref.ajax.reload();
          }else{
            $('#noadd').hide('slow');
            $('#noadd').show(2000);
            $('#noadd').hide(2000);
          }
        });
      }else{
        $('#noadd-cod').hide('slow');
        $('#noadd-cod').show(2000);
        $('#noadd-cod').hide(2000);
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