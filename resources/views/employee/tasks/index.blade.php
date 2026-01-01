<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Tasks List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if(session('success'))
            <p class="success">{{session('success')}}</p>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Titleee</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Assigned By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($yourTasks) > 0)
                        @foreach($yourTasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->assigner ? $task->assigner->first_name." ".$task->assigner->last_name : "-" }}</td>
                                <td>
                                    <a href="{{route('employee.your.tasks.edit', $task->id)}}">Update Status</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="6">No Tasks assign</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{$yourTasks->links()}}
    </div>        
</x-app-layout>  