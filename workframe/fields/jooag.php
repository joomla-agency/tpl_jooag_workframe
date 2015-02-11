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
 
class JFormFieldJooag extends JFormField {

	protected $type = 'jooag';
 
	public function getLabel() {
		//Let it be
	}
	
	public function getInput() {
		$doc = JFactory::getDocument();
		JHtml::_('formbehavior.chosen', 'select');
		$doc->addStyleSheet( JURI::root().'templates/joomla_agency3x/workframe/fields/joomla-backend.css' );
	}
}
?>