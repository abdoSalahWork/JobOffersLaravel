<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategotyResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categotyModel;
    public function __construct(Category $category)
    {
        $this->categotyModel = $category;
    }

    public function index()
    {
        $categories = $this->categotyModel->get();
        return view('aPanel.categories.viewCategories', compact('categories'));
    }


    public function show($id)
    {
        $category = $this->categotyModel->with('job')->find($id);

        if ($category) {
            return view('aPanel.categories.ditailsCategory', compact('category'));
        }
        return redirect()->back();
    }

    public function add()
    {
        return view('aPanel.categories.addCategories');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'categoryName' => 'required|string|min:3|unique:categories,categoryName|max:255',
            'categoryDesc' => 'required|string|min:10',
        ]);

        $this->categotyModel->create($data);
        session()->flash('done', 'Category was added');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'categoryName' => 'required|string|min:3|max:255',
            'categoryDesc' => 'required|string|min:10',
        ]);

        $updateCategory = $this->categotyModel->find($id);

        if ($updateCategory) {

            $updateCategory->update($data);

            session()->flash('done', 'Category was updated');

            return redirect()->back();
        }

        session()->flash('error', 'Category Is Not Found');

        return redirect()->back();
    }

    public function delete($id)
    {
        $deleteCategory = $this->categotyModel->find($id)->delete();

        if($deleteCategory){

            $deleteCategory->delete();
            session()->flash('done', 'Category was deleted');
            return redirect()->back();
        }
        session()->flash('error', 'Category Is Not Found');
        return redirect()->back();
    }
}
