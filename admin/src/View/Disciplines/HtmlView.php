<?php

namespace RogackiS\Component\Sportowiada\Administrator\View\Disciplines;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
	public function display($tpl = null)
	{
		$this->items = $this->get('Items'); 

		parent::display($tpl);
	}
}