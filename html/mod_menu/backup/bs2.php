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
?>
<nav class="navbar navbar-default <?php echo $class_sfx;?>" role="navigation">
<div class="navbar-inner">
<div class="container">
	<a type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>

<?php $doc = JFactory::getDocument();
if ($doc->countModules ('brand')){
	echo '<a class="navbar-brand" href="/">';
		$renderer = $doc->loadRenderer('modules');
		$options = array('style'=>'raw');
		echo $renderer->render('brand',$options,null);
	echo '</a>';
}
?>
<div class="collapse nav-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav" <?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>

<?php
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		$class .= ' current';
	}

	if (in_array($item->id, $path)) {
		$class .= ' active';
	}
	elseif ($item->type == 'alias') {
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path)) {
			$class .= ' alias-parent-active';
		}
	}

	if ($item->deeper) {
		$class .= ' ';
	}

	if ($item->parent) {
		$class .= ' dropdown';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}
	
	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_menu', 'bs3_'.$item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'bs3_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul class="dropdown-menu" role="menu">';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li> ';
	}
endforeach;
?>
</ul>
<?php if ($doc->countModules( 'navbar-search' ) || $doc->countModules( 'navbar-login' ) || $doc->countModules( 'navbar-icon-search' ) || $doc->countModules( 'navbar-icon-login' )|| $doc->countModules( 'menu-right' )) :?>
<ul class="nav pull-right">
	<?php if ($doc->countModules( 'menu-right' )) :?>
		<?php
		$renderer = $doc->loadRenderer('modules');
		echo $renderer->render('menu-right');
		?>
	<?php endif;?>
	
	<?php if ($doc->countModules( 'navbar-search' )) :?>
	<li class="dropdown">
		<?php
		$renderer = $doc->loadRenderer('modules');
		echo $renderer->render('navbar-search');
		?>
	</li>
	<?php endif;?>
	
	<?php if ($doc->countModules( 'navbar-icon-search' )) :?>
	<li class="dropdown">
	  <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-search icon-white"></i></a>
	  <ul class="dropdown-menu mod-menu">
		<li>
			<?php
			$renderer = $doc->loadRenderer('modules');
			echo $renderer->render('navbar-icon-search');
			?>
		</li>
	  </ul>
	</li>
	<?php endif;?>
	
	<?php if ($doc->countModules( 'navbar-icon-login' )) :?>
	<li class="dropdown">
	  <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-lock icon-white"></i></a>
	  <ul class="dropdown-menu mod-menu">
		<li>
			<?php
			$renderer = $doc->loadRenderer('modules');
			echo $renderer->render('navbar-icon-login');
			?>
		</li>
	  </ul>
	</li>
	<?php endif;?>
</ul>

<?php endif;?>
</div></div></div></div>
</nav>
