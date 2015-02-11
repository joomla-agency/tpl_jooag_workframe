<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$doc = JFactory::getDocument();
// Note. It is important to remove spaces between elements.
?>
<div class="list-group">
<?php
foreach ($list as $i => &$item)
{
	//$class = 'item-' . $item->id;
	$class="";

	if ($item->id == $active_id)
	{
		//$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type == 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type == 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' dropdown';
	}

	if ($item->parent)
	{
		//$class .= ' parent';
	}

	if (!empty($class))
	{
		$class = ' class="' . trim($class) . '"';
	}

	

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'bs3sidenav_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'bs3sidenav_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="dropdown-menu" role="menu">';
	}
	elseif ($item->shallower)
	{
		// The next item is shallower.
		echo '';
		echo str_repeat('', $item->level_diff);
	}
	else
	{
		// The next item is on the same level.
		echo '';
	}
}
?></div>

<?php if ($doc->countModules( 'menu-right' )) :?>
	<?php
	$renderer = $doc->loadRenderer('modules');
	echo $renderer->render('menu-right');
	?>
<?php endif;?>