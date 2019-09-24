@extends('layouts.app')

@section('content')
	<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи -->
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}

      <!-- Имя задачи -->
      <div class="form-group">
        <label for="task" class="col-sm-6 control-label">Задача</label>

        <div class="col-sm-3">
          <input type="text" name="name" id="task-name" class="form-control">
        </div>
      </div>

      <!-- Кнопка добавления задачи -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-default">
            <i class="fa fa-plus"></i> Добавить задачу
          </button>
        </div>
      </div>
    </form>
	<hr>
	<div class="container">
		@foreach($tasks as $task)
			<div>{{$task->name}}</div>
			<form action="{{url('task/'.$task->id)}}" method="post">
				{{ csrf_field() }}
				{{ method_field('DELETE')}}
				<button type="submit" id="delete-task-{{$task->id}}">
					<i class="fa fa-btn fa-trash">Удалить</i>
				</button>
			</form>
		@endforeach
	</div>
  </div>
@endsection