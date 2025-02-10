<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $product = new Product();
        $product->setRelation('images', collect());
        return view('admin.products.add', compact('product'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'file|max:5120',
            ]);
            DB::beginTransaction();
            $product = Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'description' => $validated['description'] ?? null,
            ]);
            if ($request->hasFile('images')) {
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $order = 0;
                foreach ($request->file('images') as $image) {
                    $mimeType = $image->getMimeType();
                    $extension = $image->guessExtension();
                    if (!in_array($mimeType, $allowedMimeTypes) || !in_array($extension, $allowedExtensions)) {
                        throw new Exception('不正な画像形式です: ' . $mimeType . ' (' . $extension . ')');
                    }
                    $filename = uniqid() . '.' . $extension;
                    $path = $image->storeAs('products', $filename, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                        'order' => $order++,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', '商品が追加されました！');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'images' => 'nullable|array',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $product->update([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'description' => $validated['description'] ?? null,
            ]);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('products', $filename, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', '商品が更新されました！');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => '商品の更新に失敗しました。' . $e->getMessage()]);
        }
    }

    public function updateImageOrder(Request $request)
    {
        try {
            $orders = $request->input('order');
            foreach ($orders as $item) {
                ProductImage::where('id', $item['id'])->update(['order' => $item['order']]);
            }

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = ProductImage::findOrFail($imageId);
            Storage::disk('public')->delete($image->path);
            $image->delete();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
