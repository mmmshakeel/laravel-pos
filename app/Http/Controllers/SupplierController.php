<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Countries;
use App\Supplier;

class SupplierController extends Controller
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
        $suppliers = Supplier::all();

        return view('supplier.supplierlist', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // get all the countries for the countries dropdown
        $countries = Countries::all();
        return view('supplier.addsupplier', ['countries' => $countries]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'code' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_first_name' => 'required',
            'contact_last_name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:10|max:13']);

        try {
            $supplier = new Supplier();

            $supplier->code = $request->code;
            $supplier->company_name = $request->company_name;
            $supplier->address = $request->address;
            $supplier->city = $request->city;
            $supplier->country = $request->country;
            $supplier->contact_title = $request->contact_title;
            $supplier->contact_first_name = $request->contact_first_name;
            $supplier->contact_last_name = $request->contact_last_name;
            $supplier->contact_mobile = $request->contact_mobile;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;

            $supplier->save();

            $request->session()->flash('success', 'Supplier ' . $request->code . ' saved!');
            return redirect()->action('SupplierController@create');
        } catch (Exception $ex) {
            $request->session()->flash('fail', 'An error occured while saving supplier ' . $request->code . '. Please try again!');
            return redirect()->action('SupplierController@create');
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
        // get all the countries for the countries dropdown
        $countries = Countries::all();
        $supplier = Supplier::find($id);

        return view('supplier.editsupplier', ['countries' => $countries, 'supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $this->validate($request, [
            'code' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_first_name' => 'required',
            'contact_last_name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:10|max:13']);

        try {
            $supplier = Supplier::find($request->id);

            $supplier->code = $request->code;
            $supplier->company_name = $request->company_name;
            $supplier->address = $request->address;
            $supplier->city = $request->city;
            $supplier->country = $request->country;
            $supplier->contact_title = $request->contact_title;
            $supplier->contact_first_name = $request->contact_first_name;
            $supplier->contact_last_name = $request->contact_last_name;
            $supplier->contact_mobile = $request->contact_mobile;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;

            $supplier->save();

            $request->session()->flash('success', 'Supplier ' . $request->code . ' updated!');
            return redirect()->action('SupplierController@index');
        } catch (Exception $ex) {
            $request->session()->flash('fail', 'An error occured while updating supplier ' . $request->code . '. Please try again!');
            return redirect()->action('SupplierController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {

        try {
            Supplier::destroy($request->id);

            $request->session()->flash('success', 'Supplier ' . $request->code . ' deleted!');
            return redirect()->action('SupplierController@index');
        } catch (Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting supplier ' . $request->code . '. Please try again!');
            return redirect()->action('SupplierController@index');
        }
    }
}
