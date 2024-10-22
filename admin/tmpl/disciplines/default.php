<?php

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

?>

<h1>Dyscypliny Sportowe</h1>
<p>To jest przykładowy komponent Joomla!</p>

<form action="<?php echo Route::_('index.php?option=com_sportowiada&view=disciplines'); ?>" method="post" name="adminForm" id="adminForm">

	<?php if (empty($this->items)) : ?>
		<div class="alert alert-info">
			<span class="icon-info-circle" aria-hidden="true"></span>
			<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
	<?php else : ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<td class="w-1 text-center">
									<?php echo HTMLHelper::_('grid.checkall'); ?>
					</td>
					<th scope="col">
									<?php echo Text::_('COM_SPORTOWIADA_HEADING_NAME'); ?>
					</th>
					<th scope="col" class="w-5 d-none d-md-table-cell">
									<?php echo Text::_('JGRID_HEADING_ID'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->items as $i => $item) : ?>
					<tr>
						<td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id, false, 'cid', 'cb', $item->name); ?>
						</td>
						<td>
							<a href="<?php echo Route::_('index.php?option=com_sportowiada&task=discipline.edit&id=' . $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape($item->name); ?>">
								<?php echo $this->escape($item->name); ?>
							</a>
						</td>
						<td><?php echo $item->id; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>


	<input type="hidden" name="task" value="">
	<input type="hidden" name="boxchecked" value="0">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
