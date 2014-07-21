<?php
/**
 * Myprivate Notes
 * 
 * @package blesta
 * @subpackage blesta.plugins.Cloud_Backup
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class AdminMain extends StaffNotesController {
	
	/**
	 * Pre-action
	 */
	public function preAction() {
		parent::preAction();

		$this->requireLogin();
		Language::loadLang("staff_notes_plugin", null, PLUGINDIR . "staff_notes" . DS . "language" . DS);

		// Load required components/helpers
		$this->uses(array("staff_notes.StaffNotes"));        

        // Set the company ID
        $this->company_id = Configure::get("Blesta.company_id");
		// Set the plugin ID
		$this->plugin_id = (isset($this->get[0]) ? $this->get[0] : null);
		// Set the Staff ID
		$this->staff_id = $this->Session->read("blesta_staff_id");
	
	}
	
	/**
	 * Update this staff members private notes
	 */
	public function index() {
		$this->uses(array("Users"));

		$vars = array(); 

		// Update the users' info
		if (!empty($this->post)) {

			$errors = array();

			// Begin transaction
            $this->post["notes"] = $this->Users->systemEncrypt($this->post["notes"]);
			$this->StaffNotes->editNotes($this->staff_id, $this->post);
			$staff_errors = $this->StaffNotes->errors();

			$errors = $this->StaffNotes->errors();

			if (!empty($errors)) {

				$this->setMessage("error", $errors);
				$vars = (object)$this->post;
			}
			else {
				// Success, commit
				$this->flashMessage("message", Language::_("StaffNotesPlugin.!success.notes_updated", true));
				$this->redirect($this->base_uri);
			}
		}

		// Set my info notes
		if (empty($vars)) {
			$staff = $this->StaffNotes->getNotes($this->staff_id, $this->company_id);
            $staff->notes = $this->Users->systemDecrypt($staff->notes);
			$vars = (object)(array)$staff;
	 	}

		$this->set("vars", $vars);

		return $this->renderAjaxWidgetIfAsync();
	}	
}
?>