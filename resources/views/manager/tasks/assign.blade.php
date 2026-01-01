<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <p><b>Title:</b> {{$task->title}}</p>
            </div>
            <form action="{{ route('manager.assign.task') }}" method="post">
                @csrf
                <input type="hidden" name="task_id" value="{{$task->id}}"/>
                <select name="assigned_to">
                    @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{ $employee ? $employee->first_name." ".$employee->first_name : "-" }}</option>
                    @endforeach
                </select>
                <br/>    
                <button type="submit">Assign</button>
            </form>    
        </div>
    </div>        
</x-app-layout>  