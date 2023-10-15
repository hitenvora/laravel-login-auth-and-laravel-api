<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Register;
use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  Validator;

class RegisterController extends BaseController
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
    public function register(request $request)
    {
        $validtor = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required',
            'password' => 'required'

        ]);

        if ($validtor->fails()) {
            return sendErrore('Validation Erroe', $validtor->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $data = User::create($input);
        $success['token'] = $data->createToken('api')->accessToken;
        $success['name'] = $data->name;
        return $this->sendresponse($success, 'thanks for created an account');
    }

    //login user
    public function login(request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('api')->accessToken;
            $success['name'] = $user->name;
            return $this->sendresponse($success, 'user login successfully');
        }
        return $this->erroreresponse('unothriszed', [
            'errore' => 'unothriszed'
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = User::all();
        return $this->sendresponse(Register::collection($data), 'user data succesfully fetched');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = user::where('id', $id)->first();
        return $this->sendresponse($edit, 'user edit succesfully');
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
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $data = user::where('id', $id)->update($input);
        return $this->sendresponse($data, 'user data update succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = user::where('id', $id)->delete();
        return $this->sendresponse($delete, 'user delete succesfully');
    }
}
