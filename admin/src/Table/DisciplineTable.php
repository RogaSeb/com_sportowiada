<?php

namespace RogackiS\Component\Sportowiada\Administrator\Table;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\CMS\User\CurrentUserInterface;
use Joomla\CMS\User\CurrentUserTrait;
use Joomla\Database\DatabaseDriver;
use Joomla\Filter\OutputFilter;
use Joomla\Registry\Registry;

class DisciplineTable extends Table implements CurrentUserInterface
{

	use CurrentUserTrait;

	protected $_jsonEncode = ['params', 'metadata'];

	/**
	 * Konstruktor klasy, definiujący strukturę tabeli.
	 *
	 * @param   DatabaseDriver  $db  Instancja obiektu bazy danych.
	 */
	function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__sportowiada_disciplines', 'id', $db);
	}

	/**
	 * Przypisuje dane z tablicy do właściwości obiektu tabeli, z opcjonalnym przetwarzaniem pól.
	 *
	 * Funkcja sprawdza, czy pole 'attribs' w przekazanej tablicy istnieje i jest tablicą.
	 * Jeśli tak, konwertuje je do formatu tekstowego za pomocą obiektu Registry,
	 * co umożliwia przechowywanie złożonych danych w jednym polu.
	 * Następnie wywołuje metodę `bind` klasy nadrzędnej, aby przypisać pozostałe wartości.
	 *
	 * @param   array   $array   Tablica danych do przypisania do obiektu tabeli.
	 * @param   mixed   $ignore  Lista pól do zignorowania podczas przypisywania (opcjonalnie).
	 *
	 * @return  boolean  True jeśli przypisanie się powiodło, false w przypadku błędu.
	 */
	public function bind($array, $ignore = '')
	{
		// Sprawdź, czy pole 'attribs' istnieje i jest tablicą
		if (isset($array['attribs']) && \is_array($array['attribs']))
		{
			// Utwórz obiekt Registry na podstawie tablicy 'attribs'
			$registry = new Registry($array['attribs']);

			// Konwertuj obiekt Registry do formatu tekstowego i przypisz do 'attribs'
			// (np. jako JSON), aby umożliwić przechowywanie go w pojedynczym polu tabeli
			$array['attribs'] = (string) $registry;
		}

		// Wywołaj metodę bind klasy nadrzędnej, aby przypisać pozostałe wartości
		return parent::bind($array, $ignore);
	}

	/**
	 * Funkcja walidacji dla zapisu rekordu.
	 *
	 * @return boolean True jeśli walidacja przebiegła pomyślnie, false w przeciwnym wypadku.
	 */
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

		// Sprawdzenie, czy pole 'name' jest uzupełnione.
		// Jeśli 'name' jest puste lub zawiera tylko białe znaki, ustaw błąd i przerwij zapis rekordu.
		// Komunikat błędu jest tłumaczalny, dzięki czemu można go dostosować w plikach językowych.
		if (trim($this->name) == '')
		{
			$this->setError('Pole (Nazwa) jest wymagane i nie może pozostać puste.');

			return false;
		}

		// Jeśli pole 'alias' jest puste, ustaw je automatycznie na podstawie pola 'name' lub 'title'
		// Uwzględnia ustawienia 'unicodeslugs' dla poprawnego generowania aliasu
		if (empty($this->alias))
		{
			if (Factory::getConfig()->get('unicodeslugs') == 1)
			{
				// Użyj UnicodeSlug, jeśli włączono obsługę aliasów z unicode
				$this->alias = OutputFilter::stringURLUnicodeSlug($this->name); // Lub $this->title, jeśli pole 'title' jest dostępne
			}
			else
			{
				// Użyj standardowego formatu URL-safe
				$this->alias = OutputFilter::stringURLSafe($this->name); // Lub $this->title
			}
		}
		else
		{
			// Konwertuj alias na bezpieczny format URL, jeśli już istnieje
			$this->alias = ApplicationHelper::stringURLSafe($this->alias);
		}

		// Ustawienie domyślnej wartości dla 'ordering', jeśli nie jest ustawiona
		if (empty($this->ordering))
		{
			$db = Factory::getDbo();
			$query = $db->getQuery(true)
						->select('MAX(ordering)')
						->from('#__sportowiada_disciplines');

			$db->setQuery($query);
			$max = $db->loadResult();

			$this->ordering = $max + 1;
		}

		// Upewnij się, że nowe elementy mają ustawione obowiązkowe pola
		if (!$this->id)
		{

			// Licznik wyświetleń (hits) musi być ustawiony na zero dla nowego elementu
			$this->hits = 0;
		}

		// Ustaw publish_up na null, jeśli nie jest ustawione
		if (!$this->publish_up)
		{
			$this->publish_up = null;
		}

		// Ustaw publish_down na null, jeśli nie jest ustawione
		if (!$this->publish_down)
		{
			$this->publish_down = null;
		}

		// Sprawdź, czy data publish_down nie jest wcześniejsza niż publish_up
		if (!is_null($this->publish_up) && !is_null($this->publish_down) && $this->publish_down < $this->publish_up)
		{
			// Zamień daty miejscami
			$temp = $this->publish_up;
			$this->publish_up = $this->publish_down;
			$this->publish_down = $temp;
		}

		return true;
	}

	/**
	 * Zapisz rekord do bazy danych.
	 *
	 * Ta funkcja ustawia domyślne wartości dla pól takich jak `created`, `created_by`, `modified`, `modified_by`.
	 * Dodatkowo weryfikuje unikalność aliasu przed zapisem.
	 *
	 * @param   boolean  $updateNulls  Opcjonalnie. Czy zaktualizować pola z wartością NULL.
	 * @return  boolean  True, jeśli zapis się powiódł, False w przypadku błędu.
	 */
	public function store($updateNulls = true)
	{
		// Pobierz instancję aplikacji, datę w formacie SQL oraz bieżącego użytkownika
		$app = Factory::getApplication();
		$date = Factory::getDate()->toSql();
		$user = Factory::getUser();

		// Ustaw domyślną wartość pola `created` na bieżącą datę, jeśli nie jest ustawione
		if (!$this->created)
		{
			$this->created = $date;
		}

		// Ustaw domyślną wartość pola `created_by` na ID bieżącego użytkownika, jeśli nie jest ustawione
		if (!$this->created_by)
		{
			$this->created_by = $user->get('id');
		}

		// Jeśli rekord już istnieje
		if ($this->id)
		{
			// Ustaw `modified_by` na ID bieżącego użytkownika oraz `modified` na bieżącą datę
			$this->modified_by = $user->get('id');
			$this->modified = $date;
		}
		else
		{
			// Jeśli `modified` nie jest ustawione, przypisz do niego wartość z `created`
			if (!$this->modified)
			{
				$this->modified = $this->created;
			}

			// Jeśli `modified_by` nie jest ustawione, przypisz do niego wartość z `created_by`
			if (empty($this->modified_by))
			{
				$this->modified_by = $this->created_by;
			}
		}

		// Sprawdź, czy alias jest unikalny
		$table = $app->bootComponent('com_sportowiada')->getMVCFactory()->createTable('Discipline', 'Administrator');
		if ($table->load(['alias' => $this->alias]) && ($table->id != $this->id || $this->id == 0))
		{
			// Ustaw komunikat o błędzie, jeśli alias nie jest unikalny
			$this->setError('Alias nie jest unikalny.');

			// Ustaw dodatkowy komunikat, jeśli element o tym aliasie znajduje się w koszu
			if ($table->state == -2)
			{
				$this->setError('Alias nie jest unikalny. Element znajduje się w koszu.');
			}

			return false;
		}

		// Zapisz rekord do bazy danych, wywołując metodę nadrzędną
		return parent::store($updateNulls);
	}

}