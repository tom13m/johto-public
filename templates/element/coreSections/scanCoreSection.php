<?php if (!isset($data)) { ?>

<div class="scanPlaceholderSection row">
	<div class="col-md-12 my-auto">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<p> Scan een product </p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<?= $this->Html->image('scanPlaceholder.png', ['alt' => 'Scan placeholder', 'class' => 'scanPlaceholderImage']); ?>
			</div>
		</div>
	</div>
</div>

<?php } else { ?>

<div class="coreSectionRow row">

	<div class="col-md-9">
		<!-- Product information -->
		<div class="row">
			<div class="col-md-12">
				<div class="topBar row">
					<div class="topBarTitle col-md-3"> <?= $data['product']['barcode']; ?> </div>
					<div class="topBarSubtitle col-md-9"> <?= $data['product']['name']; ?> </div>			
				</div>
			</div>
		</div>
		<div class="coreSectionContent row">
			<div class="col-md-12">
				<!-- General information -->
				<span id="scanProductGeneralSection">
					<?= $this->Element('coreSections/scanCoreSection/productGeneral'); ?>
				</span>
				
				<!-- Product stock -->
				<span id="scanProductStockSection">
					<?= $this->Element('coreSections/scanCoreSection/productStock'); ?>
				</span>
			</div>
		</div>

		<!-- Test button for toggling action menu -->
		<!--		<button type="button" onclick="toggleMenu('scanActionMenu')"> Acties </button>-->
	</div>

	<!-- Scan product action scenes -->
	<div id="scanActionMenu" class="actionMenu col-md-3">
		<!-- Choose visible action -->
		<div class="actionMenuOptions row">
			<select class="actionMenuSelect" onchange="changeActionMenu('scan', this.value)">
				<?php Foreach($data['allowedActions'] as $allowedAction) { ?>
				<option value="<?= array_search($allowedAction, $data['allowedActions']); ?>" class="actionMenuOption"> <?= $allowedAction; ?> </option>
				<?php } ?>
			</select>
		</div>

		<!-- Loading all allowed actions for action menu -->
		<?php $i = 0; Foreach($data['allowedActions'] as $allowedAction) { if ($i == 0) { ?>
		<section id="<?= 'scan_Action_' . array_search($allowedAction, $data['allowedActions']); ?>" class="scan_ActionMenu actionMenuSection active">
			<?= $this->Element('actionMenus/scanActionMenu/' . array_search($allowedAction, $data['allowedActions'])); ?>
		</section>
		<?php } else { ?>
		<section id="<?= 'scan_Action_' . array_search($allowedAction, $data['allowedActions']); ?>" class="scan_ActionMenu actionMenuSection">
			<?= $this->Element('actionMenus/scanActionMenu/' . array_search($allowedAction, $data['allowedActions'])); ?>
		</section>
		<?php } $i++; } ?>
	</div>

</div>

<?php } ?>