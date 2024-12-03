<?php
namespace App\Interfaces;

interface CategoryInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}