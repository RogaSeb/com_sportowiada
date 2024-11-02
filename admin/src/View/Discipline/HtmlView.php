<?php

namespace RogackiS\Component\Sportowiada\Administrator\View\Discipline;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	protected $form;
	protected $item;

	public function display($tpl = null)
	{
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');

		// Dodaje toolbar do widoku
		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Dodaje toolbar do widoku administracyjnego dla komponentu com_sportowiada.
	 */
	protected function addToolbar()
	{
		// Ukrywa główne menu administracyjne, aby nie było widoczne podczas edycji elementu.
		Factory::getApplication()->getInput()->set('hidemainmenu', true);

        // Ustawia tytuł paska narzędzi
        ToolbarHelper::title(Text::_('COM_SPORTOWIADA_DISCIPLINE_TITLE_ADD'));

		echo Text::_('TEST_KEY');

		// Dodaje przycisk "Apply" do paska narzędzi, który umożliwia zapisanie zmian bez zamykania edytora.
		ToolbarHelper::apply('discipline.apply');

		// Dodaje przycisk "Save" do paska narzędzi, który zapisuje zmiany i zamyka edytor.
		ToolbarHelper::save('discipline.save');

		// Dodaje przycisk "Cancel" do paska narzędzi, który anuluje edycję i powraca do poprzedniego widoku.
		ToolbarHelper::cancel('discipline.cancel', 'JTOOLBAR_CLOSE');
	}
}