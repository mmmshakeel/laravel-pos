<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $brands = Brand::all();

        return view('product.product-brands', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, ['name' => 'required|unique:brand|max:255']);

        try {
            $brand = new Brand();

            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->save();

            $request->session()->flash('success', 'Brand ' . $request->name . ' saved!');
            return redirect()->route('product_brand');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while saving brand ' . $request->name . '. Please try again!');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $brand = Brand::find($id);

        return view('product.product-brand-edit', ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $this->validate($request, ['name' => 'required|unique:brand,name,'. $request->id .'|max:255']);

        try {
            $brand = Brand::find($request->id);

            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->save();

            $request->session()->flash('success', 'Brand ' . $request->name . ' updated!');
            return redirect()->route('product_brand');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while updating brand ' . $request->name . '. Please try again!');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        try {
            Brand::destroy($request->id);

            $request->session()->flash('success', 'Brand ' . $request->name . ' deleted!');
            return redirect()->route('product_brand');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting brand ' . $request->name . '. Please try again!');
            return redirect()->route('product_brand');
        }
    }
}
