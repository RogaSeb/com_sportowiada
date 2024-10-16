<?php

namespace RogackiS\Component\Sportowiada\Administrator\Table;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Table\Table;
use Joomla\CMS\User\CurrentUserInterface;
use Joomla\CMS\User\CurrentUserTrait;
use Joomla\Database\DatabaseDriver;

class DisciplineTable extends Table implements CurrentUserInterface
{
    use CurrentUserTrait;

    // Definicja pól, które będą kodowane jako JSON
    protected $_jsonEncode = ['params', 'metadata'];

    /**
     * Konstruktor klasy DisciplineTable
     *
     * @param   DatabaseDriver  $db  Obiekt sterownika bazy danych
     */
    function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__sportowiada_disciplines', 'id', $db);

        // Inicjalizacja pól
        $this->setColumnAlias('published', 'state');
    }

    /**
     * Metoda do automatycznego ustawiania daty utworzenia i aktualizacji rekordu
     *
     * @param   boolean  $updateNulls  Wskazuje, czy wartości null powinny być aktualizowane
     * @return  boolean  True on success
     */
    public function store($updateNulls = false)
    {
        $date = \Joomla\CMS\Factory::getDate();
        $user = \Joomla\CMS\Factory::getUser();

        // Jeśli rekord jest nowy, ustaw datę utworzenia i ID użytkownika, który go stworzył
        if (empty($this->id))
        {
            if (!(int) $this->created)
            {
                $this->created = $date->toSql();
            }

            if (empty($this->created_by))
            {
                $this->created_by = $user->id;
            }
        }
        // Zawsze ustawiaj datę aktualizacji i ID użytkownika, który go zaktualizował
        else
        {
            $this->modified = $date->toSql();
            $this->modified_by = $user->id;
        }

        return parent::store($updateNulls);
    }
}
