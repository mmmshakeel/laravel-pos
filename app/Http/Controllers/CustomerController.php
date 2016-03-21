<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request, $type = '')
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required',
            'first_name' => 'required',
            'country_id' => 'required',
            'mobile'     => 'required']);

        if ($validator->fails()) {
            if ($type == 'ajax') {
                return 'Please check the required fields.';
            } else {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        try {
            $customer             = new Customer();
            $customer->title      = $request->title;
            $customer->first_name = $request->first_name;
            $customer->last_name  = $request->last_name;
            $customer->address    = $request->address;
            $customer->city       = $request->city;
            $customer->country_id = $request->country_id;
            $customer->email      = $request->email;
            $customer->mobile     = $request->mobile;
            $customer->telephone  = $request->telephone;
            $customer->notes      = $request->notes;
            $customer->save();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function ajaxStore(Request $request)
    {
        $result = $this->store($request, 'ajax');
        if ($result === true) {
            echo 'SUCCESS';
        } else {
            echo $result;
        }
    }

    public function getCustomerDetailsById($id)
    {
        $customer = Customer::find($id);

        echo json_encode([
            'id'         => $customer->id,
            'title'      => $customer->title,
            'first_name' => $customer->first_name,
            'last_name'  => $customer->last_name,
            'address'    => $customer->address,
            'city'       => $customer->city,
            'country'    => $customer->country->country_name,
            'email'      => $customer->email,
            'mobile'     => $customer->mobile,
            'telephone'  => $customer->telephone,
        ]);
    }
}
