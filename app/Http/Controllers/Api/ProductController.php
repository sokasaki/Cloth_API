<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Clothes API",
 *      description="API for managing clothes products",
 *      @OA\Contact(
 *          email="nolpiseth6666@gmail.com"
 *      )
 * )
 */
class ProductController extends Controller
{
    protected $imageFields = ['main_image', 'front_image', 'back_image', 'side_image'];

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get all products",
     *     @OA\Response(response=200, description="Success")
     * )
     */
    public function index()
    {
        $products = Product::with(['category', 'colors', 'sizes', 'additionalImages'])
            ->latest()
            ->paginate(15);

        return ProductResource::collection($products);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create a new product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="category_id", type="integer"),
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="price", type="number"),
     *                 @OA\Property(property="main_image", type="string", format="binary"),
     *                 @OA\Property(property="front_image", type="string", format="binary"),
     *                 @OA\Property(property="back_image", type="string", format="binary"),
     *                 @OA\Property(property="side_image", type="string", format="binary"),
     *                 @OA\Property(
     *                     property="additional_images",
     *                     type="array",
     *                     @OA\Items(type="string", format="binary")
     *                 ),
     *                 @OA\Property(property="colors", type="array", @OA\Items(type="integer")),
     *                 @OA\Property(property="sizes", type="array", @OA\Items(type="integer"))
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created"),
     *     @OA\Response(response=422, description="Validation Error")
     * )
     */

    public function store(Request $request)
    {
        // Handle colors and sizes as comma-separated strings or arrays
        if (is_string($request->colors)) {
            $request->merge(['colors' => array_map('intval', explode(',', $request->colors))]);
        }
        if (is_string($request->sizes)) {
            $request->merge(['sizes' => array_map('intval', explode(',', $request->sizes))]);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'main_image' => 'nullable|file|max:5120',
            'front_image' => 'nullable|file|max:5120',
            'back_image' => 'nullable|file|max:5120',
            'side_image' => 'nullable|file|max:5120',
            'additional_images.*' => 'nullable|file|max:5120',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Exclude colors and sizes from mass assignment data
        $data = collect($data)->except(['colors', 'sizes'])->toArray();

        // handle fixed images
        foreach ($this->imageFields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('products', 'public');
            }
        }

        $product = Product::create($data);

        // handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $img) {
                $product->additionalImages()->create([
                    'image' => $img->store('products/additional', 'public')
                ]);
            }
        }

        // sync colors & sizes
        $product->colors()->sync($request->colors ?? []);
        $product->sizes()->sync($request->sizes ?? []);

        return response()->json(new ProductResource($product->load(['category', 'colors', 'sizes', 'additionalImages'])), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Get single product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        $product = Product::with(['category', 'colors', 'sizes', 'additionalImages'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(new ProductResource($product), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/products/{id}",
     *     summary="Update a product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"_method"},
     *
     *                 @OA\Property(property="_method", type="string", example="PUT"),
     *
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="price", type="number"),
     *                 @OA\Property(property="category_id", type="integer"),
     *
     *                 @OA\Property(
     *                     property="colors",
     *                     type="array",
     *                     @OA\Items(type="integer")
     *                 ),
     *
     *                 @OA\Property(
     *                     property="sizes",
     *                     type="array",
     *                     @OA\Items(type="integer")
     *                 ),
     *
     *                 @OA\Property(property="main_image", type="string", format="binary"),
     *                 @OA\Property(property="front_image", type="string", format="binary"),
     *                 @OA\Property(property="back_image", type="string", format="binary"),
     *                 @OA\Property(property="side_image", type="string", format="binary"),
     *
     *                 @OA\Property(
     *                     property="additional_images[]",
     *                     type="array",
     *                     @OA\Items(type="string", format="binary")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::with(['category', 'colors', 'sizes', 'additionalImages'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Convert comma strings to arrays
        if (is_string($request->colors)) {
            $request->merge(['colors' => array_map('intval', explode(',', $request->colors))]);
        }
        if (is_string($request->sizes)) {
            $request->merge(['sizes' => array_map('intval', explode(',', $request->sizes))]);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric',
            'main_image' => 'nullable|file|max:5120',
            'front_image' => 'nullable|file|max:5120',
            'back_image' => 'nullable|file|max:5120',
            'side_image' => 'nullable|file|max:5120',
            'additional_images.*' => 'nullable|file|max:5120',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = collect($validator->validated())->except(['colors', 'sizes'])->toArray();

        // Update fixed images (main, front, back, side)
        foreach ($this->imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($product->{$field}) {
                    Storage::disk('public')->delete($product->{$field});
                }
                $data[$field] = $request->file($field)->store('products', 'public');
            }
        }

        // Update product
        $product->update($data);

        // Update colors & sizes
        if ($request->has('colors')) {
            $product->colors()->sync($request->colors);
        }
        if ($request->has('sizes')) {
            $product->sizes()->sync($request->sizes);
        }

        // 🔥 NEW PART — Handle additional images
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $img) {
                $product->additionalImages()->create([
                    'image' => $img->store('products/additional', 'public')
                ]);
            }
        }

        return response()->json(
            new ProductResource($product->fresh(['category', 'colors', 'sizes', 'additionalImages'])),
            200
        );
    }


    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Delete product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Deleted"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id)
    {
        $product = Product::with('additionalImages')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // delete main images
        foreach ($this->imageFields as $field) {
            if ($product->{$field}) {
                Storage::disk('public')->delete($product->{$field});
            }
        }

        // delete additional images
        foreach ($product->additionalImages as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}