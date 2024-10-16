<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;

// Pobierz menedżera zasobów
$wa = $this->document->getWebAssetManager();

// Użyj skryptów
$wa->useScript('keepalive');  // Zapobiega wygasaniu sesji
$wa->useScript('form.validate'); // Dodaje walidację formularza
?>

<div class="discipline-edit">
    <h1><?php echo $this->item->id ? JText::_('COM_SPORTOWIADA_MANAGER_DISCIPLINE_EDIT') : JText::_('COM_SPORTOWIADA_MANAGER_DISCIPLINE_NEW'); ?></h1>

    <form action="<?php echo JRoute::_('index.php?option=com_sportowiada&layout=edit&id=' . (int) $this->item->id); ?>"
          method="post" name="adminForm" id="item-form" class="form-validate">

        <div class="form-horizontal">
            <?php
            // Renderuj pola formularza
            echo $this->form->renderField('name');      // Pole nazwy
            echo $this->form->renderField('created');   // Pole daty utworzenia
            echo $this->form->renderField('created_by'); // Pole twórcy
            echo $this->form->renderField('modified');  // Pole daty modyfikacji
            echo $this->form->renderField('modified_by'); // Pole osoby modyfikującej
            echo $this->form->renderField('state');     // Pole stanu
            ?>
        </div>

        <input type="hidden" name="task" value="discipline.edit" />
        <?php echo HTMLHelper::_('form.token'); // Token zabezpieczający ?>
    </form>
</div>
