<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with([
            'creater' => function($query){
                $query->select('*');
            },
            'assignee' => function($query){
                $query->select('*');
            },
            'assigner' => function($query){
                $query->select('*');
            }
        ])
        ->select('*')
        ->whereIn('status',['pending','in_progress','completed'])
        ->orderBy('id','desc')
        ->paginate(5);
        
        return view('admin.tasks.index',[
            'tasks'=>$tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = config('status.task');

        return view('admin.tasks.create',[
            "status" => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        //print_r($user->first_name);die;
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'status' => $request->status,
            'created_by' => auth()->id()
        ];
        $task = Task::create($data);
        return redirect()->route('admin.tasks.index')->with('success','Task created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = config('status.task');
        $task = Task::find($id);

        return view('admin.tasks.edit',[
            'task' => $task,
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'status' => $request->status,
        ];
        Task::where('id',$id)->update($data);

        return redirect()->route('admin.tasks.index')->with('success','task update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully');
    }
}
