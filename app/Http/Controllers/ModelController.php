<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductModel;
use App\Brand;

class ModelController extends Controller
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
        $models = ProductModel::all();

        return view('product.product-models', ['models' => $models, 'brands' => $brands]);
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

        $this->validate($request, [
            'name' => 'required|max:255',
            'brand_id' => 'required']);

        try {
            $product_model = new ProductModel();

            $product_model->name = $request->name;
            $product_model->description = $request->description;
            $product_model->brand_id = $request->brand_id;
            $product_model->save();

            $request->session()->flash('success', 'Model ' . $request->name . ' saved!');
            return redirect()->route('product_model');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while saving model ' . $request->name . '. Please try again!');
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
        $brands = Brand::all();
        $model = ProductModel::find($id);

        return view('product.product-model-edit', ['model' => $model, 'brands' => $brands]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:255',
            'brand_id' => 'required']);

        try {
            $product_model = ProductModel::find($request->id);

            $product_model->name = $request->name;
            $product_model->description = $request->description;
            $product_model->brand_id = $request->brand_id;
            $product_model->save();

            $request->session()->flash('success', 'Model ' . $request->name . ' updated!');
            return redirect()->route('product_model');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while updating model ' . $request->name . '. Please try again!');
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
            $product_model = ProductModel::find($request->id);
            ProductModel::destroy($request->id);

            $request->session()->flash('success', 'Model ' . $product_model->name . ' deleted!');
            return redirect()->route('product_model');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting model ' . $product_model->name . '. Please try again!');
            return redirect()->route('product_model');
        }

    }
}
