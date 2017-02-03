<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Staff;
use App\Countries;
use DB;

class StaffController extends Controller
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
        $staffs = Staff::all();

        return view('staff.stafflist', [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries = Countries::all();

        return view('staff.register', ['countries' => $countries]);
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
            'title' => 'required',
            'first_name' => 'required|max:120',
            'gender' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'city' => 'required',
            'contact_person_title' => 'required',
            'contact_person_first_name' => 'required',
            'contact_person_relation' => 'required',
            'contact_person_contact_no' => 'required',
            'login_name' => 'required|max:100',
            'password' => 'required|confirmed|min:6'],
            [
                'code.required' => 'Employee code is required',
                'title.required' => 'EMployee title is required',
                'first_name.required' => 'Employee first name is required',
                'first_name.max' => 'Employee first name is too long',
                'gender.required' => 'Employee gender is required',
                'email.required' => 'Employee email is required',
                'mobile.required' => 'Employee mobile is required',
                'address.required' => 'Employee address is required',
                'city.required' => 'Employee city is required',
                'contact_person_title.required' => 'Emergency contact title is required',
                'contact_person_first_name.required' => 'Emergency contact first name is required',
                'contact_person_relation.required' => 'Emergency contact relationship is required',
                'contact_person_contact_no.required' => 'Emergency contact number is required',
                'login_name.required' => 'Username is required',
                'login_name.max' => 'Username is too long',
                'password.required' => 'Password is required',
                'password.min' => 'Password is too short, minimum 6 characters required'
            ]);

        try {
            DB::beginTransaction();

            // construct joined_date
            $joined_date_array = explode('-', $request->joined_date);
            $joined_date = date('Y-m-d', mktime(0, 0, 0, $joined_date_array[1], $joined_date_array[0], $joined_date_array[2]));

            // construct date_of_birth
            $dob_array = explode('-', $request->date_of_birth);
            $dob = date('Y-m-d', mktime(0, 0, 0, $dob_array[1], $dob_array[0], $dob_array[2]));

            $staff = new Staff();
            $staff->code = $request->code;
            $staff->title = $request->title;
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->joined_date = $joined_date;
            $staff->address = $request->address;
            $staff->city = $request->city;
            $staff->country = $request->country;
            $staff->telephone = $request->telephone;
            $staff->mobile = $request->mobile;
            $staff->email = $request->email;
            $staff->date_of_birth = $dob;
            $staff->gender = $request->gender;
            $staff->contact_person_title = $request->contact_person_title;
            $staff->contact_person_first_name = $request->contact_person_first_name;
            $staff->contact_person_last_name = $request->contact_person_last_name;
            $staff->contact_person_relation = $request->contact_person_relation;
            $staff->contact_person_contact_no = $request->contact_person_contact_no;
            $staff->save();

            $user = new User();
            $user->login_name = $request->login_name;
            $user->password = bcrypt($request->password);
            $user->branch_id = $request->branch_id;
            $user->staff_id = $staff->id;
            $user->is_admin = $request->is_admin;
            $user->save();

            DB::commit();
        }
        catch(Exception $e) {
            DB::rollBack();
            return redirect()->action('StaffController@create');
        }

        return redirect()->action('StaffController@show', [$staff->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('staff.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        try {
            Staff::destroy($request->id);

            $request->session()->flash('success', 'Staff deleted!');
            return redirect()->route('staff_list');
        } catch (\Exception $e) {
            $request->session()->flash('fail', 'An error occured while deleting staff. Please try again!');
            return redirect()->route('staff_list');
        }
    }
}
