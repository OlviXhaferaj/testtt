<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    //         /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $list_user = User::all();
        if($request->wantsJson()){
            $user = User::latest()->get();
            return datatables()->of($user)
                    ->addIndexColumn()
                    ->addColumn('action', function (User $user){
                        $actionBtn = '
                        <div class="d-flex">
                            <a href="'.route('users.edit',$user->id).'" title="Edit User" class="edit btn btn-success btn-sm">Edit </a>
                            <form action="'.route('users.destroy',$user->id).'" method="POST">
                            '.csrf_field().'
                            '.method_field("DELETE").'
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm(\'Are You Sure Want to Delete?\')">Delete</a>
                            </form>
                        </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // showing when creating a new user
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // setting the fields as required
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string'],
            'nikName' => ['string'],
            'gender' => ['required', 'string'],
            'city' => ['required', 'string'],
            'date_of_birth' => ['date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 

        //saving the user in the database
        // User::create($request->post());
        User::create([
            'name' =>  $request->name,
            'lastName' =>  $request->lastName,
            'nikName' =>  $request->nikName,
            'gender' =>  $request->gender,
            'city' =>  $request->city,
            'date_of_birth' =>  $request->date_of_birth,
            'email' =>  $request->email,
            'password' => Hash::make( $request->password),
        ]);
        return redirect()->route('users.index')->with('success','The user has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // get a specific user
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // show which user will be updated
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // update and save the new information for the user
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'date_of_birth' => 'required'
        ]);
        $user-> password = Hash::make($request->password);
        $user-> name = $request->name;
        $user-> lastName = $request->lastName;
        $user-> email = $request->email;
        $user-> city = $request->city;
        $user-> date_of_birth = $request->date_of_birth;

        $user->save();

        return redirect()->route('users.index')->with('success', 'User information has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','The user has been deleted successfully');
    }
}
