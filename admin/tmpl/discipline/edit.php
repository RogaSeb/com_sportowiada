<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$wa = $this->document->getWebAssetManager();

$wa->useScript('keepalive');
$wa->useScript('form.validate');

?>

<form action="<?php echo JRoute::_('index.php?option=com_sportowiada&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div class="main-card">
			<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details', 'recall' => true, 'breakpoint' => 768]); ?>
<!--
			<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('COM_BANNERS_BANNER_DETAILS')); ?>
			<div class="row">
				<div class="col-lg-9">
					<?php echo $this->form->renderField('type'); ?>
					<div id="image">
						<?php echo $this->form->renderFieldset('image'); ?>
					</div>
					<div id="custom">
						<?php echo $this->form->renderField('custombannercode'); ?>
					</div>
					<?php
					echo $this->form->renderField('clickurl');
					echo $this->form->renderField('description');
					?>
				</div>
				<div class="col-lg-3">
					<?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
				</div>
			</div>
			<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'otherparams', Text::_('COM_BANNERS_GROUP_LABEL_BANNER_DETAILS')); ?>
				<fieldset id="fieldset-otherparams" class="options-form">
					<legend><?php echo Text::_('COM_BANNERS_GROUP_LABEL_BANNER_DETAILS'); ?></legend>
					<div>
						<?php echo $this->form->renderFieldset('otherparams'); ?>
					</div>
				</fieldset>
			<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
			<div class="row">
				<div class="col-md-6">
					<fieldset id="fieldset-publishingdata" class="options-form">
						<legend><?php echo Text::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></legend>
						<div>
							<?php echo LayoutHelper::render('joomla.edit.publishingdata', $this); ?>
						</div>
					</fieldset>
				</div>
				<div class="col-md-6">
					<fieldset id="fieldset-metadata" class="options-form">
						<legend><?php echo Text::_('JGLOBAL_FIELDSET_METADATA_OPTIONS'); ?></legend>
						<div>
						<?php echo $this->form->renderFieldset('metadata'); ?>
						</div>
					</fieldset>
				</div>
			</div>
			<?php echo HTMLHelper::_('uitab.endTab'); ?>

			<?php echo HTMLHelper::_('uitab.endTabSet'); ?> -->
	</div>

	<input type="hidden" name="task" value="discipline.edit" />
	<?php echo HTMLHelper::_('form.token'); ?>

</form>