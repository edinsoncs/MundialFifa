'use strict';


/**
 * @return {[Element]}
 */
 function createModal(type){

	//Create element and attributes
	var _section = createElement('section');

	//Set id and class
	isAttribute(_section, 'id', 'my__Modal');
	isAttribute(_section, 'class', 'modal__Container');

	//Continue create modal
	modalInner(_section, type);

	bgModal();
	removeInBody();

}

/**
 * @param  {[modal]}
 * @return {[Element]}
 */
 function modalInner(modal, type) {
 	var _div = createElement('div');
 	isAttribute(_div, 'class', 'modal__Container--Div card');
 	modalInfo(modal, _div, type);
 }


/**
 * @param  {[modal]}
 * @param  {[div]}
 * @return {[Modal]}
 */
 function modalInfo(modal, div, type) {


 	if(type) {

 		let _header = createElement('header');
 		isAttribute(div, 'class', 'modal__Header text-center');

 		let _h2  = createElement('h2');
 		isAttribute(_h2, 'class', 'modal__Header--Title m-0 text-muted');
 		_h2.innerHTML = 'Subir foto';

 		let content__Modal = createElement('form');
 		isAttribute(content__Modal, 'action', 'index.php?action=panel');
 		isAttribute(content__Modal, 'class', 'content__Modal p-4 mt-4 ');
 		isAttribute(content__Modal, 'method', 'post');
 		isAttribute(content__Modal, 'enctype', 'multipart/form-data');
 		isAttribute(content__Modal, 'id', 'js-form-figurita-photo');

 		let input__Hidden = createElement('input');
 		isAttribute(input__Hidden, 'type', 'hidden');
 		isAttribute(input__Hidden, 'name', 'figurita_photo');
 		isAttribute(input__Hidden, 'value', 'true');


 		let input__Hidden2 = createElement('input');
 		isAttribute(input__Hidden2, 'type', 'hidden');
 		isAttribute(input__Hidden2, 'name', 'idfigurita');
 		isAttribute(input__Hidden2, 'value', type);


 		var input_file = createElement('input');
 		isAttribute(input_file, 'type', 'file');
 		isAttribute(input_file, 'name', 'avatar');
 		isAttribute(input_file, 'class', 'form-control mb-3 js-file-citi');
 		isAttribute(input_file, 'required', 'true');

 		var input__Submit = createElement('input');
 		isAttribute(input__Submit, 'type', 'submit');
 		isAttribute(input__Submit, 'value', 'Subir Foto');
 		isAttribute(input__Submit, 'class', 'btn btn-warning js-btnsubmit-form form-control');



 		content__Modal.appendChild(input_file);
 		content__Modal.appendChild(input__Hidden);
 		content__Modal.appendChild(input__Hidden2);
 		content__Modal.appendChild(input__Submit);

 		_header.appendChild(_h2);
 		div.appendChild(_header);
 		div.appendChild(content__Modal);
 		appendModal(modal, div);


 	} else {

 		let _header = createElement('header');
 		isAttribute(div, 'class', 'modal__Header text-center');

 		let _h2  = createElement('h2');
 		isAttribute(_h2, 'class', 'modal__Header--Title m-0 text-muted');
 		_h2.innerHTML = 'Crea una figurita';

 		let content__Modal = createElement('form');
 		isAttribute(content__Modal, 'class', 'content__Modal p-4 mt-4 ');
 		isAttribute(content__Modal, 'id', 'js-form-figurita');


 		var select__Name = createElement('select');
 		isAttribute(select__Name, 'name', 'pais');
 		isAttribute(select__Name, 'class', 'form-control mb-3 js-select-citi');



 		var input__Name2 = createElement('input');
 		isAttribute(input__Name2, 'type', 'text');
 		isAttribute(input__Name2, 'class', 'form-control mb-3 js-input-name');
 		isAttribute(input__Name2, 'required', 'true');
 		isAttribute(input__Name2, 'placeholder', 'Nombre del jugador');

 		var input__Submit = createElement('input');
 		isAttribute(input__Submit, 'type', 'submit');
 		isAttribute(input__Submit, 'value', 'Crear Jugador');
 		isAttribute(input__Submit, 'class', 'btn btn-warning js-btnsubmit-form');

 		var options = '';
 		for (var i = 0; i < cities.length; i++) {
 			options+= '<option value="'+cities[i].name+'">'+cities[i].name+'</option>';
 		}

 		select__Name.innerHTML = options;

 		content__Modal.appendChild(select__Name);
 		content__Modal.appendChild(input__Name2);
 		content__Modal.appendChild(input__Submit);

 		_header.appendChild(_h2);

 		div.appendChild(_header);
 		div.appendChild(content__Modal);
 		appendModal(modal, div);
 		formSubmit();

 	}



 }


