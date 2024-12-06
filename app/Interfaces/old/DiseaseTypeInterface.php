<?php
namespace App\Interfaces;

interface DiseaseTypeInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}