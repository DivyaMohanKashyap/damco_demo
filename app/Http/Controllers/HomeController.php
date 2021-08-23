<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\ProductRepositoryInterface;

class HomeController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(CategoryRepository $category, ProductRepository $productRepository){
        return view('welcome', ['category' => $category->getAll(), 'products' => $productRepository->getAll()]);
    }
}
