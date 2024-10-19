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
        // Ustaw pasek narzędzi.
        $this->addToolbar();

        // Pobierz elementy i przypisz je do $this->items
        $this->items = $this->get('Items');

        // Wywołaj rodzica dla wyświetlenia widoku
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        // Ustaw tytuł paska narzędzi
        ToolbarHelper::title(Text::_('COM_SPORTOWIADA_MANAGER_DISCIPLINES'));

        // Dodaj przyciski do paska narzędzi
        ToolbarHelper::addNew('discipline.add'); // Przycisk dodawania
        ToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'disciplines.delete'); // Przycisk usuwania
        ToolbarHelper::publish('disciplines.publish', 'JTOOLBAR_PUBLISH', true); // Przycisk publikacji
        ToolbarHelper::unpublish('disciplines.unpublish', 'JTOOLBAR_UNPUBLISH', true); // Przycisk unpublikacji
    }
}
