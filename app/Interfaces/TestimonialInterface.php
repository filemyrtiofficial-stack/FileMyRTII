<?php
namespace App\Interfaces;

interface TestimonialInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}