/**
 * @param  {[modal]}
 * @param  {[div]}
 * @return {[append body]}
 */
 function appendModal(modal, div) {
 	modal.appendChild(div);
 	d().body.appendChild(modal);
 }


/**
 * @return {[BG]}
 */
 function bgModal(){
 	var div = createElement('div');
 	isAttribute(div, 'class', 'bg__Modal');
 	d().body.appendChild(div);

 }

/**
 * @param  {[this]}
 * @return {[Append]}
 */
 function activeSearch(t) {

 	var _section_search = createElement('section');
 	isAttribute(_section_search, 'class', 'container__Search');
 	var form = getCss('form__Search');

 	form[0].appendChild(_section_search);

 }

/**
 * @param  {[this]}
 * @return {[remove]}
 */
 function removeSearch(t) {

 	var form = getCss('container__Search');
 	if(form) {
 		form[0].remove();
 	}

 }


 function changePreview(input) {

 	if (input.files && input.files[0]) {
 		var reader = new FileReader();

 		var pt = input.parentNode.parentNode;
 		var from = input.parentNode;

 		var css = getCss('figure__Sub');
 		css[0].style.backgroundImage = 'url("http://thinkfuture.com/wp-content/uploads/2013/10/loading_spinner.gif")';

 		setTimeout(function(){

 			reader.onload = function(e) {
 				var css = getCss('figure__Sub');
 				css[0].style.backgroundImage = 'url("'+e.target.result+'")';
 				var submit = getCss('js-send-image');
 				removeClass(submit, 'none');
 				from.style.display = 'block';
 				getCss('js-label')[0].style.display = 'none';
 			}

 			reader.readAsDataURL(input.files[0]);

 		}, 400);


 	}
 }





 function formSubmit() {

 	var form_new = getId('js-form-figurita');
 	form_new.addEventListener('submit', (e) => {

 		e.preventDefault();

 		var submitForm = getCss('js-btnsubmit-form');
 		submitForm[0].value = 'Cargando...';


 		let data = {
 			citi: getCss('js-select-citi')[0].value,
 			name: getCss('js-input-name')[0].value
 		}

 		let _article = createElement('article');
 		isAttribute(_article, 'class', 'article__Random col-lg-3 mb-4');


 		ajax({
 			method: 'POST',
 			url: 'index.php?action=ajax',
 			data: JSON.stringify(data),
 			type: 'json',
 			success: function(data) {
 				var pe = personTemplate(data.data);

 				_article.innerHTML = pe;

 				if(data.status){

 					getId('js-append-list').appendChild(_article);
 					getCss('bg__Modal')[0].remove();
 					getId('my__Modal').remove();

 					setTimeout(function(){
 						submitForm[0].value = 'Crear Jugador';
 						reAttribute(submitForm[0], 'disabled');

 					}, 450);

 				} 

 			}
 		});

 	});

 }

 function removeInBody() {

 	getCss('bg__Modal')[0].addEventListener('click', (e) => {

 		getCss('bg__Modal')[0].remove();
 		getId('my__Modal').remove();

 	});

 }

 function personTemplate(data) {

 	var person = '<div class="card p-2">'+
 	'<figure class="figure m-0">'+
 	'<img src="assets/img/avatar.png" alt="" class="w-100">'+
 	
 	'<div class="add__Figure" onclick="createModal('+data.id+'); return false;">'+
	'<i class="fas fa-camera text-muted"></i>'+
	'</div>'+
 	
 	'</figure>'+
 	'<header class="header text-center pt-2">'+
 	'<h3 class="m-0 font-weight-light">'+data.name+'</h3>'+
 	'<div class="flag text-center">'+
 	'<span class="text-muted small">'+data.citie+'</span>'+
 	'</div>'+
 	'<div class="detele-figurita" onclick="removeFiguritaPanel(this, 23);">'+
 	'<form action="index.php?action=panel" method="post">'+
 	'<input type="hidden" name="delete" value="true">'+
 	'<input type="hidden" name="id" value="'+data.id+'">'+
 	'<label for="borrar" class="tex-muted cursor">'+
 	'<i class="fas fa-trash text-muted"></i>'+
 	'</label>'+
 	'<input type="submit" id="borrar" class="none">'+
 	'</form>'+
 	'</div>'+
 	'</header>'+
 	'</div>';

 	return person;

 }


function removeFiguritaPanel(t, id) {

	var data = {
		id: id
	}


	ajax({
 			method: 'POST',
 			url: 'index.php?action=removeajax',
 			data: JSON.stringify(data),
 			type: 'json',
 			success: function(data) {

 				if(data.status){

 					var element = t.parentNode.parentNode.parentNode;
 					element.remove();

 				} 

 			}
 		});

}


