<?php

namespace RogackiS\Component\Sportowiada\Administrator\Controller;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\FormController;

class DisciplineController extends FormController
{
    public function apply()
    {
        // Logika dla akcji "apply"
        // Możesz tu dodać kod, który zapisuje dane, ale nie zamyka formularza.
    }

    public function save($key = null, $urlVar = null) // Dodaj parametry $key i $urlVar
    {
        // Logika dla akcji "save"
        // Tutaj zapiszesz dane i zamkniesz formularz.
        // Możesz wykorzystać $key i $urlVar, jeśli potrzebujesz.
    }



    public function display($cachable = false, $urlvars = array())
    {
        // Pobierz wartość 'id' z wejścia
        $id = $this->input->getInt('id');

        // Ustaw wartość 'layout' na 'default'
        $this->input->set('layout', 'default');

        // Ustaw id do przetworzenia
        $this->input->set('id', $id);

        // Wywołaj metodę nadrzędną
        parent::display($cachable, $urlvars);
    }
}
