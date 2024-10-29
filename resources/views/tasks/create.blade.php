@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Task</h1>
    <form action="{{route('tasks.store')}}" method="Post">   
      @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>
        <div>
          <select name="status" >
            
                <option value="pending">pending</option>
                <option value="completed">completed</option>
            
            </select>
          </div>
        <div>
        <select name="user_id" id="">
          @foreach ($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary" value="submit">Save Task</button>
    </form>
</div>
@endsection
