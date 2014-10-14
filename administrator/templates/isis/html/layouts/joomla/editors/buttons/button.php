<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$button = $displayData;

if ($button->get('name'))
{
	$class    = ($button->get('class')) ? $button->get('class') : null;
	$class   .= ($button->get('modal')) ? ' modal-button' : null;
	$href     = ($button->get('link')) ? ' href="' . JUri::base() . $button->get('link') . '"' : null;
	$onclick  = ($button->get('onclick')) ? ' onclick="' . $button->get('onclick') . '"' : ' onclick="IeCursorFix(); return false;"';
	$title    = ($button->get('title')) ? $button->get('title') : $button->get('text');


	if ($button->get('modal'))
	{
		// Load modal popup behavior
		JHtml::_('bootstrap.modal');

		$tmptitle = str_replace(' ', '', strtolower(htmlspecialchars($title)));
		echo JHtmlBootstrap::renderModal($tmptitle . 'Modal', array('url' => JUri::base() . $button->get('link'), 'title' => $title, 'height' => '500px', 'width' => '800px'));

		JFactory::getApplication()->getDocument()->addScriptDeclaration('
		if(typeof jModalClose == "function"){
			var fnCode = jModalClose.toString() ;
			fnCode = fnCode.replace(/\}$/, "jQuery(\"#' . $tmptitle . 'Modal\").modal(\"hide\");\n}");
			window.eval(fnCode);
		}
		else {
			function jModalClose() {
				jQuery("#' . $tmptitle . 'Modal").modal("hide");
			}
		}');
	}
?>
	<a href="#<?php echo $tmptitle; ?>Modal" role="button" class="<?php echo $class; ?>" data-toggle="modal" title="<?php echo $title; ?>">
		<i class="icon-<?php echo $button->get('name'); ?>"></i> <?php echo $button->get('text'); ?>
	</a>

<?php
}
