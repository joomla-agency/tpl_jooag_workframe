<?php
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addScript( JURI::base().'templates/'.$doc->template.'/'.'workframe/fullpagejs/jquery.easings.min.js' );
$doc->addScript( JURI::base().'templates/'.$doc->template.'/'.'workframe/fullpagejs/jquery.fullPage.min.js' );
$doc->addScript( JURI::base().'templates/'.$doc->template.'/'.'workframe/fullpagejs/jquery.slimscroll.min.js' );


$doc->addScriptDeclaration( '$(document).ready(function() {$(".page-home").fullpage({anchors: [".wrapper-mod-id-210", ".wrapper-mod-id-203", ".wrapper-mod-id-208"],navigation: true,navigationPosition: "right"});});' );
?>