<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto space-y-8">
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-slate-800 pb-5">
            <div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Task Dashboard</h1>
                <p class="text-slate-400 text-sm mt-1">Manage your daily goals and stay productive.</p>
            </div>
            <div class="bg-indigo-600/10 border border-indigo-500/20 text-indigo-400 px-4 py-2 rounded-xl text-sm font-semibold flex items-center gap-2">
                <i class="fa-solid fa-list-check"></i>
                <span>{{ $tasks->count() }} Total Tasks</span>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl text-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Add Task Card -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-2xl p-6 shadow-xl backdrop-blur-sm">
            <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-indigo-400"></i>
                Add New Task
            </h2>
            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="task_name" class="block text-xs font-medium text-slate-300">Task Title *</label>
                        <input type="text" name="task_name" id="task_name" required placeholder="What needs to be done?" 
                            class="w-full bg-slate-900/80 border border-slate-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 outline-none transition">
                    </div>
                    <div class="space-y-1">
                        <label for="due_date" class="block text-xs font-medium text-slate-300">Due Date</label>
                        <input type="date" name="due_date" id="due_date" 
                            class="w-full bg-slate-900/80 border border-slate-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white outline-none transition">
                    </div>
                </div>
                <div class="space-y-1">
                    <label for="description" class="block text-xs font-medium text-slate-300">Description</label>
                    <textarea name="description" id="description" rows="2" placeholder="Add optional details..." 
                        class="w-full bg-slate-900/80 border border-slate-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white placeholder-slate-500 outline-none transition resize-none"></textarea>
                </div>
                <button type="submit" 
                    class="w-full md:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm rounded-xl transition shadow-lg shadow-indigo-600/20 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> Save Task
                </button>
            </form>
        </div>

        <!-- Task List Table -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-2xl overflow-hidden shadow-xl">
            <div class="p-5 border-b border-slate-700/60 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white">Your Tasks</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-900/40 text-slate-400 text-xs uppercase tracking-wider border-b border-slate-700/60">
                            <th class="p-4">Task</th>
                            <th class="p-4">Description</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Due Date</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40 text-sm">
                        @forelse($tasks as $task)
                            <tr class="hover:bg-slate-700/20 transition">
                                <td class="p-4 font-medium text-white">
                                    <span class="{{ $task->status === 'Completed' ? 'line-through text-slate-400' : '' }}">
                                        {{ $task->task_name }}
                                    </span>
                                </td>
                                <td class="p-4 text-slate-400 max-w-xs truncate">
                                    {{ $task->description ?? '—' }}
                                </td>
                                <td class="p-4">
                                    @if($task->status === 'Completed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                            <i class="fa-solid fa-check text-[10px]"></i> Completed
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                            <i class="fa-regular fa-clock text-[10px]"></i> Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-slate-400 text-xs">
                                    <i class="fa-regular fa-calendar mr-1"></i>
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No deadline' }}
                                </td>
                                <td class="p-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <form action="{{ route('tasks.toggleStatus', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                title="Toggle Status"
                                                class="px-3 py-1.5 rounded-lg text-xs font-medium {{ $task->status === 'Pending' ? 'bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600/30' : 'bg-amber-600/20 text-amber-400 hover:bg-amber-600/30' }} transition">
                                                <i class="fa-solid {{ $task->status === 'Pending' ? 'fa-check' : 'fa-rotate-left' }}"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('tasks.edit', $task) }}" 
                                           title="Edit Task"
                                           class="px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-700 text-slate-300 hover:bg-slate-600 transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                title="Delete Task"
                                                class="px-3 py-1.5 rounded-lg text-xs font-medium bg-rose-600/20 text-rose-400 hover:bg-rose-600/30 transition">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-500">
                                    <i class="fa-solid fa-inbox text-3xl mb-2 block text-slate-600"></i>
                                    No tasks found. Add your first task above!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html> 