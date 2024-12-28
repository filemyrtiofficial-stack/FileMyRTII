<?php
namespace App\Interfaces;

interface BlogInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}