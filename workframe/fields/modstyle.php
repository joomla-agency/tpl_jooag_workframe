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
 
class JFormFieldModstyle extends JFormField {
 
	protected $type = 'Modstyle';
 
	public function getInput() {
		return '<select id="'.$this->id.'" name="'.$this->name.'">'.
					'<option value="raw">Raw</option>'.
					'<option value="well">well</option>'.
					'<option value="alert alert-success">alert-success</option>'.
					'<option value="alert alert-info">alert-info</option>'.
					'<option value="alert alert-warning">alert-warning</option>'.
					'<option value="alert alert-danger">alert-danger</option>'.
					'<option value="panel panel-default">panel-default</option>'.
					'<option value="panel panel-primary">panel-primary</option>'.
					'<option value="panel panel-success">panel-success</option>'.
					'<option value="panel panel-info">panel-info</option>'.
					'<option value="panel panel-warning">panel-warning</option>'.
					'<option value="panel panel-danger">panel-danger</option>'.
			   '</select>';
	}
}
?>