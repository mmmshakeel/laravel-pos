<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Staff;
use DB;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'scontact_person_first_name' => 'required',
            'contact_person_relation' => 'required',
            'contact_person_contact_no' => 'required',
            'login_name' => 'required|max:100',
            'password' => 'required|confirmed|min:6'
        ]);

        try {
            DB::beginTransaction();

            // construct joined_date 
            $joined_date_array = explode('/', $request->joined_date);
            $joined_date = date('Y-m-d', mktime(0, 0, 0, $joined_date_array[1], $joined_date_array[0], $joined_date_array[2]));

            // construct date_of_birth
            $dob_array = explode('/', $request->date_of_birth);
            $dob = date('Y-m-d', mktime(0, 0, 0, $dob_array[1], $dob_array[0], $dob_array[2]));

            $staff = new Staff();
            $staff->code            = $request->code;                
            $staff->title           = $request->title;
            $staff->first_name      = $request->first_name;
            $staff->last_name       = $request->last_name;
            $staff->joined_date     = $joined_date;
            $staff->address         = $request->address;
            $staff->city            = $request->city;
            $staff->country         = $request->country;
            $staff->telephone       = $request->telephone;
            $staff->mobile          = $request->mobile;
            $staff->email           = $request->email;
            $staff->date_of_birth   = $dob;
            $staff->gender          = $request->gender;          
            $staff->contact_person_title        = $request->contact_person_title;
            $staff->scontact_person_first_name  = $request->scontact_person_first_name;
            $staff->contact_person_last_name    = $request->contact_person_last_name;
            $staff->contact_person_relation     = $request->contact_person_relation;
            $staff->contact_person_contact_no   = $request->contact_person_contact_no;
            $staff->creation_date   = date('Y-m-d : H:i:s');

            $staff->save();

            $user = new User();
            $user->login_name       = $request->login_name;
            $user->password         = bcrypt($request->password);
            $user->branch_id        = $request->branch_id;
            $user->staff_id         = $staff->id;
            $user->is_admin         = $request->is_admin;
            $user->creation_date    = date('Y-m-d H:i:s');

            $user->save();

            DB::commit();
        } catch (Exception $e) {
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
    public function show($id)
    {
        return view('staff.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
