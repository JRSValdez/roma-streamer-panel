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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/roulette.js":
/*!**********************************!*\
  !*** ./resources/js/roulette.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  tabla_ruleta();

  function tabla_ruleta() {
    var estado;
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var datatable = $('#tabla_ruleta').DataTable({
      processing: true,
      serverSide: true,
      "ajax": {
        "url": "/streamer/roulette/getroulette",
        "method": "POST"
      },
      columns: [{
        data: 'reward',
        name: 'reward'
      }, {
        data: 'participants_number',
        name: 'participants_number'
      }, {
        data: 'status',
        "render": function render(data, type, row) {
          if (row["status"] == 1) {
            estado = '<span class="badge badge-info">Activado</span>';
          } else if (row["status"] == 0) {
            estado = '<span class="badge badge-warning">Desactivado</span>';
          } else {
            estado = '<span class="badge badge-danger">Sin estado</span>';
          }

          return estado;
        }
      }, {
        "defaultContent": "\n                                    <button class=\"btn btn-success btn-sm activar\" type=\"button\" data-toggle=\"modal\" title=\"Activar\"><i class=\"fas fa-check\"></i></button>\n                                    <button class=\"btn btn-warning btn-sm desactivar\" title=\"Desactivar\"><i class=\"fas fa-times\"></i></button>\n                                    <button class=\"btn btn-danger btn-sm borrar\" title=\"Eliminar\"><i class=\"fas fa-trash-alt\"></i></button>\n                                    <button class=\"btn btn-info btn-sm ganadores\" title=\"Ir a Ruleta\"><i class=\"fas fa-trophy\"></i></button>\n                "
      }],
      "language": espanol
    });
    $('#tabla_ruleta tbody').on('click', '.activar', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      $.post('/streamer/roulette/activateroulette', {
        id: id
      }, function (response) {
        alert('activado codigo con id: ' + id);

        if (response == 'activado') {
          var ref = $('#tabla_ruleta').DataTable();
          ref.ajax.reload();
        } else {}
      });
    });
    $('#tabla_ruleta tbody').on('click', '.desactivar', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      $.post('/streamer/roulette/deactivateroulette', {
        id: id
      }, function (response) {
        alert('desactivando codigo con id: ' + id);

        if (response == 'desactivado') {
          var ref = $('#tabla_ruleta').DataTable();
          ref.ajax.reload();
        } else {}
      });
    });
    $('#tabla_ruleta tbody').on('click', '.borrar', function () {
      var datos = datatable.row($(this).parents()).data();
      var id = datos.id;
      alert('borrando codigo con id: ' + id);
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

/***/ 2:
/*!****************************************!*\
  !*** multi ./resources/js/roulette.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\roma\roma-streamer-panel\resources\js\roulette.js */"./resources/js/roulette.js");


/***/ })

/******/ });