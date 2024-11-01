<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;

class DisciplineModel extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
       $form = $this->loadForm('com_sportowiada.discipline', 'discipline', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }

        return $form;
    }
}