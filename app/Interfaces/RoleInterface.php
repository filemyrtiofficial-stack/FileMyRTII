<?php
namespace App\Interfaces;

interface RoleInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}