<?php
/**
* Helpers for the template file.
*/
$ace->data['header'] = '<h1>Ace</h1>';
if ( empty($ace->data['main']) ) {
	$ace->data['main']   = '<p>Detta är default innehåll som visas om det inte skall visas något annat. Kolla in <a href="'.$ace->request->CreateUrl('developer').'">developer</a></p>';
}
$ace->data['footer'] = '<p>&copy; Ace by Åsa Rosenberg (asa@dotnordic.se) | <a href="'.$ace->request->CreateUrl('../source.php').'">SOURCE.PHP</a></p>';


/**
* Print debuginformation from the framework.
*/
function get_debug() {
$ace = CAce::Instance();
$html = "<div class=\"debug\"><h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($ace->config, true)) . "</pre>";
$html .= "<p>The content of the data array:</p><pre>" . htmlentities(print_r($ace->data, true)) . "</pre>";
$html .= "<p>The content of the request array:</p><pre>" . htmlentities(print_r($ace->request, true)) . "</pre>";
$html .= "</div>";
return $html;
}