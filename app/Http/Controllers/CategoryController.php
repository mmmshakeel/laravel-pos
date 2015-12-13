<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
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

        $categories = Category::all();

        return view('product.product-categories', ['categories' => $categories]);
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

        $this->validate($request, ['name' => 'required|unique:category|max:255']);

        try {
            $category = new Category();

            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            $request->session()->flash('success', 'Category ' . $request->name . ' saved!');
            return redirect()->route('product_category');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while saving category ' . $request->name . '. Please try again!');
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
        $category = Category::find($id);

        return view('product.product-category-edit', ['category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $this->validate($request, ['name' => 'required|unique:category,name,'. $request->id .'|max:255']);

        try {
            $category = Category::find($request->id);

            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            $request->session()->flash('success', 'Category ' . $request->name . ' updated!');
            return redirect()->route('product_category');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while updating category ' . $request->name . '. Please try again!');
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
            Category::destroy($request->id);

            $request->session()->flash('success', 'Category ' . $request->name . ' deleted!');
            return redirect()->route('product_category');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting category ' . $request->name . '. Please try again!');
            return redirect()->route('product_category');
        }
    }
}
