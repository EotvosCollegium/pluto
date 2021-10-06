<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Support\Facades\Date;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos_to_be_done = auth()->user()->todos_assigned()->where('completed', false)->get();
        $completed_count = Todo::where('completed', true)->count(); //int
        $expired_count = Todo::where('expiration_date', '<', now())->count(); //int

        return view('todos.index', [
            'todos' => $todos_to_be_done, 
            'completed_count' => $completed_count,
            'expired_count' => $expired_count,
        ]);
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
        //$todo = Todo::create($request->all());

        Validator::make($request->all(), [
            'name' => 'required|alpha|max:255',
            'description' => 'nullable',
        ])->validate();
        
        
        $todo = Todo::create([
            'name' => $request->name,
            'description' => $request->description,   
            //'completed' => false, //default false in sql
            'user_id' => $request->user()->id, //or auth()->user()->id
        ]);
        $todo->assigned_users()->attach($request->user()->id);
        return back()->with('message', __('todo.created'));
                                    //a toast message will appear, see layouts.app.blade
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo) //ha itt megadjuk, hogy Todo tipusu: automatikusan lekeri az adatbazisbol
    {

        //adott id-ju todo lekérdezése:
        //$todo = Todo::find($todo);
        //$todo = Todo::where('id', $todo)->get(); //lista (collection)
        //$todo = Todo::where('id', $todo)->get()->first(); //lekerjuk az osszes todot, majd az elso elemet visszaadjuk, nem optimalis
        //$todo = Todo::where('id', $todo)->first(); //csak az elso elemet kerjuk le
        //$todo = Todo::where('id', $todo)->firstOrFail(); //ha nem talalja, akkor hiba


        //query builder: ->get()-nel keri le az adatbazisbol
        //a get kivalthato pl. first-tel
        $completed_count = Todo::where('completed', true)->count(); //int
        $expired_count = Todo::where('expiration_date', '<', now())->count(); //int

        return view('todos.index', [
            'todos' => [$todo], 
            'completed_count' => $completed_count,
            'expired_count' => $expired_count
        ]);

    }

    public function markAsDone(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return back()->with('message', __('todo.marked_as_done'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        if($request->has('user_id')){
            Validator::make($request->all(), [
                'user_id'=> 'exists:users,id'
            ])->validate();
            $todo->assigned_users()->attach($request->user_id);
        }
        return back()->with('message', __('todo.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
