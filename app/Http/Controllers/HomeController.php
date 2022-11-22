<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $tasks = Task::with('user')->get();
        return view('pages.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
        ]);
        $task = new Task();
        $task->name = $request->input('name');
        $task->user_id = auth()->id();
        $task->save();
        $request->session()->flash('message', 'Task successfully created');
        return redirect()->back();
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('pages.edit', ['task' => $task]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4',
        ]);
        $task = Task::findOrFail($id);
        $task->name = $request->input('name');
        $task->save();
        $request->session()->flash('message', 'Task updated');
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        session()->flash('message', 'Task successfully deleted');
        return redirect()->back();
    }
}
