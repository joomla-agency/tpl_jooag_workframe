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
function jooagTutorialMode(){
	$doc = JFactory::getDocument();
	if($doc->params->get('tutorialMode')){
		echo '
			<div class="alert alert-danger text-center">
				<strong>Tutorial Mode</strong>
			</div>';
	}
}

function tutorial($position){
	$doc = JFactory::getDocument();
	$app = JFactory::getApplication();
	static $countTutorial = '0';
	$countPositions = '0';
	if($doc->params->get('tutorialMode')){
		if (!$doc->countModules( 'logo' ) and $position == 'logo'){
			$countTutorial++;
			$countPositions++;
			echo '
			<div class="container">
				<div class="alert alert-info">
					<h4>You need a Logo Module</h4>
					<ol>
						<li>Go to Joomla Admin -> Extensions -> Module Manager</li>
						<li>Klick on New</li>
						<li>Choose "Custom HTML"</li>
						<li>Use a title e.g. "Logo"</li>
						<li>Set "Show Title" to Hide</li>
						<li>Set a image in text area</li>
						<li>Choose the Module Position "Logo"</li>
					</ol>
				</div>
			</div>';
		}
		if (!$doc->countModules( 'menu' ) and $position == 'menu'){
			$countTutorial++;
			$countPositions++;
			echo '
			<div class="container">
				<div class="alert alert-info">
					<h4>You need a Menu Module</h4>
					<ol>
						<li>Go to Joomla Admin -> Extensions -> Module Manager</li>
						<li>Click on Module "Main Menu"</li>
						<li>Change position from "position-7" to "menu"</li>
						<li>Set "Show Title" to Hide</li>
						<li>Change by the Tab "Advanced" the option alternative Layout from "default" to "bs3"</li>
					</ol>
				</div>
			</div>';
		}

		if ($doc->countModules( 'menu' ) and $position == 'menu' and count($app->getMenu()->getItems('alias', true)) == 1){
			$countTutorial++;
			$countPositions++;
			echo '
			<div class="container">
				<div class="alert alert-info">
					<h4>Add your first own Content and Menu Item</h4>
					<h5><strong>Add Article</strong></h5>
					<ol>
						<li>Go to Joomla Admin -> Content -> Article Manager -> Add new Article</li>
						<li>Fill out the Title (e.g. Test) and Text Field</li>
						<li>Choose the Category "Uncategorized"</li>
						<li>Set "Show Title" to Hide</li>
						<li>Change by the Tab "Advanced" the option alternative Layout from "default" to "bs3"</li>
					</ol>
					<h5><strong>Add Menu Item</strong></h5>
					<ol>
						<li>Go to Joomla Admin -> Menus -> Main Menu -> Add new Menu Item</li>
						<li>Fillout Menu Title (e.g. Test)</li>
						<li>Click on select by "Menu Item Type" and choose Articles -> Single Article</li>
						<li>Click on select by "Select Article" and choose an Article (e.g. test)</li>
						<li>Now Save and close</li>
					</ol>
				</div>
			</div>';
		}

		if($countTutorial == '0' and $position == 'footer'){
			echo '
			<div class="container">
				<div class="alert alert-success">
					<h4>Conguraltion - you solved the Tutorial</h4>
					<ol>
						<li>Go to Joomla Admin -> Extension -> Template Manager </li>
						<li>Open the joomla_agency3x template</li>
						<li>Goto "Additional Functions" Tab and set "Tutorial Mode" to disabled</li>
					</ol>
				</div>
			</div>';
		}
	}
}
?>