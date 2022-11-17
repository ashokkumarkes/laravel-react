<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserInterface as UserInterface;   
use App\Models\User;
class UserController extends Controller
{
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $u = new User();

        dd($u->post());
        $users = $this->user->getAll();
        dd($users);
        return view('users.index',['users']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('users.show',['user']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->user->delete($id);
        return response()->json('success');
    }
    public function find($id){
        $users = $this->user->find($id);
        return response()->json($users);
    }
    public function update(Request $request){
        
        if($request->image){
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }
        print_r($imageName);
        
        // $this->user->find($request->id)->update([
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'image'=> $imageName
        // ]);
        // return response()->json('success');
    }

}
