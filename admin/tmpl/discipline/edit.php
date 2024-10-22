<?php

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;

$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');
?>
<form action="<?php echo JRoute::_('index.php?option=com_sportowiada&layout=edit&id=' . (int) $this->item->id); ?>"
method="post" name="adminForm" id="item-form" class="form-validate">

    <?php echo $this->form->renderField('name'); ?>

    <input type="hidden" name="task" value="discipline.edit" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
