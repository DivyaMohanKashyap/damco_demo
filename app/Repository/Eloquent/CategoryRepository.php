<?php
namespace App\Repository\Eloquent;

use App\Category;
use App\Repository\BaseRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;

class CategoryRepository implements BaseRepositoryInterface, CategoryRepositoryInterface {
 
    public function getAll()
    {
        return Category::paginate(25);
    }
 
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            return $category->delete();
        }
        return NULL;
    }
 
    public function createOrUpdate($request, $id = null)
    {
        if(is_null($id)) {
            // create after validation
            return Category::create($request->toArray());
        }
        else {
            // update after validation
            $category = Category::find($id);
            return $category->update($request->toArray());
        }
    }
 
}