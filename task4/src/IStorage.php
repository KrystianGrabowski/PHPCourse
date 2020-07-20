<?php

interface IStorage
{
    public function fetch($id);
    public function fetchAll();
    public function delete($id);
    public function edit($id, $newValues);
    public function insert(IProduct $product);
}

?>