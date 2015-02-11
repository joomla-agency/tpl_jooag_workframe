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
 
class JFormFieldModperrow extends JFormField {
 
	protected $type = 'Modperrow';

	// getLabel() left out

	public function getInput() {
		return '<select id="'.$this->id.'" name="'.$this->name.'">'.
					'<option value="1">1</option>'.
					'<option value="2">2</option>'.
					'<option value="3">3</option>'.
					'<option value="4">4</option>'.
					'<option value="6">6</option>'.
					'<option value="12">12</option>'.
				'</select>';
	}
}
?>