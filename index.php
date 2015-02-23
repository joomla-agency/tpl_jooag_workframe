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
require_once __DIR__ . '/workframe/workframe.php';
require_once __DIR__ . '/workframe/workframe-tutorial.php';
?>
<!doctype html>
<html xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>		
		<jdoc:include type="head" />
		<?php
		jooagHead();
		jooagJS('top');
		?>	
	</head>
	<body class="<?php jooagPageClass(); ?>">
		<?php
		jooagTutorialMode();
		modules('overMain');
		column(); 
		modules('underMain'); 
		jooagJS('bottom');
		executeAddon('instantclick');
		?>
	</body>
</html>
