<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search_category' => 'nullable|integer|exists:categories,id',
            'search' => 'nullable|string|max:255',
        ]);
        
        $search = $request->search;
        $searchCategory = $request->search_category;
        $query = Product::orderBy('id', 'desc');
        
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($searchCategory)) {
            $query->where('category_id', $searchCategory);
        }

        $data = $query->paginate(10);
        $categories = Category::all();

        return view('products.index', compact('data', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        
        return view('products.create-and-edit', compact('categories'));
    }

    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $categories = Category::all();
        
        // if ($data->product_images->isNotEmpty()) {
        //     dd(asset($data->product_images[0]->filename));
        // }
        
        return view('products.create-and-edit', compact('data', 'categories'));
    }

    public function view()
    {
        return view('products.view');
    }

    public function createProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'date_and_time' => 'required|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = new Product;
        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->description = $request->description;
        $data->date_and_time = $request->date_and_time;
        $data->save();
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $imageName);
    
                $productImage = new ProductImage;
                $productImage->product_id = $data->id;
                $productImage->filename = 'uploads/products/' . $imageName;
                $productImage->save();
            }
        }

        return redirect()->route('products')->with('success', 'Product created successfully.');
    }

    public function editProcess(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'date_and_time' => 'required|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = Product::findOrFail($id);
        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->description = $request->description;
        $data->date_and_time = $request->date_and_time;
        $data->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $imageName);
    
                $productImage = new ProductImage;
                $productImage->product_id = $data->id;
                $productImage->filename = 'uploads/products/' . $imageName;
                $productImage->save();
            }
        }

        return redirect()->route('products')->with('success', 'Product edited successfully.');
    }

    public function delete($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }

    public function delete_product_image(Request $request, $id)
    {
        $data = ProductImage::findOrFail($id);
        $data->delete();
        
        return response()->json(['message' => 'Product Image deleted successfully.']);
    }
}
