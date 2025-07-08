<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'sku' => 'required|string|unique:products,sku',
                'active' => 'boolean',
                'image_url' => 'nullable|string',
            ]);
            
            // Convert string values to appropriate types
            if (isset($validatedData['price'])) {
                $validatedData['price'] = (float) $validatedData['price'];
            }
            
            if (isset($validatedData['stock_quantity'])) {
                $validatedData['stock_quantity'] = (int) $validatedData['stock_quantity'];
            }
            
            if (isset($validatedData['active'])) {
                $validatedData['active'] = (bool) $validatedData['active'];
            }

            $product = Product::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'description' => 'nullable|string',
                'price' => 'numeric|min:0',
                'stock_quantity' => 'integer|min:0',
                'sku' => 'string|unique:products,sku,' . $product->id,
                'active' => 'boolean',
                'image_url' => 'nullable|string',
            ]);
            
            // Convert string values to appropriate types
            if (isset($validatedData['price'])) {
                $validatedData['price'] = (float) $validatedData['price'];
            }
            
            if (isset($validatedData['stock_quantity'])) {
                $validatedData['stock_quantity'] = (int) $validatedData['stock_quantity'];
            }
            
            if (isset($validatedData['active'])) {
                $validatedData['active'] = (bool) $validatedData['active'];
            }

            $product->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
