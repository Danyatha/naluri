<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Product::with('category')->where('is_active', true);

            // Search
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                });
            }

            // Category Filter - pastikan kategori valid
            if ($request->filled('category') && $request->category != '' && is_numeric($request->category)) {
                $categoryId = (int) $request->category;
                $query->where('id_category', $categoryId);
            }

            // Price Range Filter
            if ($request->filled('min_price') && $request->min_price > 0) {
                $query->where('price', '>=', $request->min_price);
            }

            if ($request->filled('max_price') && $request->max_price > 0) {
                $query->where('price', '<=', $request->max_price);
            }

            // Sorting
            switch ($request->get('sort', 'newest')) {
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }

            $products = $query->paginate(12)->withQueryString();

            // Ambil kategori dengan jumlah produk aktif (tanpa filter is_active di categories)
            $categories = Category::withCount(['products' => function ($q) {
                $q->where('is_active', true);
            }])->get();

            return view('public.products.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            Log::error('Product Index Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat produk.');
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->findOrFail($id);

            return view('public.products.show', compact('product'));
        } catch (\Exception $e) {
            Log::error('Product Show Error: ' . $e->getMessage());
            abort(404, 'Produk tidak ditemukan');
        }
    }
}
