<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

# Error reporting
error_reporting(-1);
ini_set('display_errors', 1);

# Session name
$ace->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

# Server timezone
$ace->config['timezone'] = 'Europe/Stockholm';

# Internal character encoding
$ace->config['character_encoding'] = 'UTF-8';

# Language
$ace->config['language'] = 'en';

# Set base_url to other than default
$ace->config['base_url'] = null;

/**
* What type of urls should be used?
*
* default      = 0      => index.php/controller/method/arg1/arg2/arg3
* clean        = 1      => controller/method/arg1/arg2/arg3
* querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
*/
$ace->config['url_type'] = 1;

	
/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example:
* the url 'developer/dump' would instantiate the controller with the key "developer", that is
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $ace->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
*/
$ace->config['controllers'] = array(
	'index'			=> array('enabled' => true,'class' => 'CCIndex'),
	'developer'		=> array('enabled' => true,'class' => 'CCDeveloper')
);

# Theme settings (name of theme in the theme dir)
$ace->config['theme'] = array(
	'name'	=> 'core',
);