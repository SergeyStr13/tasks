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
      	//$tasks = $this->tasks->forUser($request->user());
    	/* 	сделано через отношения
    		$tasks = $request->user()->tasks()->get(); */
		$tasks = Task::all();
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
		dd($request->file('image'));

		$request->user()->tasks()->create([
			'name' => $request->post('name'),
			'image' =>$request->file('image')->store('images')
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
    public function update(Request $request, Task $task) {
       /*$request->user()->tasks()->update([
			'name' => $request->post('name'),
			'image' =>$request->file('image')->store('images')
		]);*/

       	return redirect('/tasks');
    }

	/**
	 * @param Request $request
	 * @param Task $task
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function destroy(Request $request, Task $task) {
    	$this->authorize('destroy', $task);

    	//Task::destroy($task);
		$task->delete();
    	return redirect('/tasks');
    }
}
