<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

use Auth;

class EventsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // the code to work on later
        if($request->ajax()){
            $event = Event::latest()->get();
            return datatables()->of($event)
                    ->addIndexColumn()
                    ->addColumn('action', function (Event $event){
                        $actionBtn = '
                        <div class="d-flex">
                            <a href="'.route('events.edit',$event->id).'" title="Edit User" class="edit btn btn-success btn-sm">Edit </a>
                            <form action="'.route('events.destroy',$event->id).'" method="POST">
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
        return view('events.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'eventType' => 'required',
            'day' => 'required_without:event_trigger_date',
            'month' => 'required_without:event_trigger_date',
            'year' => 'required_without:event_trigger_date',
            'event_trigger_date' => 'required_without:year,month,day',
        ]); 
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $file_name = $request->file('image')->getClientOriginalName();
            $destination = public_path('images');
            $file_path = $file->move($destination,$file_name);

            $user_id = Auth::user()->id;

            Event::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' =>$file_name,
                'eventType' => $request->eventType,
                'day' => $request->day,
                'month' => $request->month,
                'year' => $request->year,
                'event_trigger_date' => $request->event_trigger_date,
                'user_id' => $user_id
            ]); 
        }

        return redirect()->route('events.index')->with('success','The Event has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // getting the user_id so we can fill in the filed user_id for one to many relationship
        $user_id = Auth::user()->id;

        // validating the request
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // 'image' => 'required',
            'eventType' => 'required',
            // if event_trigger_date has no data then day month and year is required
            'day' => 'required_without:event_trigger_date',
            'month' => 'required_without:event_trigger_date',
            'year' => 'required_without:event_trigger_date',
            'event_trigger_date' => 'required_without:year,month,day'
        ]);
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $file_name = $request->file('image')->getClientOriginalName();
            $destination = public_path('images');
            $file_path = $file->move($destination,$file_name);
            $event->image = $file_name;
        }
        $event->fill($request->post())->save();
        return redirect()->route('events.index')->with('success', 'Event information has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // deleting the images that are added in the public/images directory
        $destination = public_path('images/'.$event->image);
        if(File::exists($destination))
        {
            File::delete($destination);
        }

        // deleting the whole historic event $event
        $event->delete();
        return redirect()->route('events.index')->with('success','The Event has been deleted successfully');
    }
}
