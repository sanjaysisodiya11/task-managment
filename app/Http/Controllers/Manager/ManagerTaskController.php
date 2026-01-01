<?php

namespace App\Http\Controllers\Manager;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with([
            'creater' => function($query){
                $query->select("*");
            },
            'assignee' => function($query){
                $query->select("*");
            },
            'assigner' => function($query){
                $query->select("*");
            },
        ])
        ->select('*')
        ->whereIn('status',['pending','in_progress','completed'])
        ->orderBy('id', 'Desc')
        ->paginate(5);

        return view('manager.tasks.index', [
            "tasks" => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function assignForm($id)
    {
        $employees = User::select("*")
        ->whereIn('role',['employee'])
        ->get();

        $task = Task::find($id);
        
        return view('manager.tasks.assign',[
            "employees" => $employees,
            "task" => $task
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function asssignTask(Request $request)
    {
        $request->validate([
            "task_id" => "required",
            "assigned_to" => "required"
        ]);

        $task = Task::find($request->task_id);
        $task->assigned_to = $request->assigned_to;
        $task->assigned_by = auth()->id();
        $task->save();

        return redirect()->route('manager.assign.tasks.index')->with('success','Task Assigned Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
