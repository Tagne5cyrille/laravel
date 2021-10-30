<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // Stone all users
    public $users;

    public function __contruct(){

        $this->users = User::getAllUsers();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Assing a todo to an user
     * 
     * @param App\Models\Todo  $todo
     * @param App\Models\User  $users
     * @return \illuminate\Http\Response
     *  */ 
    public function AffectedTo(Todo $todo, User $user){
        $todo->Affectedto_id = $user->id;
        $todo->AffectedBy_id = Auth::user()->id;
        $todo->update();

        return back();
    }
    

    public function index()
    {
        $userId = Auth::user()->id;
        $datas = Todo::where(['affectedto_id' => $userId])->orderBy('id','desc')->paginate(10);
        // $datas = Todo::all()->reject(function($todo){
        //     return $todo->done == 0;
        // });
        // dd($datas);
        $users = User::all();
        //on ne connaissaient pas le responsive d'un site
        return view('todos.index', compact('datas', 'users'));
    }
    /***
     * liste des todos non terminées
     */
    public function undone(){

        $datas = Todo::where('done',0)->paginate(11);
        $users = $this->users;
        return view('todos.index', compact('datas', 'users'));
    }
    public function done(){

        $datas = Todo::where('done',1)->paginate(11);
        $users = $this->users;
        return view('todos.index', compact('datas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->creator_id = Auth::user()->id;
        $todo->Affectedto_id = Auth::user()->id;
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->save();
        notify()->success(" La todo  vient d'etre crée");

        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
      return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Todo $todo)
    {   
        if(!isset($request->done)){
            $request['done'] = 0;
        };
        $todo->update($request->all());
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
       $todo->delete();
       return back();
    }
    /**
     * change le status d'un todo en done
     * 
     * @param Todo $todo
     * @return void
     * */
     public function makedone(Todo $todo)
    {
        # code...
        $todo->done = 1;
        $todo->update();
        return back();
    }


       /**
     * change le status d'une todo en done
     * 
     * @param Todo $todo
     * @return void
     * */
    public function makeundone(Todo $todo)
    {
        # code...
        $todo->done = 0;
        $todo->update();
        return back();
    }
  


}
