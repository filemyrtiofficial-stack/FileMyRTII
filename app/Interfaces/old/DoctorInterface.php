<?php
namespace App\Interfaces;

interface DoctorInterface {
    public function store($data);
    public function update($data, $id);

}