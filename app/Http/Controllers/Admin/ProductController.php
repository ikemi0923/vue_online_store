<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images' => function ($query) {
            $query->orderBy('order');
        }])->orderBy('created_at', 'desc')->paginate(5);

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
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($request->hasFile('images')) {
                $order = ProductImage::where('product_id', $product->id)->max('order') ?? 0;

                foreach ($request->file('images') as $image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('products', $filename, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                        'order' => ++$order,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', '商品が追加されました！');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => '商品の追加に失敗しました。' . $e->getMessage()]);
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

            $uploadedImages = [];

            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {


                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('products', $filename, 'public');

                    $imageRecord = ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                    ]);

                    $uploadedImages[] = [
                        'id' => $imageRecord->id,
                        'path' => asset('storage/' . $path),
                    ];
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', '商品が更新されました！');
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => '商品の更新に失敗しました。',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateImageOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            if (!isset($request->images) || empty($request->images)) {
                return response()->json(['success' => false, 'message' => '画像順序データが空です。'], 400);
            }

            foreach ($request->images as $index => $imageData) {
                ProductImage::where('id', $imageData['id'])
                    ->update(['order' => $index + 1]);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => '画像の順番を更新しました。']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => '画像順序更新に失敗しました。', 'error' => $e->getMessage()], 500);
        }
    }



    public function deleteImage($id)
    {
        $image = ProductImage::find($id);

        if (!$image) {
            return response()->json(['error' => '画像が見つかりません'], 404);
        }

        Storage::delete('public/' . $image->path);

        $image->delete();

        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            DB::table('order_details')->where('product_id', $id)->delete();
            DB::table('order_items')->where('product_id', $id)->delete();
            DB::table('product_images')->where('product_id', $id)->delete();
            DB::table('products')->where('id', $id)->delete();

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', '商品を削除しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', '商品削除に失敗しました: ' . $e->getMessage());
        }
    }
}
