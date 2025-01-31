<?php
namespace App\Interfaces;

interface AuthInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);

}