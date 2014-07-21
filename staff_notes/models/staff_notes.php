<?php
/**
 * Myprivate Notes
 * 
 * @package blesta
 * @subpackage blesta.plugins.Cloud_Backup
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class StaffNotes extends StaffNotesModel {

	/**
	 * Initialize
	 */
	public function __construct() {
		parent::__construct();
		// Load required components/helpers
		Loader::loadComponents($this, array("Input", "Record"));		
	}
	
	/**
	* Fetches a staff member notes
	*
	* @param int $staff_id The ID of the staff member
	* @param int $company_id The ID of the company to set staff settings for (optional, if null, no settings will be set)
	* @return mixed An array of objects or false if no results.
	* @see Staff::getByUserId()
	*/
	public function getNotes($staff_id, $company_id=null) {
		$fields = array("staff.id", "staff.notes");
	 
		$staff = $this->Record->select($fields)->from("staff")->
		where("staff.id", "=", $staff_id)->fetch();
	 
		return $staff;
	}

	/**
	 * Updates the given staff member private notes
	 *
	 * @param int $staff_id The ID of the staff member to update
	 * @param array $vars An array of staff member info including
	 */
	public function editNotes($staff_id, array $vars) {
		$fields = array("notes");
		$this->Record->where("id", "=", $staff_id)->update("staff", $vars, $fields);
	}	

}
?>