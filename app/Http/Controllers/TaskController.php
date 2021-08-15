<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリ
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * タスク一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$tasks = Task::orderBy('created_at','asc')->get();  //データベースからの取得を行っている。
       // $tasks = $request->user()->tasks()->get();  //認証済みのユーザーを取得している。保持してるタスク一覧を取得
        return view('tasks.index', [    //tasks.indexのビューを使用する。
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * タスク登録
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [     //パラメーターが有効かどうかのバリデーション
            'name' => 'required|max:255',   //マックス255文字
        ]);

        // タスク作成   
        // Task::create([  //tasks
        //     'user_id' => 0,
        //     'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        return redirect('/tasks');
    }

    /**
     * タスク削除
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task); //ユーザーごとにタスク管理ができる。ユーザー自身のタスクしか削除できないようになった。

        $task->delete();
        return redirect('/tasks');
    }
}
