<?php
namespace App\Interfaces;

interface LabTestInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}