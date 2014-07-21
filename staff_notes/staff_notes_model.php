<?php
/**
 * Myprivate Notes
 * 
 * @package blesta
 * @subpackage blesta.plugins.Cloud_Backup
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class StaffNotesModel extends AppModel {
	
	public function __construct() {
		// Load required components/helpers
		Loader::loadComponents($this, array("Input", "Record"));
		// Loader::loadHelpers($this, array("Date"));
	}
}
?>