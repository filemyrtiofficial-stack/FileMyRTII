<?php
namespace App\Interfaces;

interface DiseaseInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}