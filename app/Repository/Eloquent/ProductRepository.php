<?php
namespace App\Repository\Eloquent;

use App\Category;
use App\Product;
use App\Repository\BaseRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductRepository implements BaseRepositoryInterface, ProductRepositoryInterface {
 
    public function getAll()
    {
        return Product::with('categories')->paginate(25);
    }
 
    public function destroy($id)
    {
        $product = Product::find($id);
        return $product->delete();
    }
 
    public function createOrUpdate($request, $id = null)
    {
        if(is_null($id)) {
            // create after validation
            if ($request->except('categories') instanceof Collection) {
                $productStoreRequest = $request->except('categories')->toArray();
            } else {
                $productStoreRequest = $request->except('categories');
            }
            $product = Product::create($productStoreRequest);
            $categoryArray = explode(',', $request->get('categories'));
            foreach ($categoryArray as $category) {
                Category::create(['name' => $category, 'product_id' => $product->id]);
            }
            return $product;
        }
        else {
            // update after validation
            $product = Product::find($id);
            return $product->update($request->toArray());
        }
        return back();
    }
 
}