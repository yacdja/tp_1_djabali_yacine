<?php
class Lampe extends CRUD {
    private $crud;
    private $id;
    private $brand;
    private $type;
    private $model;
    private $price;
    public function createLampe() {
        $lampeData = [
            'brand' => $this->getBrand(),
            'type' => $this->getType(),
            'model' => $this->getModel(),
            'price' => $this->getPrice()
        ];
        return $this->crud->addLampe($lampeData);
    }

    public function updateLampe() {
        $lampeData = [
            'brand' => $this->getBrand(),
            'type' => $this->getType(),
            'model' => $this->getModel(),
            'price' => $this->getPrice()
        ];
        return $this->crud->updateLampeById($this->getId(), $lampeData);
    }

    public function deleteLampe() {
        return $this->crud->deleteLampeById($this->getId());
    }
}
