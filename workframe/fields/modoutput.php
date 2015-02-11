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
 
class JFormFieldModoutput extends JFormField {
 
	protected $type = 'Modoutput';
 
	public function getInput() {
		return '<select id="'.$this->id.'" name="'.$this->name.'" multiple>'.
					'<option value="col">col</option>'.
					'<option value="row">row</option>'.
					'<option value="container">container</option>'.
					'<option value="wrapper">wrapper</option>'.
					'<option value="wrapper-each">wrapper-each</option>'.
			   '</select>';
	}
}
?>