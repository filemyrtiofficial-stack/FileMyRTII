<?php
namespace App\Interfaces;

interface TeamMemberInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);


}