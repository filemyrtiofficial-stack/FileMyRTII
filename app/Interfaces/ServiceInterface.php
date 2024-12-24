<?php
namespace App\Interfaces;

interface ServiceInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function deleteSection($id);

}