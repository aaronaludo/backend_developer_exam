<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search_column' => 'nullable|string',
            'search' => 'nullable|string|max:255',
        ]);
        
        $search = $request->search;
        $search_column = $request->search_column;
        
        $allowed_columns = [
            'id', 'name', 'created_at', 'updated_at'
        ];
        
        if (!in_array($search_column, $allowed_columns)) {
            $search_column = null;
        }

        $data = Category::orderBy('id', 'desc')
            ->when($search && $search_column, function ($query) use ($search, $search_column) {
                return $query->where($search_column, 'like', "%{$search}%");
            })->paginate(10);

        return view('categories.index', compact('data'));
    }

    public function create()
    {
        return view('categories.create-and-edit');
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);

        return view('categories.create-and-edit', compact('data'));
    }

    public function view()
    {
        return view('categories.view');
    }

    public function createProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $data = new Category;
        $data->name = $request->name;
        $data->save();
        
        return redirect()->route('categories')->with('success', 'Category created successfully.');
    }

    public function editProcess(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $data = Category::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('categories')->with('success', 'Category edited successfully.');
    }

    public function delete($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }
}
