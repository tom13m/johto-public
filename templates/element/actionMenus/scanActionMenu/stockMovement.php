<!-- Move product stock between warehouses -->
<?= $this->Form->create(null, ['id' => 'moveProductWarehouseForm']); ?>
<div class="row">
	<div class="col-md-12">
		<div class="productMenuWarehouse row">
			<div class="col-md-12">
				<?= $this->Form->control('from_warehouse_id', ['id' => 'fromWareHouseField', 'label' => false, 'options' => $data['warehousesList'], 
															   'class' => 'optionField warehouseOptionField', 'empty' => 'Selecteer een magazijn', 'onchange' => 'switchProductWarehouse(this.value, "from")']); ?>
			</div>
			<div class="col-md-12">
				<!-- Options for from warehouse -->
				<div id="productFromWarehouses">
					<?php Foreach ($data['warehouses'] as $warehouse) { ?>

					<div id="<?= 'productWarehouseOptionFrom' . $warehouse['id']; ?>" class="warehouseOption from">
						<div class="row">
							<div class="col-md-12">
								<i class="fas fa-shuttle-van"> </i>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p> Voorraad: <?= $warehouse['productStock']; ?> </p>
							</div>
						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="fromToWarehouseArrow col-md-12">
				<i class="fas fa-arrow-down"> </i>
			</div>
		</div>
		<div class="productMenuWarehouse row">
			<div class="col-md-12">
				<?= $this->Form->control('to_warehouse_id', ['id' => 'toWareHouseField', 'label' => false, 'options' => $data['warehousesList'], 
															 'class' => 'optionField warehouseOptionField', 'empty' => 'Selecteer een magazijn', 'onchange' => 'switchProductWarehouse(this.value, "to")']); ?>
			</div>
			<div class="col-md-12">
				<!-- Options for to warehouse -->
				<div id="productToWarehouses">
					<?php Foreach ($data['warehouses'] as $warehouse) { ?>

					<div id="<?= 'productWarehouseOptionTo' . $warehouse['id']; ?>" class="warehouseOption to">
						<div class="row">
							<div class="col-md-12">
								<i class="fas fa-shuttle-van"> </i>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p> Voorraad: <?= $warehouse['productStock']; ?> </p>
							</div>
						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
		<div class="productStockAmount row">
			<div class="col-md-2 offset-md-2">
				Aantal:
			</div>
			<div class='col-md-5 offset-md-1'>
				<?= $this->Form->control('amount', ['label' => false, 'id' => 'productStockMovementAmount', 'class' => 'numericalField productWarehouseNumericalField', 'type' => 'number']); ?>
			</div>
		</div>
		<div class="row">
			<div class="actionMenuSubmitButtonSection col-md-12">
				<button type="button" class="actionMenuSubmitButton" onclick="moveProductStock()"> Voer uit </button>
			</div>
		</div>
	</div>
</div>

<?= $this->Form->control('product_id', ['type' => 'hidden', 'id' => 'productStockMovementProductId', 'value' => $data['product']['id']]); ?>
<?= $this->Form->end(); ?>