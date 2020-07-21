<?php

class Storage implements IStorage
{
    private $path;

    function __construct($path)
    {
        $this->path = $path;
    }

    public function fetch($id)
    {
        if (file_exists($this->path . $id))
        {
            $fileContent = file_get_contents($this->path . $id);
            $product = unserialize($fileContent);
            return $product;
        }
    }

    public function fetchAll()
    {
        $files = scandir($this->path);
        foreach($files as $file)
        {
            $fileContent = file_get_contents($this->path . $file);
            $product = unserialize($fileContent);
            if ($product instanceof Product)
            {
                $result[] = $product;
            }
        }
        return $result;
    }

    public function delete($id)
    {
        if (!file_exists($this->path . $id))
        {
            throw new Exception("File doesn't exist");
        }
        unlink($this->path . $id);
    }

    public function insert(IProduct $product)
    {
        $filePath = $this->path . $product->getId();
        $serializedFile = serialize($product);
        if (file_exists($filePath))
        {
            throw new Exception("File already exists");
        }
        file_put_contents($filePath, $serializedFile);
    }

    public function edit($id, $newValues)
    {
        if (!file_exists($this->path . $id))
        {
            throw new Exception("File doesn't exist");
        }
        $product = $this->fetch($id);
        $product->update($newValues);
        $this->delete($id);
        $this->insert($product);
    }
}

?>