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
$doc = JFactory::getDocument();
$app = JFactory::getApplication();
$templateDir = $doc->baseurl.'/templates/'.$doc->template;

//Addons::Start
function executeAddon($functionName){
	$doc = JFactory::getDocument();
	$xmlName = $functionName.'-menu';
	$menus = JFactory::getApplication()->getMenu();
	$menu  = $menus->getActive();
	$directory = JURI::base().'templates/'.$doc->template.'/workframe/'.$functionName.'/';
	if((in_array($menu->id, (array)$doc->params->get("$xmlName")) or !$doc->params->get("$xmlName")) and $doc->params->get("$functionName")){
		$functionName($doc, $directory);
	}
}

//Addons::Masonry
function masonry($doc, $directory){
	$doc->addScript($directory.'masonry.pkgd.min.js');
	$doc->addScriptDeclaration('$(function(){$("#itemListLeading").masonry({itemSelector : ".col-md-4" });});');
}
executeAddon('masonry');
//Addons::eqHeight
function eqheight($doc, $directory){
	$doc->addScript($directory.'jquery.eqheight.js');
	$doc->addScriptDeclaration( 'jQuery(document).ready(function(){jQuery(".eqheight").eqHeight();});' );
}
executeAddon('eqheight');
//Addons::InstantClick
function instantclick($doc, $directory){
	$doc->addScript($directory.'instantclick.min.js');
	echo '<script data-no-instant>InstantClick.init(true);</script>';
}

//Addons::FontAwesome
function fontawesome($doc, $directory){
	$doc->addStyleSheet($directory.'css/'.$doc->params->get('loadFontAwesome-fixes')); 
}
executeAddon('fontawesome');
//Addons::CounterUp
function counterup($doc, $directory){
	$doc->addScript($directory.'jquery.counterup.min.js');
	$doc->addScript($directory.'waypoint.js');
	$doc->addScriptDeclaration( 'jQuery(document).ready(function(){$(".counter").counterUp({delay: 10, time: 3000});});' );
}
executeAddon('counterup');
//Addons::Parallax
function parallax($doc, $directory){
	$doc->addScript($directory.'parallax.min.js');
	$doc->addScriptDeclaration( 'jQuery(".wrapper-mod-id-210").parallax({imageSrc: "'.JURI::base().'templates/joomla_agency3x/img/stars.jpg"});' );
}
executeAddon('parallax');
//Addons::End

//CSS
if($doc->params->get('loadBootstrapCss-fixes') and $doc->params->get('loadBootstrapCss-fixes') != '-1'){
	$doc->addStyleSheet( $templateDir.'/workframe/bootstrap3/css/'.$doc->params->get('loadBootstrapCss-fixes')); 
}

if($doc->params->get('loadBootstrapTheme-fixes') and $doc->params->get('loadBootstrapTheme-fixes') != '-1'){
	$doc->addStyleSheet( $templateDir.'/workframe/bootstrap3/css/'.$doc->params->get('loadBootstrapTheme-fixes')); 
}

if($doc->params->get('bootswatch') and $doc->params->get('bootswatch') != '-1'){
	$doc->addStyleSheet( $templateDir.'/workframe/bootswatch/'.$doc->params->get('bootswatch')); 
}

$doc->addStyleSheet( $templateDir.'/workframe/workframe/workframe-frontend.css' );
$doc->addStyleSheet( $templateDir.'/css/custom.css' );

//Bootstrap3
JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');

if($doc->params->get('googlefonts')){
	$menus = JFactory::getApplication()->getMenu();
	$menu = $menus->getActive()->id;
	
	$gf = json_decode($doc->params->get('googlefonts'), true);

	$gfkey = 0;
	foreach($gf['gflink'] as $fonts){
		if(in_array($menu, (array)$gf['gfmenu']["$gfkey"]) or !$gf['gfmenu']["$gfkey"]){
			$doc->addStyleSheet($fonts);
		}
		$gfkey++;
	}
}

