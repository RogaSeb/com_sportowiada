<?php

defined('_JEXEC') or die('Restricted access');

// Importowanie klas
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
?>

<h1>Dyscypliny Sportowe</h1>
<p>To jest przykładowy komponent Joomla!</p>

<form action="<?php echo Route::_('index.php?option=com_sportowiada&view=disciplines'); ?>" method="post" name="adminForm" id="adminForm">

    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>

    <?php if (empty($this->items)) : ?>
        <div class="alert alert-info">
            <span class="icon-info-circle" aria-hidden="true"></span>
            <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
        </div>
    <?php else : ?>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                    <th>Status</th>
                    <th>
                        <a href="/<?php echo Route::_('index.php?option=com_sportowiada&task=discipline.edit&id=' . $row->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape($row->title); ?>">
                            <?php echo $this->escape($row->title); ?>
                        </a>
                    </th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <td><?php echo $item->published; ?></td>
                        <td>
                            <a href="<?php echo Route::_('index.php?option=com_sportowiada&task=discipline.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?>">
                                <?php echo $this->escape($item->title); ?>
                            </a>
                        </td>
                        <td><?php echo $item->id; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Ukryte pola formularza -->
    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
