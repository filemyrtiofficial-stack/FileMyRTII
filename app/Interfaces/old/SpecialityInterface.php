<?php
namespace App\Interfaces;

interface SpecialityInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}