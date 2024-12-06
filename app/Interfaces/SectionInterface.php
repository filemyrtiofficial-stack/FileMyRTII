<?php
namespace App\Interfaces;

interface SectionInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function fieldStore($section_id, $data);
    public function fieldUpdate($data, $id);

    


}