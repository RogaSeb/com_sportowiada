<?php

namespace RogackiS\Component\Sportowiada\Administrator\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\ListModel;

class DisciplinesModel extends ListModel
{
	protected function getListQuery()
	{
		$db = $this->getDatabase();
		$query = $db->getQuery(true);

		// Zapytanie SELECT
		$query->select('*')
			->from($db->quoteName('#__sportowiada_disciplines', 'a'));

		// Sortowanie
		$query->order('a.id ASC');
		return $query;
	}
}