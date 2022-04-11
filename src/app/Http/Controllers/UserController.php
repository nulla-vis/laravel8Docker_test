<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return success_response(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request ->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = User::find($id);
            if (!$user) {
                return error_response('user not found');
            }
            return success_response($user);
        }catch (Exception $e) {
            return error_response($e->getMessage());
        }
        
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
        try{
            $user = User::find($id);
            if(!$user) {
                return error_response('user not found');
            }
            $user->update($request->all());
            return success_response($user);
        } catch(Exeption $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(User::destroy($id) == 0) {
                return error_message('User not found');
            }
            return success_message([]);
        } catch (Exeption $e) {
            return error_message($e->getMessage());
        }
    }

    /**
     * Search a user by username.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($username)
    {
        return User::where('username', 'like','%'.$username.'%')->get();
    }
}
