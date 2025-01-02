<?php
namespace App\Interfaces;

interface TemplateInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function updateSectionDetails($data, $page_id, $id = null);
    public function deleteSection($id);
    // public function addPageSection($request, $page_id, $id=null);
}