<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Tasks') }}
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
                        <th>Title</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                         <th>Assigned By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tasks) > 0)
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$task->title}}</td>
                            <td>{{$task->due_date}}</td>
                            <td>{{$task->status}}</td>
                            <td>{{ $task->assignee ? $task->assignee->first_name." ".$task->assignee->first_name : '-' }}</td>
                            <td>{{ $task->assigner ? $task->assigner->first_name." ".$task->assigner->first_name : "-"}}</td>
                            <td>
                                <a href="{{ route('manager.assign.form', $task->id) }}">Assign Task</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5">No data Available</td></tr>
                    @endif    
                </tbody>
            </table>
        </div>
        {{$tasks->links()}}
    </div>        
</x-app-layout>  