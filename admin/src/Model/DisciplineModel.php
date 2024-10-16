<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;

class DisciplineModel extends AdminModel
{
    /**
     * Metoda pobiera obiekt Form dla formularza edycji
     *
     * @param array $data Dane domyślne
     * @param boolean $loadData Czy załadować dane formularza
     * @return \JForm|boolean Obiekt JForm w przypadku powodzenia, false w przypadku błędu
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Pobierz obiekt JForm
        $form = $this->loadForm(
            'com_sportowiada.discipline', // Nazwa formularza
            'discipline',                 // Plik XML formularza
            array(
                'control'   => 'jform',   // Prefiks kontrolny formularza
                'load_data' => $loadData  // Czy załadować dane formularza
            )
        );

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    /**
     * Metoda załadowuje dane do formularza
     *
     * @return mixed Dane do formularza
     */
    protected function loadFormData()
    {
        // Sprawdź, czy istnieją dane w sesji użytkownika
        $data = $this->getItem();

        // Sprawdź czy istnieją dane z poprzedniego formularza
        if ($this->getState('discipline.id') == 0)
        {
            $app = \JFactory::getApplication();
            $data = $app->getUserState('com_sportowiada.edit.discipline.data', array());

            if (empty($data))
            {
                $data = $this->getItem();
            }
        }

        return $data;
    }

    /**
     * Metoda zwraca tabelę dyscyplin
     *
     * @param string $type Nazwa klasy tabeli
     * @param string $prefix Prefiks nazwy klasy tabeli
     * @param array $config Tablica konfiguracji
     * @return \JTable Obiekt tabeli
     */
    public function getTable($type = 'Discipline', $prefix = 'RogackiS\\Component\\Sportowiada\\Administrator\\Table\\', $config = array())
    {
        return \JTable::getInstance($type, $prefix, $config);
    }
}
