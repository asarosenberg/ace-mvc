<?php
/**
* Helpers for theming, available for all themes in their template files and functions.php.
* This file is included right before the themes own functions.php
*/

/**
* Create url by prepending base_url
*/
function base_url($url) {
	return CAce::Instance()->request->base_url . trim($url, '/');
}

/**
* Return current url
*/
function current_url() {
	return CAce::Instance()->request->current_url;
}

function easter() {
	return "It's easter!";
}