/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/votaciones.js":
/*!************************************!*\
  !*** ./resources/js/votaciones.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var divAnswer1 = $("#answer1");
  var divAnswer2 = $("#answer2");
  var answerDetail1 = $("#answer_detail1");
  var answerDetail2 = $("#answer_detail2");
  tabla_votacion();

  var printLabel = function printLabel(option) {
    return "<label>".concat(option, "</label>");
  };

  var swalDelete = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  });

  function tabla_votacion() {
    var estado;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var datatable = $('#tabla_votacion').DataTable({
      processing: true,
      serverSide: true,
      "ajax": {
        "url": "/streamer/getvotaciones",
        "method": "POST"
      },
      columns: [{
        data: 'question',
        name: 'question'
      }, {
        data: 'participants_number',
        name: 'participants_number'
      }, {
        data: 'status',
        "render": function render(data, type, row) {
          if (row["status"] == 1) {
            estado = '<span class="badge badge-info">Activado</span>';
          } else if (row["status"] == 2) {
            estado = '<span class="badge badge-warning">Desactivado</span>';
          } else {
            estado = '<span class="badge badge-danger">Sin estado</span>';
          }

          return estado;
        }
      }, {
        "defaultContent": "\n                                    <button class=\"btn btn-success btn-sm activar\" type=\"button\" data-toggle=\"modal\" title=\"Activar\"><i class=\"fas fa-check\"></i></button>\n                                    <button class=\"btn btn-warning btn-sm desactivar\" title=\"Desactivar\"><i class=\"fas fa-times\"></i></button>\n                                    <button class=\"btn btn-danger btn-sm borrar\" title=\"Eliminar\"><i class=\"fas fa-trash-alt\"></i></button>\n                                    <button class=\"btn btn-info btn-sm resultados\" title=\"Ver Resultados\" data-toggle=\"modal\" data-target=\"#pollAnswersDetailModal\"><i class=\"fas fa-trophy\"></i></button>\n                "
      }],
      "language": espanol
    });
    $('#tabla_votacion tbody').on('click', '.activar', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      $.post('/streamer/votaciones/activatevotacion', {
        id: id
      }, function (response) {
        if (response == 'activado') {
          var ref = $('#tabla_votacion').DataTable();
          ref.ajax.reload();
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: function didOpen(toast) {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
          });
          Toast.fire({
            icon: 'success',
            title: 'Encuesta activada'
          });
        } else if (response == 'noaddactive') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hay una encuesta activa, desactivala o borrala primero!'
          });
        } else {
          var _Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: function didOpen(toast) {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
          });

          _Toast.fire({
            icon: 'error',
            title: 'No se pudo activar la encuesta seleccionada'
          });
        }
      });
    });
    $('#tabla_votacion tbody').on('click', '.desactivar', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      $.post('/streamer/votaciones/deactivatevotacion', {
        id: id
      }, function (response) {
        if (response == 'desactivado') {
          var ref = $('#tabla_votacion').DataTable();
          ref.ajax.reload();
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: function didOpen(toast) {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
          });
          Toast.fire({
            icon: 'info',
            title: 'Encuesta desactivada'
          });
        } else {
          var _Toast2 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: function didOpen(toast) {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
          });

          _Toast2.fire({
            icon: 'error',
            title: 'No se pudo desactivar la encuesta seleccionada'
          });
        }
      });
    });
    $('#tabla_votacion tbody').on('click', '.borrar', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      swalDelete.fire({
        title: '¿Desea eliminar el registro?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then(function (result) {
        if (result.isConfirmed) {
          $.post('/streamer/votaciones/deletevotacion', {
            id: id
          }, function (response) {
            if (response == 'deleted') {
              var ref = $('#tabla_votacion').DataTable();
              ref.ajax.reload();
              var Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: function didOpen(toast) {
                  toast.addEventListener('mouseenter', Swal.stopTimer);
                  toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
              });
              Toast.fire({
                icon: 'warning',
                title: 'Encuesta borrada'
              });
            } else {
              var _Toast3 = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: function didOpen(toast) {
                  toast.addEventListener('mouseenter', Swal.stopTimer);
                  toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
              });

              _Toast3.fire({
                icon: 'error',
                title: 'No se pudo borrar la encuesta seleccionada'
              });
            }
          });
        }
      });
    });
    $('#tabla_votacion tbody').on('click', '.resultados', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      $.post('/streamer/votaciones/getanswerdetail', {
        id: id
      }, function (response) {
        var option1 = response[0].answer;
        var option2 = response[1].answer;
        var totalAnswers = parseInt(response[0].total_answer_detail) + parseInt(response[1].total_answer_detail);
        var option1Percent = parseInt(response[0].total_answer_detail) !== 0 ? Math.round(parseInt(response[0].total_answer_detail) / totalAnswers * 100) + '%' : "0%";
        var option2Percent = parseInt(response[1].total_answer_detail) !== 0 ? Math.round(parseInt(response[1].total_answer_detail) / totalAnswers * 100) + '%' : "0%";
        divAnswer1.html(printLabel(option1));
        answerDetail1.html(printLabel(option1Percent));
        divAnswer2.html(printLabel(option2));
        answerDetail2.html(printLabel(option2Percent));
      });
    });
  }

  $('#create-votation-form').submit(function (e) {
    var question = $('#question').val();
    var option1 = $('#option1').val();
    var option2 = $('#option2').val();

    if (question.length > 0 && option1.length > 0 && option2.length > 0) {
      $.post('/streamer/votaciones/create_poll', {
        question: question,
        option1: option1,
        option2: option2
      }, function (response) {
        if (response == 'add') {
          $('#add').hide('slow');
          $('#add').show(2000);
          $('#add').hide(4000);
          $('#create-votation-form').trigger('reset');
          var ref = $('#tabla_votacion').DataTable();
          ref.ajax.reload();
        } else if (response == 'noaddactive') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Posees una encuesta activa, desactivala para agregar una nueva!'
          });
        } else {
          $('#create-votation-form').trigger('reset');
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ya pasaste el limite de encuestas por dia!'
          });
        }
      });
    } else {
      $('#noadd-emp').hide('slow');
      $('#noadd-emp').show(2000);
      $('#noadd-emp').hide(5000);
    }

    e.preventDefault();
  });
});
var espanol = {
  "sProcessing": "Procesando...",
  "sLengthMenu": "Mostrar _MENU_ registros",
  "sZeroRecords": "No se encontraron resultados",
  "sEmptyTable": "Ningún dato disponible en esta tabla",
  "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
  "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
  "sInfoPostFix": "",
  "sSearch": "Buscar:",
  "sUrl": "",
  "sInfoThousands": ",",
  "sLoadingRecords": "Cargando...",
  "oPaginate": {
    "sFirst": "Primero",
    "sLast": "Último",
    "sNext": "Siguiente",
    "sPrevious": "Anterior"
  },
  "oAria": {
    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  },
  "buttons": {
    "copy": "Copiar",
    "colvis": "Visibilidad"
  }
};

/***/ }),

/***/ 3:
/*!******************************************!*\
  !*** multi ./resources/js/votaciones.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\roma-streamer-panel\resources\js\votaciones.js */"./resources/js/votaciones.js");


/***/ })

/******/ });