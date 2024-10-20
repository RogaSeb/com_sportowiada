<?php

defined('_JEXEC') or die('Restricted access');

// Importowanie klas
use Joomla\CMS\MVC\Controller\AdminController;

class DisciplinesController extends AdminController
{
    /**
     * Metoda do uzyskiwania obiektu modelu.
     *
     * @param   string  $name   Nazwa modelu.
     * @param   string  $prefix Prefiks klasy.
     * @param   array   $config Opcjonalna tablica asocjacyjna z ustawieniami konfiguracyjnymi.
     *
     * @return  object  Obiekt modelu.
     */
    public function getModel($name = 'Discipline', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }

    /**
     * Metoda do dodawania nowego rekordu.
     */
    public function add()
    {
        // Przekierowanie do formularza dodawania nowej dyscypliny
        $this->setRedirect(JRoute::_('index.php?option=com_sportowiada&task=discipline.edit&id=0', false));
    }
}
