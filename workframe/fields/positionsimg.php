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
 
class JFormFieldPositionsimg extends JFormField {

	protected $type = 'positionsimg';

	public function getLabel() {//Don't show a label
	}
	
	public function getInput() {
		$output ='
			<style>
			.img-absolute{position:absolute;right:0;}
			</style>
			<div class="img-absolute hidden-phone">
				<img src="../templates/joomla_agency3x/workframe/img/positions.png" alt="positions" class="hidden-phone">
			</div>	
			';
			return $output;
	}
}
?>