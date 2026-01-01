<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form method="post" action="{{ route('admin.tasks.update',$task->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{old('title', $task->title)}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" value="{{old('description', $task->description)}}">
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" class="form-control" value="{{old('due_date', $task->due_date)}}">
                </div>

                <select name="status">
                    @foreach($status as $key=>$name)
                        <option value="{{$key}}" {{  $task->status==="$key" ? 'selected' : ''}}>{{$name}}</option>
                    @endforeach
                </select>

                <button type="submit">update</button>
            </form>
        </div>
    </div>
</x-app-layout> 
