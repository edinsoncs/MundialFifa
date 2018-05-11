'use strict';

//Edinson Carranza Saldaña - Dev Full Stack

var a = 0;

/**
 * [d document]
 * @return {[document]}
 */
function d(){
	return document;
}

/**
 * @param  {[element]}
 * @param  {...[atributes]}
 * @return {Boolean}
 */
function isAttribute(element, ...atributes) {
	return element.setAttribute(atributes[0], atributes[1]);
}

function reAttribute(element, atribute) {
	return element.removeAttribute(atribute);
}


/**
 * @param  {id}
 * @return {[element]}
 */
var getId = (id) => {
	return d().getElementById(id);
}


/**
 * @param  {[css]}
 * @return {[element]}
 */
var getCss = (css) => {
	return d().getElementsByClassName(css);
}


/**
 * @param  {[element]}
 * @return {[create element]}
 */
var createElement = (element) => {
	return d().createElement(element);
}


/**
 * [removeClass is remove class in attribute]
 * @param  {[type]} element [description]
 * @return {[type]}         [description]
 */
var removeClass = (element, css) => {
	return element[0].classList.remove(css)
}







