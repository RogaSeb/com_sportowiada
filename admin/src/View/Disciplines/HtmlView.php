<?php

namespace RogackiS\Component\Sportowiada\Administrator\View\Disciplines;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
	public function display($tpl = null)
	{
		$this->addToolbar();

		$this->items = $this->get('Items');

		parent::display($tpl);
	}

	protected function addToolbar()
	{
		ToolbarHelper::title(Text::_('COM_SPORTOWIADA_MANAGER_DISCIPLINES'));
		ToolbarHelper::addNew('discipline.add');
		ToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'disciplines.delete');
		ToolbarHelper::publish('disciplines.publish', 'JTOOLBAR_PUBLISH', true);
		ToolbarHelper::unpublish('disciplines.unpublish', 'JTOOLBAR_UNPUBLISH', true);
	}
}
