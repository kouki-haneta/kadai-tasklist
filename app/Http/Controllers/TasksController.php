<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;       // 追加

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        //return view('tasks.index',['tasks'=> $tasks,]);
        
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            
            $tasks = Task::all();
            
            $data = [
                'user' => $user,
                'tasks' => $tasks
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create',['task'=>$task,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
            ]);

        $task = new Task;
        $task->user_id = \Auth::id();  //追加
        $task->status = $request->status;  // 追加
        $task->content = $request->content;
        $task->save();
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        /*$request->user()->tasks()->create([
            'content' => $request->content,
        ]);*/
        
        return redirect('/');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        return view('tasks.show', ['task'=>$task,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        return view('tasks.edit', ['task'=> $task]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
            ]);
        
        $task = Task::findOrFail($id);
        
        $task->status = $request->status;    // 追加
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        $task->delete();
        
        return redirect('/');
        
    }
}
