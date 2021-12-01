<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            $tasks = Task::with('user')->paginate(8);
        }else{
            $tasks = Task::where('user_id', auth()->user()->id)->with('user')->paginate(8);
        }
    
        return view('home',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Task::rules());

        $record = Task::create([
            'user_id'       => auth()->user()->id,          
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        $task = Task::with('user')->findOrFail($record->id);

        return response()->json($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, Task::rules());

        $task->update([
            'user_id'       => auth()->user()->id,          
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        $task = Task::with('user')->findOrFail($task->id);

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json('success', 'Task deleted successfully.');
    }
}