function modules($renderPosition){
	$doc = JFactory::getDocument();
	$md[$renderPosition] = '';
	$md = json_decode($doc->params->get($renderPosition), true);
	
	if($doc->params->get('debugmode')){
		echo '<pre><h3>Stored JSON Data in DB: ['.$renderPosition.']</h3>';
		print_r ($doc->params->get($renderPosition));
		echo '</pre>';
	}
	
	if(array_search('eqheight', $md['modEqualHeight'])){
		executeAddon('eqheight');
	}
	$key = '0';
	$modVisions = '';
	if($md['modVisions'][$key]){
		$modVisions = implode(' ',$md['modVisions'][$key]);
	}
	foreach($md['modnameunderMainArea'] as $position){
		
		if(!$md['modOutput'][$key]){ $md['modOutput'][$key][0] = 'empty';}
		
		$divCount = 0;
		$modWrapperEach = 0;
		if(in_array('wrapper-each', $md['modOutput'][$key])){$modWrapperEach = '1';}
				
		if ($doc->countModules( $position )){
			if(in_array('wrapper', $md['modOutput'][$key])){echo '<div class="wrapper wrapper-'.$position.'">';$divCount++;}
			if(in_array('container', $md['modOutput'][$key])){echo '<div class="container container-'.$position.'">';$divCount++;}
			if(in_array('row', $md['modOutput'][$key])){echo '<div class="row row-'.$position.' '.$md['modEqualHeight'][$key].'">';$divCount++;}
			

			if (!$doc->countModules( $position ) and $doc->params->get('showModulePositions')){
				echo '<div class="alert alert-warning">Module Position: ['.$position.']</div>';
			}
			
			$viewCol = '0';
			if(in_array('col', $md['modOutput'][$key])){$viewCol = '1';}
			
			echo '<jdoc:include type="modules" style="jooag"'.
				'name="'.$position.'" '.
				'key="'.$key.'" '.
				'modPerRow="'.$md['modPerRow'][$key].'" '.
				'colPrefix="'.$md['colPrefix'][$key].'" '.
				'modStyle="'.$md['modStyle'][$key].'" '.
				'modCustomCols="'.$md['modCustomCols'][$key].'" '.
				'modVisions="'.$modVisions.'" '.
				'modWrapperEach="'.$modWrapperEach.'" '.
				'showcol="'.$viewCol.'" />';
		}		
		
		for ($i = 1; $divCount >= $i; $i++) {
				echo '</div>';
		}
		$key++;
	}

	if($doc->params->get('tutorialMode')){
		tutorial($position);
	}
}

function column(){
	$doc = JFactory::getDocument();
	$mainCenterGrid = 12;
	$leftCount = 0;
	$rightCount = 0;
	$showModulePositions = $doc->params->get('showModulePositions');

	$moduleDataLeft = json_decode($doc->params->get('leftContent'), true);
	$moduleDataRight = json_decode($doc->params->get('rightContent'), true);

	foreach($moduleDataLeft['modnameunderMainArea'] as $position){
		if ($doc->countModules ($position) or $showModulePositions == '1'){$mainCenterGrid = $mainCenterGrid - $doc->params->get('leftCol-module');$leftCount = 1;break;}
	}

	foreach($moduleDataRight['modnameunderMainArea'] as $position){
		if ($doc->countModules ($position) or $showModulePositions == '1'){$mainCenterGrid = $mainCenterGrid - $doc->params->get('rightCol-module');$rightCount = 1;break;}
	}

	if ($doc->params->get('width-component') != '0'){ $mainCenterGrid = $doc->params->get('width-component');}

	$spanNumberLeft = $doc->params->get('leftCol-module');
	$spanNumberRight = $doc->params->get('rightCol-module');

	$comOutput = $doc->params->get('comOutput');

	if($doc->params->get('debugmode')){
		echo '<pre><h3>Stored JSON Data in DB: [Component]</h3>';
		print_r ($doc->params->get('mainarea'));
		echo '</pre>';
	}

	$key = '0';
	$menus = JFactory::getApplication()->getMenu();
	$menu = $menus->getActive()->id;
	if(!in_array($menu, (array)$doc->params->get('columnActive'))){
		if(in_array('wrapper', $comOutput)){ echo '<div class="wrapper wrapper-column">'; }
			if(in_array('container', $comOutput)){ echo '<div class="container container-column">';}
				if(in_array('row', $comOutput)){ echo '<div class="row row-column">';}
					
					if ($leftCount == '1'){
						echo '<aside class="'.$moduleDataLeft['colPrefix'][$key].$spanNumberLeft.' left-position module side">';
							modules('leftContent');
						echo '</aside>';
					}
					
					echo '<main class="'.$doc->params->get('colPrefixCompoenent').$mainCenterGrid.' col-md-offset-'.$doc->params->get('offset-component').' main-area">';
						modules('overContent'); 
							echo '<div class="component-area">';
								if(!in_array($menu, (array)$doc->params->get('componentActive'))){
									echo '<jdoc:include type="component" />';
								}
							echo '</div>';
						modules('underContent'); 
					echo '</main>';
					
					if ($rightCount == '1'){
						echo '<aside class="'.$moduleDataRight['colPrefix'][$key].$spanNumberRight.' right-position module side">';
							modules('rightContent');
						echo '</aside>';
					}
				if(in_array('row', $comOutput)){ echo '</div>';} 
			if(in_array('container', $comOutput)){ echo '</div>';}
		if(in_array('wrapper', $comOutput)){ echo '</div>';}
	}	
}

