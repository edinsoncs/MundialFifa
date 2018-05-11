/*
Vamos en este archivo a definir nuestra función "ajax()" que permita
realizar peticiones configurables por ajax.

Versión 1
ajax(url, method, success, data);

ej:
ajax('api/verificar.php', 'post', function(data) {
	document.getElementById('respuesta').innerHTML = data;
}, 'e=' + email.value);

Versión 2
ajax(options)

ej:
ajax({
	url: 'api/verificar.php', 
	method: 'post', 
	data: 'e=' + email.value,
	success: function(data) {
		document.getElementById('respuesta').innerHTML = data;
	}
});


Versión 3 - Usando chiches de ECMAScript 6 :D
- Object Destructuring
function ajax({url, method, data, success})

Y con defaults
function ajax({url, method, data, success} = {method: 'get'})
*/

// function ajax({url, method, data, success} = {method: 'get'}) {

/**
 * Realiza una petición de Ajax.
 *
 * @param {Object} options	Las opciones de la petición.
 * @param {string} options.url 	La url del recurso.
 * @param {string} options.method 	El método/verbo. Default: 'get'.
 * @param {string} options.data 	Los datos a enviar. Default: null.
 * @param {function} options.success 	Callback del éxito. Recibe un parámetro con la respuesta.
 * @param {bool} options.useFullScreenLoader 	Si debe mostrarse un loader de pantalla completa. Default: false.
 * @param {string} options.type 	El tipo de la respuesta. Puede ser "text" o "json". Default: Json.
 */
function ajax({url, method = 'get', data = null, success, useFullScreenLoader = false, type = 'text'}) {
	var sendBody = null;
	var loaderContainer;
	method = method.toLowerCase();	

	// Creamos el loader.
	var temp = document.createElement('div');
	temp.innerHTML = '<div id="ajax-loader"><img src="http://www.primebldg.com/wp-content/uploads/2017/09/ajax-loader.gif" alt="Cargando..."></div>';
	loaderContainer = temp.firstChild;

	/*if(method == undefined) {
		method = 'get';
	} else {
		method = method.toLowerCase();
	}*/

	// Verificamos donde mandar la data.
	if(data != null) {
		if(method == "get") {
			url += '?' + data;
		} else if(method == "post" || method == "put") {
			sendBody = data;
		}
	}

	// Instanciamos el objeto XHR.
	var xhr = new XMLHttpRequest();

	// Configuramos la petición.
	xhr.open(method, url);

	// Asignar el listener.
	xhr.addEventListener('readystatechange', function() {
		if(xhr.readyState == 4) {
			removeFullScreenLoader();
			if(xhr.status == 200) {
				if(type == "text") {
					success(xhr.responseText);
				} else if(type == "json") {
					success(JSON.parse(xhr.responseText));
				}
			}
		}
	}, false);

	// Seteo de headers.
	if(method == "post") {
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	}

	// Agregamos el logo de carga.
	addFullScreenLoader();

	// Enviamos la petición.
	xhr.send(sendBody);

	/**
	 * Agrega el loader.
	 */
	function addFullScreenLoader() {
		if(useFullScreenLoader) {
			document.body.appendChild(loaderContainer);
		}
	}

	/**
	 * Remueve el loader.
	 */
	function removeFullScreenLoader() {
		if(useFullScreenLoader) {
			document.body.removeChild(loaderContainer);
		}
	}
}

/*function ajax(url, method, success, data) {
	var sendBody = null;

	// Verificamos donde mandar la data.
	if(data != null) {
		if(method.toLowerCase() == "get") {
			url += '?' + data;
		} else if(method.toLowerCase() == "post") {
			sendBody = data;
		}
	}

	// Instanciamos el objeto XHR.
	var xhr = new XMLHttpRequest();

	// Configuramos la petición.
	xhr.open(method, url);

	// Asignar el listener.
	xhr.addEventListener('readystatechange', function() {
		if(xhr.readyState == 4) {
			if(xhr.status == 200) {
				success(xhr.responseText);
			}
		}
	}, false);

	// Seteo de headers.
	if(method.toLowerCase() == "post") {
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	}

	// Enviamos la petición.
	xhr.send(sendBody);
}*/

/**
 * Función wrapper de document.getElementById().
 *
 * @param {string} id 	El id del elemento a buscar.
 * @returns {HTMLElement}
 */
function $(id) {
	return document.getElementById(id);
}