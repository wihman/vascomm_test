<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::all();
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Banners retrieved successfully.'
        ];

        return response()->json($response);
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
            'image' => $path,
            'uraian' => $request->uraian
        ];

        try {
            $banner = Banner::create($data);
            $response = [
                'success' => true,
                'data' => $banner,
                'message' => 'Banner created successfully.'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Banner created failed.',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        $data = Banner::find($banner->id);
        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Banner retrieved successfully.'
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $path = Storage::putFile(
                'public/images',
                $request->file('image')
            );
        } else {
            $path = Banner::where('id', $id)->first()->image;
        }

        $data = [
            'name' => $request->name,
            'image' => $path,
            'uraian' => $request->uraian
        ];

        try {
            $banner = Banner::where('id', $id)->update($data);
            $response = [
                'success' => true,
                'data' => $banner,
                'message' => 'Banner updated successfully.'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Banner updated failed.',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::where('id', $id)->delete();
            $response = [
                'success' => true,
                'data' => $banner,
                'message' => 'Banner deleted successfully.'
            ];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'data' => 'Banner deleted failed.',
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }
}
