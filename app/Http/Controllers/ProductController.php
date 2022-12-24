<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $response = [
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully.'
        ];

        return response()->json($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = Storage::putFile(
            'public/images',
            $request->file('image')
        );

        $data = [
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'description' => $request->description,
            'image' => $path,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ];

        try {
            $product = Product::create($data);
            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Product created successfully.'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Error creating product.',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $idproduct
     * @return \Illuminate\Http\Response
     */
    public function show($idproduct)
    {
        $data = Product::find($idproduct);
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Product retrieved successfully.'
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $idproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idproduct)
    {
        if($request->hasFile('image')){
            $path = Storage::putFile(
                'public/images',
                $request->file('image')
            );

            $data = [
                'name' => $request->name,
                'slug' => \Str::slug($request->name),
                'description' => $request->description,
                'image' => $path,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
        }else{
            $data = [
                'name' => $request->name,
                'slug' => \Str::slug($request->name),
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
        }

        try {
            $product = Product::find($idproduct);
            $product->update($data);
            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Product updated successfully.'
            ];
            return response()->json($response);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Error updating product.',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $idproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($idproduct)
    {
        try {
            $product = Product::find($idproduct);
            $product->delete();
            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Product deleted successfully.'
            ];
            return response()->json($response);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Error deleting product.',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }
}
