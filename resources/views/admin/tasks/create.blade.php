<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="error">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <form method="post" action="{{ route('admin.tasks.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" value="{{old('description')}}">
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" class="form-control" value="{{old('due_date')}}">
                </div>

                <select name="status">
                    @foreach($status as $key=>$name)
                        <option value="{{$key}}">{{$name}}</option>
                    @endforeach
                </select>

                <button type="submit">Add</button>
            </form>
        </div>
    </div>
</x-app-layout> 
