<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class DisciplinesModel extends BaseDatabaseModel
{
    protected function getListQuery()
    {
        // Pobierz bazę danych
        $db = $this->getDatabase();

        // Utwórz zapytanie
        $query = $db->getQuery(true);

        // Zapytanie SELECT
        $query->select('*')
            ->from($db->quoteName('#__sportowiada_disciplines', 'a'));

        // Sortowanie
        $query->order('a.id DESC');

        return $query;
    }
}
