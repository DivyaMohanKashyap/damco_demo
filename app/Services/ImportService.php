<?php

namespace App\Services;

use App\Category;
use App\Product;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ImportService {

    protected $csvFilePath;

    public function __construct(CategoryRepositoryInterface $category, ProductRepositoryInterface $product)
    {
        $filePath = storage_path() . '/import/product-deli.json';
        $this->csvFilePath = json_decode(file_get_contents($filePath, false));
        $this->category = $category;
        $this->product = $product;
    }

    public function import() {
        if (isset($this->csvFilePath->products)) {
            // dd(count($this->csvFilePath->products));
            foreach ($this->csvFilePath->products as $value) {
                $collection  = new Collection();
                $collection->put('name', (string) $value->name);
                $collection->put('sku', (string) $value->sku);
                $collection->put('price', (string) $value->price);
                $collection->put('categories', $value->category);
                $this->product->createOrUpdate($collection);
            }
        }
        return true;
    }
}