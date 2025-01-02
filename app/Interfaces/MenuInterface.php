<?php
namespace App\Interfaces;

interface MenuInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function updateNode($data);

}