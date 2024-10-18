<?php

namespace RogackiS\Component\Sportowiada\Administrator\View\Disciplines;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    public function display($tpl = null)
    {
        // Pobierz elementy i przypisz je do $this->items
        $this->items = $this->get('Items');

        // Wywołaj rodzica dla wyświetlenia widoku
        parent::display($tpl);
    }
}
