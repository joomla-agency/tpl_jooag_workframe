<?php
defined('_JEXEC') or die;
/**
* @version			3.3
* @package			joomla_agency3x
* @author			Joomla Agentur (Ufuk Avcu)
* @website			http://www.joomla-agentur.de | http://www.joomla-agency.de
* @copyright		Copyright (c) 2009 - 2015 Joomla-Agentur All rights reserved.
* @license 			GNU General Public License version 2 or later;
* @description 		A modern and flexible Template for Joomla 3.3+
*/
?>
<?php
jimport('joomla.form.formfield');
 
class JFormFieldModvisions extends JFormField {
 
	protected $type = 'Modvisions';
 
	public function getInput() {
		return '<select id="'.$this->id.'" name="'.$this->name.'" multiple>'.
					'<option value="visible-xs">visible-xs</option>'.
					'<option value="visible-sm">visible-sm</option>'.
					'<option value="visible-md">visible-md</option>'.
					'<option value="visible-lg">visible-lg</option>'.
					'<option value="hidden-xs">hidden-xs</option>'.
					'<option value="hidden-sm">hidden-sm</option>'.
					'<option value="hidden-md">hidden-md</option>'.
					'<option value="hidden-lg">hidden-lg</option>'.
			   '</select>';
	}
}
?>