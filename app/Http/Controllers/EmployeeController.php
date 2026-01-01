<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Authenticate user
        $user = Auth::user();
        $yourTasks = Task::with([
            'assignee' => function($query){
                $query->select();
            },
            'assigner' => function($query){
                $query->select();
            },
        ])
        ->select("*")
        ->where('assigned_to', $user->id)
        ->paginate(5);

        return view('employee.tasks.index', [
            "yourTasks" => $yourTasks,
        ]);
    }

    public function edit($id)
    {
        $status = config('status.task');
        
        $task = Task::find($id);
        return view('employee.tasks.edit',[
            "task" => $task,
            "status" => $status
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $data = [
            'status' => $request->status
        ];

        $task = Task::find($id);
        $task->status = $request->status;
        $task->save();

        return redirect()->route('employee.your.tasks.index')->with('success','Task status update successfully');
    }
}
