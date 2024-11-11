<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplication;

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

	protected function loadFormData()
	{
		/** @var CMSApplication $app */
		$app = Factory::getApplication();

		// Pobiera dane z sesji użytkownika, jeśli istnieją
		$data = $app->getUserState('com_sportowiada.edit.discipline.data', []);

		// Jeśli brak danych, pobiera dane istniejącego elementu
		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	public function save($data)
	{
		/* Dodaj kod, aby zmodyfikować dane przed zapisaniem */
		return parent::save($data);
	}
}