<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class DisciplineModel extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_sportowiada.discipline', 'discipline', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $app  = Factory::getApplication();
        $data = $app->getUserState('com_sportowiada.edit.discipline.data', []);

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }
}