<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - Personal Task Manager</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #eef2f3 0%, #8e9eab 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card { 
            width: 100%;
            max-width: 550px; 
            background: #ffffff; 
            padding: 35px 30px; 
            border-radius: 12px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); 
        }
        .card-header {
            border-bottom: 2px solid #eef2f3;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        h1 { 
            color: #2c3e50; 
            font-size: 24px;
            font-weight: 700;
        }
        .form-group { 
            margin-bottom: 20px; 
            display: flex; 
            flex-direction: column; 
        }
        label { 
            font-weight: 600; 
            margin-bottom: 8px; 
            color: #4a5568; 
            font-size: 14px;
        }
        input[type="text"], 
        input[type="date"], 
        textarea { 
            padding: 12px; 
            border: 1px solid #cbd5e0; 
            border-radius: 6px; 
            font-size: 15px; 
            outline: none;
            transition: all 0.2s ease-in-out;
            font-family: inherit;
        }
        input[type="text"]:focus, 
        input[type="date"]:focus, 
        textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }
        .btn { 
            flex: 1;
            padding: 12px; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            color: white; 
            font-size: 15px;
            font-weight: 600; 
            text-decoration: none; 
            text-align: center;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .btn-primary { background-color: #0d6efd; }
        .btn-primary:hover { background-color: #0b5ed7; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5c636a; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h1>✏️ Edit Task</h1>
        </div>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" id="task_name" value="{{ $task->task_name }}" required placeholder="Enter task name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Enter task details">{{ $task->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ $task->due_date }}">
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>