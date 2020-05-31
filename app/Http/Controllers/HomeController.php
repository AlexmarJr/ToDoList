<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data =  DB::table('tasks')->where('id_user', '=', Auth::id())->where('status', '=', 0)->get();
        return view('home', compact('data'));
    }

    public function store_task(Request $request){
        $id = $request->get('id', false);
        $attr['id_user'] = Auth::id();
        $attr['task_name'] = $request->task_name;
        $attr['priority'] = $request->priority;
        $attr['date'] = $request->date;
        $attr['hour'] = $request->time;
        $attr['description'] = $request->description;
        $attr['status'] = 0;
        try{
            if($id){
                $task = Tasks::find($id);
                $task->fill($attr);
                $task->save();
                flash("Task Modified")->warning();
                return redirect()->route('home');
            }
            else{
                Tasks::create($attr);
                flash('Task Added')->success();
                return redirect()->route('home');
            }
        }
        catch (\Exception $e){
            flash($e)->error();
            return redirect()->route('home');
        }
    }

    public function read($id){
        $data =  DB::table('tasks')->where('id_user', '=', Auth::id())->where('status', '=', 0)->get();
        $head = Tasks::find($id);
        return view('home', compact('data', 'head'));
    }

    public function delete($id){
        $head = Tasks::find($id);
        $head->delete();
        return redirect()->route('home');
    }

    public function deleteAll(){
        $head = DB::table('tasks')->where('id_user', '=', Auth::id())->where('status', '=', 1)->delete();
        flash('All Hitoric Tasks Deleted')->warning();
        return redirect()->route('home');
    }

    public function taskFinished($id){
        $head = Tasks::find($id)->update(['status' => 1]);
        flash('Task Finished')->success();
        return redirect()->route('home');
    }

    public function historic(){
        $data =  DB::table('tasks')->where('id_user', '=', Auth::id())->where('status', '=', 1)->get();
        return view('historic', compact('data'));
    }
}
