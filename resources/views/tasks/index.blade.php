<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
</head>
<body>
    <h1>All Tasks</h1>
    <a href="{{ route('tasks.create') }}">create tasks</a><br><br>

    {{-- <form action="{{route('search_task')}}" method="GET">
        --}}
        
    </form>
    <table border="1">
        <tr>
        <td>task index</td>
        <td>task title</td>
        <td>task description</td>
        <td>task status</td>
        <td>assigned to</td>
        
     </tr>
     @foreach ($tasks as $task)
     <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$task->title}}</td>
        <td>{{$task->description}}</td>
        <td>{{$task->status}}</td>
        <td>{{$task->user_id}}</td>
        <td><a href="{{route('tasks.edit',$task->id)}}">edit</a></td>
        <td>
            <form action="{{route('tasks.destroy',$task->id)}}" method="POST">

            @csrf
            @method('DELETE')
            <input type="submit" value="delete">
            </form>
        </td>
     </tr>
         
     @endforeach
    </table>
</html>