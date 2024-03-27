<?php

namespace App\Http\Controllers;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = auth()->user();
        $reviews = new Reviews();

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            ]);
        $reviews->title = $request->title;
        $reviews->user_id = $user;
        $reviews->product_id = $request->productId;
       // $reviews->rating = $request->rating;
        $reviews->description = $request->description;
        
        $reviews->save();
        
        return view('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
