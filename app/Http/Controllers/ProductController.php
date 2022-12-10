<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Price;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\File;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
        ->allowedSorts('name')
        ->defaultSort('name')
        ->allowedFilters(['name'])
        ->paginate(9)
        ->appends(request()->query());

        $search = $request->input('filter.name');
        $sort = $request->input('sort');

        return view('products.index', ['products' => $products, 'search' => $search, 'sort' => $sort]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create(['name' => $request->name, 'description' => $request->description]);
        $image = $request->image;
        if($image) 
        {
            $image = Image::make($image);
            $image->fit(450, 450, function ($constraint) {
                $constraint->upsize();
            });
            $time = time();
            $newname = $time.'.jpg';
            $image->save('images/'.$newname, 80);
            $product->update(['image' => $newname]);
        }
        return redirect()->route('products.index')->with('message', trans('messages.success_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       return view('products.show',['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
       
       return view('products.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {   
        $product = $product::findOrFail($product->id);
        $product->fill($request->safe()->only(['name', 'description']));
        $product->save();

        if($request->deleteimage || $request->image) {
            File::delete('images/' . $product->image);
            $product->update(['image' => '']);
        }
        
        $image = $request->image;
        if($image) 
        {
            $image = Image::make($image);
            $image->fit(450, 450, function ($constraint) {
                $constraint->upsize();
            });
            $time = time();
            $newname = $time.'.jpg';
            $image->save('images/'.$newname, 80);
            $product->update(['image' => $newname]);
        }

        return redirect()->route('products.index')->with('message', trans('messages.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        File::delete('images/' . $product->image);
        Price::where('product_id', $product->id)->delete();
        $product->delete();
        return redirect()->route('products.index')->with('message', trans('messages.success_delete'));
    }
}
