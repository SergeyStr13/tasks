<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {

	protected $tasks;
	/**
	 * TaskController constructor.
	 */
	public function __construct(TaskRepository $tasks) {
		$this->middleware('auth');
		$this->tasks = $tasks;
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
    	$tasks = $this->tasks->forUser($request->user());
    	/* 	сделано через отношения
    		$tasks = $request->user()->tasks()->get(); */
		//$tasks = Task::all();
        return view('tasks.index', compact('tasks'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
     	$this->validate($request, [
       		'name' => 'required|max:255'
	   	]);
		//$userId = Auth::user()->id;
		$request->user()->tasks()->create([
			'name' => $request->post('name')
		]);

		/*
		 * $task = new Task([
			'name' => $request->post('name'),
			'user_id' => $userId
		]);
		$task->save();*/
       	return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task) {
    	$this->authorize('destroy', $task);

    	//Task::destroy($task);
		$task->delete();
    	return redirect('/tasks');
    }
}
