<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
		$item->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { $linktype = $item->title;
}

?>

<?php
if (preg_match("/divider/i", $linktype)) {
	echo '<div class="divider"></div>';
}

if (preg_match("/navheader/i", $linktype)) {   
	$result = preg_replace('`\[[^\]]*\]`','',$item->title);
	echo '<div class="nav-header">'.$result.'</div>';
}

if (preg_match("/headerdiv/i", $linktype)) { 
	echo '<div class="divider"></div>';
	$result = preg_replace('`\[[^\]]*\]`','',$item->title);
	echo '<div class="nav-header">'.$result.'</div>';
}
?>

















