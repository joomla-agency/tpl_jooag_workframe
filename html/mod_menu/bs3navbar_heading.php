<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<?php $title = $item->title; ?>
<?php if (preg_match("/^divider/", $title, $treffer)):?>
	<span class="dropdown-header"><?php echo $item->title; ?></span>
<?php endif; ?>

<?php
 if (preg_match("/^mod/", $title, $treffer)){

	function getModuleById($moduleid, $params, $modulesList, $style) {
		$modtitle = $modulesList[$moduleid]->title;
		$modname = $modulesList[$moduleid]->module;
		if (JModuleHelper::isEnabled($modname)) {
			$module = JModuleHelper::getModule($modname, $modtitle);
			return JModuleHelper::renderModule($module);
		}
	}
	function modulesList() {
		$db = JFactory::getDBO();
		$query = "
			SELECT *
			FROM #__modules
			WHERE published=1
			ORDER BY id
			;";
		$db->setQuery($query);
		$modulesList = $db->loadObjectList('id');
		return $modulesList;
	}

	$itemTitle = $item->title; //z.B. mod||177
	$titleArray = explode('_', $itemTitle);
	
	$modulesList = modulesList();
	$moduleid = $titleArray[1];
	echo getModuleById($moduleid, $params, $modulesList, 'xhtml');

} 



?>