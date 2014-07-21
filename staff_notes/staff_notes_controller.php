<?php
/**
 * Myprivate Notes
 * 
 * @package blesta
 * @subpackage blesta.plugins.Cloud_Backup
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class StaffNotesController extends AppController {

	public function preAction() {
		parent::preAction();		
		// Override default view directory
		$this->view->view = "default";
		// $this->structure->view = "default";
	}
}
?>