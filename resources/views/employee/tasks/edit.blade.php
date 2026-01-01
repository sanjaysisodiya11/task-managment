<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Task Status') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
           <form method="post" action="{{route('employee.your.tasks.update', $task->id)}}">
                @csrf
                <input type="hidden" name="task_id" value="{{$task->id}}" />
                <div class="form-group">
                    <p>Title: {{$task->title}}</p>
                </div>

                <div class="form-group">
                    <select name="status">
                        @foreach($status as $key=>$value)
                            <option value="{{$key}}" {{$task->status===$key ? "selected" : ""}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Update</button>
           </form>
        </div>
    </div>        
</x-app-layout>  