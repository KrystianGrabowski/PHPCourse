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
        
    }

    public function fetchAll()
    {
        $files = scandir($this->path);
        foreach($files as $file)
        {
            $fileContent = file_get_contents($this->path . $file);
            $obj = unserialize($fileContent);
            if ($obj instanceof Product) {
                $result[] = $obj;
            }
        }
        return $result;
    }

    public function delete($id)
    {
        
    }

    public function insert(IProduct $product)
    {
        $filePath = $this->path . $product->getId();
        $serializedFile = serialize($product);
        if (file_exists($filePath)) {
            return new Exception("File already exists");
        }
        file_put_contents($filePath, $serializedFile);
    }

    public function edit($id, $newValues)
    {
        
    }
}

?>