@extends('layouts.app')

@section('content')

<!-- タスク登録用パネル… -->
<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- 新タスクフォーム -->
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- タスク名 -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Task</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>

        <!-- タスク追加ボタン -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
        </div>
    </form>
</div>

<!-- タスク一覧表示 -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Tasks
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- テーブルヘッダ -->
            <thead>
                <th>Task</th>
                <th>&nbsp;</th>
            </thead>

            <!-- テーブル本体 -->
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <!-- タスク名 -->
                    <td class="table-text">
                        <div>{{ $task->name }}</div>
                    </td>

                    <td>
                        <!-- TODO: 削除ボタン -->
                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection