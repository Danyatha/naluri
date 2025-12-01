<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $id = 'id_product';
    public function index()
    {
        $products = Product::with('category', 'images')->paginate(20);
        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Request $request)
    {
        $Idadmin = Auth::id();
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'id_category' => 'required|exists:categories,id_category',
            'images.*' => 'nullable|image|max:4096'
        ]);

        $data['updated_by'] = $Idadmin;
        $product = Product::create($data);

        // handle images (optional)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                try {
                    $path = $file->store('products', config('filesystems.default'));
                } catch (\Exception $e) {
                    return back()->withErrors(['image_upload' => 'Failed to upload image: ' . $e->getMessage()])->withInput();
                }
                ProductImage::create(['id_product' => $product->id_product, 'image_url' => $path]);
            }
        }


        ActivityLog::create(['id_admin' => $Idadmin, 'action' => 'create', 'entity' => 'product', 'entity_id' => $product->id_product, 'description' => 'Created product']);


        return redirect()->route('admin.products.index')->with('success', 'Product created');
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $Idadmin = Auth::guard('admin')->user()->id_admin;
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'id_category' => 'required|exists:categories,id_category',
            'images.*' => 'nullable|image|max:4096'
        ]);


        $data['updated_by'] = $Idadmin;
        $product->update($data);
        // handle images (optional)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', config('filesystems.default'));
                ProductImage::create(['id_product' => $product->id_product, 'image_url' => $path]);
            }
        }

        ActivityLog::create(['id_admin' => $Idadmin, 'action' => 'update', 'entity' => 'product', 'entity_id' => $product->id_product, 'description' => 'Updated product']);

        return redirect()->route('admin.products.index')->with('success', 'Product updated');
    }


    public function destroy(Product $product)
    {
        $Idadmin = Auth::id();

        foreach ($product->images as $image) {
            Storage::disk(config('filesystems.default'))->delete($image->image_url);
            $image->delete();
        }

        $product->delete();
        ActivityLog::create(['id_admin' => $Idadmin, 'action' => 'delete', 'entity' => 'product', 'entity_id' => $product->id_product, 'description' => 'Deleted product']);
        return back()->with('success', 'Deleted');
    }
}
