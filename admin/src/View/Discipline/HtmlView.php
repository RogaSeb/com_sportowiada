<?php

namespace RogackiS\Component\Sportowiada\Administrator\View\Discipline;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;
    protected $state;

    /**
     * Wyświetl widok Dyscypliny
     *
     * @param string $tpl Nazwa pliku szablonu do przetworzenia; automatycznie przeszukuje ścieżki szablonów.
     *
     * @return void
     */
    public function display($tpl = null)
    {
        // Pobierz dane widoku
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->state = $this->get('State');

        // Sprawdź błędy.
        if (count($errors = $this->get('Errors')))
        {
            throw new \Exception(implode("\n", $errors), 500);
        }

        // Ustaw pasek narzędzi
        $this->addToolbar();

        // Wyświetl szablon
        parent::display($tpl);
    }

    /**
     * Dodaj tytuł strony i pasek narzędzi.
     *
     * @return void
     */
    protected function addToolbar()
    {
        $input = \JFactory::getApplication()->input;

        // Ukryj główne menu administratora Joomla
        $input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        ToolbarHelper::title($isNew ? \JText::_('COM_SPORTOWIADA_MANAGER_DISCIPLINE_NEW') : \JText::_('COM_SPORTOWIADA_MANAGER_DISCIPLINE_EDIT'), 'generic.png');

        ToolbarHelper::apply('discipline.apply');
        ToolbarHelper::save('discipline.save');
        ToolbarHelper::save2new('discipline.save2new');

        if (empty($this->item->id))
        {
            ToolbarHelper::cancel('discipline.cancel');
        }
        else
        {
            ToolbarHelper::cancel('discipline.cancel', 'JTOOLBAR_CLOSE');
        }
    }
}
