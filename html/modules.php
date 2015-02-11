<?php
defined('_JEXEC') or die;
### Joomla Template - Workframe
### www.joomla-agentur.de
?>
<?php
function modChrome_jooag( $module, &$params, &$attribs){
//Variablen
	$doc = JFactory::getDocument();
	$modCountSum = $doc->countModules($attribs['name']);
	$key = $attribs['key'];
	
//Subtitle for Module Title	
	$moduleTitle = explode("||", $module->title);

// Module Style
	$setStyle =	(strpos($attribs['modStyle'], 'panel') !== false) ? true : false;

//3. Priority = Global Cols a Row
	if($params->get('bootstrap_size') == 0){$colOutput = 12 / $modCountSum;}
	if($modCountSum >= $attribs['modPerRow']){$colOutput = 12 / $attribs['modPerRow'];}
	
//2. Priority = In Module Settings
	if($params->get('bootstrap_size') != 0){$colOutput = $params->get('bootstrap_size');}
	
//1. Priority = Custom Cols Setting in Template Parameter 
	static $counter = 0;
	$modCustomCols = $attribs['modCustomCols'];
    if ($modCustomCols){
		$modCustomCols = explode (",",array_fill(0, 12, $attribs['modCustomCols']));
		$colOutput = $modCustomCols[$counter];
	}
	$counter++;
	if($modCountSum == $counter){$counter = 0;}
	
	$colOutput = $attribs['colPrefix'].$colOutput;
	
	$headerTag = $params->get('header_tag');
	if(!$params->get('header_tag')){
	 $headerTag = 'h3';
	}
	
//Output
	$divCount = 0;
	if($attribs['modWrapperEach'] == 1){
		echo '<div class="wrapper wrapper-'.$module->position.' wrapper-mod-id-'.$module->id.'">';
		echo '<div class="container container-'.$module->position.'">';
		echo '<div class="row row-mod-id-'.$module->position.'">';
		$divCount = $divCount + 3;
	}

	if($attribs['showcol'] == 1){
		echo '<div class="'.$colOutput.' '.$attribs['modVisions'].' '.$module->position.' mod-id-'.$module->id.' module">';
		echo '<div class="mod-output clearfix '.$attribs['modStyle'].' '.$params->get('moduleclass_sfx').'">';
		$divCount = $divCount + 2;
	}

	if ($module->showtitle){
		if($setStyle == true){
			echo '<div class="panel-heading">';
				echo $moduleTitle[0];
				if(!empty($moduleTitle[1])){echo '<span>'.$moduleTitle[1].'</span>';}
			echo '</div>';
		}
		if($setStyle == false){echo '<'.$headerTag.' class="headings">'.$moduleTitle[0].'</'.$headerTag.'>';}
	}
				
	if($setStyle == true){
		echo '<div class="panel-body">';
		$divCount++;
	}
	
	echo $module->content;

	for ($i = 1; $divCount >= $i; $i++) {
		echo '</div>';
	}
}
?>