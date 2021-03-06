<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$active = '';
// Note. It is important to remove spaces between elements.
if (strpos($class,'active') !== false) {
$active = 'active';
}


$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';


if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}

$class = ' data-instant ';
$flink = $item->flink;
if ($item->deeper) {
	$class = 'data-toggle="dropdown" class="dropdown-toggle" data-instant ';
	//$linktype .= ' <span class="caret"></span>';
	$flink = '#';
} 

switch ($item->browserNav)
{
	default:
	case 0:
?><a class="list-group-item <?php echo $active; ?>" <?php echo $class; ?>href="<?php echo $flink; ?>" <?php echo $title; ?>><i class="<?php echo $item->anchor_css; ?>"></i><?php echo $linktype; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
	// window.open
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a>
<?php
		break;
}
