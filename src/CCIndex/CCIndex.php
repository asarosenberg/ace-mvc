<?php
/**
* Standard controller layout.
*
* @package AceCore
*/
class CCIndex implements IController {

	/**
	* Implementing interface IController. All controllers must have an index action.
	*/
	public function Index() {   
		global $ace;
		$ace->data['title'] = "The Index Controller";
	}

}