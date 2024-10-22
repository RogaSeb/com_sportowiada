<?php

namespace RogackiS\Component\Sportowiada\Administrator\View\Discipline;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
// use Joomla\CMS\Factory;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;

    protected function addToolbar()
    {
        // Factory::getApplication()->getInput()->set('hidemainmenu', true);
        ToolbarHelper::title('Discipline: Add');

        ToolbarHelper::apply('discipline.apply');
        ToolbarHelper::save('discipline.save');
        ToolbarHelper::cancel('discipline.cancel', 'JTOOLBAR_CLOSE');
    }

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        $this->addToolbar();

        parent::display($tpl);
    }
}
