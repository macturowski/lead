<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find($id);
        return view('prices.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceRequest $request)
    {
        $price = Price::create(['name' => $request->name, 'price' => $request->price, 'product_id' => $request->product_id]);
        return redirect()->route('products.edit', ['product' => $price->product_id])->with('message', trans('messages.success_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        $product = Product::find($price->product_id);
        return view('prices.edit',['price' => $price, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePriceRequest  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceRequest $request, Price $price)
    {
        $price->fill($request->validated());
        $price->save();
        return redirect()->route('products.edit', ['product' => $price->product_id])->with('message', trans('messages.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //dd($price);
        $price->delete();
        return redirect()->route('products.edit', ['product' => $price->product_id])->with('message', trans('messages.success_delete'));
    }
}
