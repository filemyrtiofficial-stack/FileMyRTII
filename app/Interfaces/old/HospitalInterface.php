<?php
namespace App\Interfaces;

interface HospitalInterface {
    public function store($data);
    public function update($data, $id);

}