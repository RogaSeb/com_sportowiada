<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\Registry\Registry;

class DisciplineModel extends AdminModel
{
    public function save($data)
    {
        // Modyfikacja aliasu, jeśli nie jest ustawiony
        if (empty($data['alias']))
        {
            if (Factory::getConfig()->get('unicodeslugs') == 1)
            {
                $data['alias'] = OutputFilter::stringURLUnicodeSlug($data['title']);
            }
            else
            {
                $data['alias'] = OutputFilter::stringURLSafe($data['title']);
            }
        }

        // Ustalanie wartości porządkowania
        if (!$data['ordering'])
        {
            $db = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select('MAX(ordering)')
                ->from('#__sportowiada_disciplines');

            $db->setQuery($query);
            $max = $db->loadResult();

            $data['ordering'] = $max + 1;
        }

        return parent::save($data);
    }

    public function bind($array, $ignore = '')
    {
        // Przekształcanie atrybutów do formatu JSON
        if (isset($array['attribs']) && is_array($array['attribs']))
        {
            $registry = new Registry($array['attribs']);
            $array['attribs'] = (string) $registry;
        }

        return parent::bind($array, $ignore);
    }

    public function check()
    {
        try
        {
            parent::check();
        }
        catch (\Exception $e)
        {
            $this->setError($e->getMessage());
            return false;
        }

        // Walidacja tytułu
        if (trim($this->title) == '')
        {
            $this->setError('Title (title) is not set.');
            return false;
        }

        // Ustalanie aliasu, jeśli nie jest ustawiony
        if (trim($this->alias) == '')
        {
            $this->alias = $this->title;
        }

        $this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

        // Upewnij się, że nowe elementy mają ustawione obowiązkowe pola
        if (!$this->id)
        {
            $this->hits = 0; // Hits musi być zerowy dla nowego elementu
        }

        // Ustawienie dat publikacji na null, jeśli nie są ustawione
        $this->publish_up = $this->publish_up ?: null;
        $this->publish_down = $this->publish_down ?: null;

        // Sprawdzenie dat publikacji
        if (!is_null($this->publish_up) && !is_null($this->publish_down) && $this->publish_down < $this->publish_up)
        {
            // Zamiana dat
            $temp = $this->publish_up;
            $this->publish_up = $this->publish_down;
            $this->publish_down = $temp;
        }

        return true;
    }

    public function store($updateNulls = true)
    {
        $app = Factory::getApplication();
        $date = Factory::getDate()->toSql();
        $user = Factory::getUser();

        if (!$this->created)
        {
            $this->created = $date; // Ustawienie daty utworzenia
        }

        if (!$this->created_by)
        {
            $this->created_by = $user->get('id'); // Ustawienie użytkownika tworzącego
        }

        if ($this->id)
        {
            // Istniejący element
            $this->modified_by = $user->get('id'); // Ustawienie użytkownika modyfikującego
            $this->modified = $date; // Ustawienie daty modyfikacji
        }
        else
        {
            // Ustawienie daty modyfikacji na datę utworzenia, jeśli nie jest ustawiona
            if (!$this->modified)
            {
                $this->modified = $this->created;
            }

            // Ustawienie modified_by na created_by, jeśli nie jest ustawione
            if (empty($this->modified_by))
            {
                $this->modified_by = $this->created_by;
            }
        }

        // Zweryfikowanie unikalności aliasu
        $table = $app->bootComponent('com_sportowiada')->getMVCFactory()->createTable('Discipline', 'Administrator');
        if ($table->load(['alias' => $this->alias]) && ($table->id != $this->id || $this->id == 0))
        {
            $this->setError('Alias is not unique.');

            if ($table->state == -2)
            {
                $this->setError('Alias is not unique. The item is in Trash.');
            }

            return false;
        }

        return parent::store($updateNulls);
    }
}
