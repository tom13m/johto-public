<!DOCTYPE HTML>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title> Main mobile </title>

		<!-- CSS files -->
		<?= $this->Html->css('style_mobile.css') ?>
		<?= $this->Html->css('bootstrap.min.css') ?>

		<!-- Javascript files -->
		<?= $this->Html->script('jquery-3.4.0.min.js') ?>
		<?= $this->Html->script('jquery.csv.min.js') ?>
		<?= $this->Html->script('bootstrap.min.js') ?>
		<?= $this->Html->script('popper.min.js') ?>
		<?= $this->Html->script('quagga.min.js') ?>
		<?= $this->Html->script('onscan.min.js') ?>
		<?= $this->Html->script('jszip.js') ?>
		<?= $this->Html->script('xlsx.js') ?>
		<?= $this->Html->script('main_mobile.js') ?>
		<?= $this->Html->script('generic.js') ?>
		
		<!-- Online sources -->
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	</head>
	<body  scroll="no"> 
		<section id="mainMenuMobile" class="mainMenuMobile">
			<?= $this->Element('menus/main_menu_mobile'); ?>
		</section>

		<div id="barcodeScannerCameraTarget" class="barcodeScannerCameraSection">
			
		</div>
		
		<!-- Main container -->
		<section class="content container-fluid">
				<!-- Main menu -->
				<section class="contentBody row">
					<!-- Content will be loaded here -->
					<?= $this->fetch('content') ?>
				</section>
			<!-- Bottom bar with menu trigger and barcode field -->
			<div class="bottomBar row">
				<div class="bottomBarMainMenuIcon col-2">
					<i class="fas fa-bars" onclick="toggleMenu('mainMenuMobile')"> </i>
				</div>
				<div class="col-8">
					<input type="text" id="barcodeTarget" class="barcodeScanField col-10", autocomplete="off">
				</div>
				
				<div id="cameraModeOn" class="col-2 cameraMode active" onclick="startBarcodeScanner(); setActive('cameraMode', 'cameraModeOff');">
					<i class="cameraIcon fas fa-camera"> </i>
				</div>
				<div id="cameraModeOff" class="col-2 cameraMode" onclick="stopBarcodeScanner(); setActive('cameraMode', 'cameraModeOn');">
					<i class="cameraIcon fas fa-times"> </i>
				</div>
				
				<button type="button" id="barcodeTargetButton" style="display: none;" onclick="processBarcode()"> <i class="fas fa-chevron-right"> </i> </button>
			</div>
		</section>
	</body>
	<footer>
		
	</footer>
</html>

<script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-Token': <?= json_encode($this->request->getAttribute('csrfToken')); ?>
        }
    });
		
	/* Function for rendering an element */
	function renderElement(element, data = null, id, callback) {
		let path = "<?= $this->Url->Build(['controlller' => 'main', 'action' => 'renderElement']); ?>" + "/" + element;
		
		$('#' + id).load(path, {
			data: data
		}, function() {
			if (callback != null) {
				callback();
			}
		});
	}
	
	/* Function for rendering an element (prepend) */
	function renderElementPrepend(element, data = null, id, callback) {
		let path = "<?= $this->Url->Build(['controlller' => 'main', 'action' => 'renderElement']); ?>" + "/" + element;
		
		$('#' + id).prepend($('<span>').load(path, {
			data: data
		}, function(i) {	
			let prepended = document.getElementsByClassName('prepended');
			
			$(prepended).each(function(i, p) {
				$(p).unwrap();
				p.classList.remove('prepended');
			})
			
			if (callback != null) {
				callback();
			}
		}));
	}
	
	function appendParamVariables(data = null) {
		let urlVariables = '?';
		
		if (data != null) {
			$.each(data, function(key, value) {	
				urlVariables += key + '=' + value;
			});
			
			window.history.pushState("main", "main", "<?php $this->Url->Build(['controller' => 'main', 'action' => 'index']); ?>" + urlVariables);
		} else {
			
		}
	}
	
	/* Function that creates an ajax request */
	function ajaxRequest(controller, action, data = null, callback = null) {
		$.ajax({
			url : "<?=$this->Url->build(['controller' => '']);?>" + "/" + controller + "/" + action,
			type : 'POST',
			data : {
				'data': data
			},
			dataType :'json',
			success : function(dataArray) {    
				let response = dataArray.response;
				
//				console.log(response);
				
				if (typeof response.data !== 'undefined') {
					data = response.data;
					
					if (callback != null) {
						callback(data);
					}
				} else if (response.success == 0) {
					data = null;
					
					giveError(response.errorTemplate);
				} else {
					data = null;
					
					if (callback != null) {
						callback(data);
					}
				}
			},
			error : function(request,error)
			{
				console.error(error);
			}
		});
	}
</script>