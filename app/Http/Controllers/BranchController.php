<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Countries;
use App\Branch;

class BranchController extends Controller
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

        $branches = Branch::all();

        return view('branch.branchlist', ['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        // get all the countries for the countries dropdown
        $countries = Countries::all();

        return view('branch.addbranch', ['countries' => $countries]);
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
            'description' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_no' => 'required|min:10|max:13']);

        try {
            $branch = new Branch();

            $branch->code = $request->code;
            $branch->description = $request->description;
            $branch->address = $request->address;
            $branch->city = $request->city;
            $branch->country = $request->country;
            $branch->contact_no = $request->contact_no;
            $branch->contact_email = $request->contact_email;

            $branch->save();

            $request->session()->flash('success', 'Branch ' . $request->code . ' saved!');
            return redirect()->action('BranchController@create');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while saving branch ' . $request->code . '. Please try again!');
            return redirect()->action('BranchController@create');
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
        $branch = Branch::find($id);

        return view('branch.editbranch', ['countries' => $countries, 'branch' => $branch]);
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
            'description' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_no' => 'required|min:10|max:13']);

        try {
            $branch = Branch::find($request->id);

            $branch->code = $request->code;
            $branch->description = $request->description;
            $branch->address = $request->address;
            $branch->city = $request->city;
            $branch->country = $request->country;
            $branch->contact_no = $request->contact_no;
            $branch->contact_email = $request->contact_email;

            $branch->save();

            $request->session()->flash('success', 'Branch ' . $request->code . ' updated!');
            return redirect()->action('BranchController@index');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while updating branch ' . $request->code . '. Please try again!');
            return redirect()->action('BranchController@index');
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
            Branch::destroy($request->id);

            $request->session()->flash('success', 'Branch ' . $request->code . ' deleted!');
            return redirect()->action('BranchController@index');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting branch ' . $request->code . '. Please try again!');
            return redirect()->action('BranchController@index');
        }

    }
}
