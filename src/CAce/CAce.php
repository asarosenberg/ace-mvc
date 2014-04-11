<?php
/**
* Main class for Ace, holds everything.
*
* @package AceCore
*/
class CAce implements ISingleton {

	private static $instance = null;

	/**
	* Singleton pattern. Get the instance of the latest created object or create a new one.
	* @return CAce The instance of this class.
	*/
	public static function Instance() {
		if(self::$instance == null) {
			self::$instance = new CAce();
		}
		return self::$instance;
	}

	/**
	* Constructor
	*/
	protected function __construct() {
		# Include site specific config.php and create reference to $ace (used by config.php)
		$ace = &$this;
		require(ACE_SITE_PATH.'/config.php');
	}

	/**
	* Frontcontroller, check url and route to controllers.
	*/
	public function FrontControllerRoute() {

		# Take current url and divide it in controller, method and parameters
		$this->request = new CRequest();
		$this->request->Init($this->config['base_url']);

		$controller = $this->request->controller;
		$method     = $this->request->method;
		$arguments  = $this->request->arguments;

		# Check for callable method in controller class, check if enabled in config
		$controllerExists		= isset($this->config['controllers'][$controller]);
		$controllerEnabled		= false;
		$className				= false;
		$classExists			= false;

		if($controllerExists) {
			$controllerEnabled		= ($this->config['controllers'][$controller]['enabled'] == true);
			$className				= $this->config['controllers'][$controller]['class'];
			$classExists			= class_exists($className);
		}

		# Call if exists & is enabled
		if($controllerExists && $controllerEnabled && $classExists) {
			$rc = new ReflectionClass($className);
			if($rc->implementsInterface('IController')) {
				if($rc->hasMethod($method)) {
					$controllerObj = $rc->newInstance();
					$methodObj = $rc->getMethod($method);
					$methodObj->invokeArgs($controllerObj, $arguments);
				} else {
					die("404. " . get_class() . ' error: Controller does not contain method.');
				}
			} else {
				die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
			}
		}
		else {
			die('404. Page is not found.');
		}

	}
  
	/**
	* ThemeEngineRender, renders the reply of the request.
	*/
	public function ThemeEngineRender() {
		# Get paths and settings for theme
		$themeName		= $this->config['theme']['name'];
		$themePath		= ACE_INSTALL_PATH . "/themes/{$themeName}";
		$themeUrl		= $this->request->base_url . "themes/{$themeName}";

		# Add stylesheet path to $ace->data array
		$this->data['stylesheet'] = "{$themeUrl}/style.css";

		# Include global functions.php and theme functions.php
		$ace = &$this;
		$coreFunctionsPath = "{$themePath}/../functions.php";
		if(is_file($coreFunctionsPath)) {
			include $coreFunctionsPath;
		}		

		$functionsPath = "{$themePath}/functions.php";
		if(is_file($functionsPath)) {
			include $functionsPath;
		}

		# Extract $ace->data to own variables and handover to template file
		extract($this->data);     
		include("{$themePath}/default.tpl.php");
	}

}