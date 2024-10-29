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

	protected $_jsonEncode = ['params', 'metadata'];

	function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__sportowiada_disciplines', 'id', $db);
	}
}