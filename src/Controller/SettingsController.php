<?php

namespace App\Controller;

use Cake\Controller\Controller;

class SettingsController extends AppController {

	public function initialize(): void {
		parent::initialize();
	}

	/* Test function for inserting file format array into database */
	public function index() {
		$this->loadModel('FileFormats');

		$fileFormats = $this->FileFormats->find();

		Foreach ($fileFormats as $fileFormat) {
			$fileFormat->format = unserialize($fileFormat->format);
		}

		$this->set(compact('fileFormats'));
	}

	public function setFileFormat() {

		$this->loadModel('FileFormats');

		$fileFormat = $this->FileFormats->newEmptyEntity();

		$fileFormat->name = 'Plieger';
		/* Barcode positions are always minus one because of the default array structure */
		$fileFormat->format = serialize(array('barcode' => 4, 'name' => 5, 'description' => 14));

		if ($this->FileFormats->save($fileFormat)) {
			return $this->redirect(['controller' => 'settings', 'action' => 'index']);
		} else {
			return $this->redirect(['controller' => 'settings', 'action' => 'index']);
		}

	}

}

?>