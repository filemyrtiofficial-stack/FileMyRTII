<?php
namespace App\Interfaces;

interface LabInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}