<?php
/**
 * Myprivate Notes
 * 
 * @package blesta
 * @subpackage blesta.plugins.Cloud_Backup
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class StaffNotesPlugin extends Plugin {

	public function __construct() {
		Language::loadLang("staff_notes_plugin", null, dirname(__FILE__) . DS . "language" . DS);
		
		// Load components required by this plugin
		Loader::loadComponents($this, array("Input", "Record"));
		
        // Load modules for this plugun
        Loader::loadModels($this, array("ModuleManager"));
		$this->loadConfig(dirname(__FILE__) . DS . "config.json");
	}
	
	/**
	 * Performs any necessary bootstraping actions
	 *
	 * @param int $plugin_id The ID of the plugin being installed
	 */
	public function install($plugin_id) {	
			
		// Add the system overview table, *IFF* not already added
		try {
			$this->Record->
				 setField("notes", array('type' => "text", 'after' => "email_mobile"))->
				 alter("staff");

			
		}
		catch(Exception $e) {
			// Error adding... no permission?
			$this->Input->setErrors(array('db'=> array('alter'=>$e->getMessage())));
			return;
		}
	}
	
    /**
     * Performs migration of data from $current_version (the current installed version)
     * to the given file set version
     *
     * @param string $current_version The current installed version of this plugin
     * @param int $plugin_id The ID of the plugin being upgraded
     */
	public function upgrade($current_version, $plugin_id) {
		
		// Upgrade if possible
		if (version_compare($this->getVersion(), $current_version, ">")) {
			// Handle the upgrade, set errors using $this->Input->setErrors() if any errors encountered
		}
	}
	
    /**
     * Performs any necessary cleanup actions
     *
     * @param int $plugin_id The ID of the plugin being uninstalled
     * @param boolean $last_instance True if $plugin_id is the last instance across all companies for this plugin, false otherwise
     */
	public function uninstall($plugin_id, $last_instance) {
		$sql_load =" ALTER TABLE `staff` DROP COLUMN `notes` ";	
		$this->Record->query($sql_load);
 
	}

	
	/**
	 * Returns all actions to be configured for this widget (invoked after install() or upgrade(), overwrites all existing actions)
	 *
	 * @return array A numerically indexed array containing:
	 * 	-action The action to register for
	 * 	-uri The URI to be invoked for the given action
	 * 	-name The name to represent the action (can be language definition)
	 */
	public function getActions() {
		return array(
			array(
				'action'=>"widget_staff_home",
				'uri'=>"widget/staff_notes/admin_main/",
				'name'=>Language::_("StaffNotesPlugin.name", true)
			)
		);
	}
}
?>