function jooagPageClass(){
	$doc = JFactory::getDocument();
	$app = JFactory::getApplication();
	$getMenu = $app->getMenu();
	$suffixSettings = $doc->params->get('componentClassSuffix-fixes');
	
	if (in_array("menualias", (array)$suffixSettings)){
		
		if($getMenu->getActive()->alias){
			echo 'subpage-'.$getMenu->getActive()->alias.' ';
			echo 'page-'.$getMenu->getItem($getMenu->getActive()->tree[0])->alias.' ';
		}
	}

	if (is_object($getMenu->getActive())){echo ' '.$getMenu->getActive()->params->get('pageclass_sfx');}
	
	if (in_array("logged", (array)$suffixSettings)) {
		$user = JFactory::getUser();
		if ($user->guest){echo "logged-out ";}
		if (!$user->guest){echo "logged-in ";}
	}
	
	if (in_array("column", (array)$suffixSettings)) {
		if($doc->countModules('left')){echo "module-left ";}
		if($doc->countModules('right')){echo "module-right ";}
	}
	
	if (in_array("component", (array)$suffixSettings)) {
		echo $app->input->getCmd('option', '').' ';
	}
	
	if (in_array("pageid", (array)$suffixSettings)) {
		echo  'pageid-'.JRequest::getInt('id').' ';
	}
	
	if (in_array("menuid", (array)$suffixSettings)) {
		echo 'menuid-'.$app->input->getCmd('Itemid', '').' ';
	}
	
	if (in_array("language", (array)$suffixSettings)) {
		$language = JFactory::getLanguage();
		echo 'lang-'.$language->getTag().' ';
	}
	if (in_array("ltrrtl", (array)$suffixSettings)) {
		echo $doc->direction;
	}
}

//Unset js
$unsetjs = $doc->params->get('unsetJs');
foreach((array)$unsetjs as $js){
	unset( $doc->_scripts[JURI::base( true ).$js] );
}

//Favicon
if(!$doc->params->get('favicon-generalSettings')){
	echo '<link rel="shortcut icon" href="'.JURI::base().'templates/'.$doc->template.'/'.'workframe/workframe/favicon.png">';
}else{
	echo '<link rel="shortcut icon" href="'.$doc->params->get('favicon-generalSettings').'">';
}

//Apple Favicon
if(!$doc->params->get('appletouch-generalSettings')){
	echo '<link rel="apple-touch-icon" href="'.JURI::base().'templates/'.$doc->template.'/'.'workframe/workframe/apple-touch-icon-precomposed.png">';
}else{
	echo '<link rel="apple-touch-icon" href="'.$doc->params->get('appletouch-generalSettings').'">';
}

//IE Fix
if($doc->params->get('jooagMetaXua')== '1'){
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
}

//Generator Tag
if($doc->params->get('jooagSetGenerator') == '0'){
	$doc->setGenerator(null);
}
if($doc->params->get('jooagSetGenerator') == '2'){
	$doc->setGenerator($doc->params->get('jooagSetGeneratorCustom'));
}

//Javascript injection
function jooagJS($position){
	$doc = JFactory::getDocument();
	
	if($position == 'top'){
		$doc->addScript( $doc->baseurl.'/templates/'.$doc->template.'/js/custom.js' );
	}	
	
	if($position == 'bottom'){
		echo $doc->params->get('googleAnalytics');
		echo $doc->params->get('piwik');
		echo $doc->params->get('googleVerification');
	}
}

// Responsive Mode
if($doc->params->get('responsiveMode') == 0){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	$doc->addStyleDeclaration( '.container{width:'.$doc->params->get("containerWidth").';}' );
}

//Set Href Lang for single Language Sites
if($doc->params->get('setHrefLang')){
	$language = JFactory::getLanguage();
	$language = substr($language->getTag(), 0, 2);
	$doc->addHeadLink( JURI::base() , 'alternate', 'rel', array('hreflang' => $language));
}
?>