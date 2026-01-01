<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
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
            <form method="post" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PATCH')
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name', $user->name)}}">
                    @error('name')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{old('first_name', $user->first_name)}}">
                    @error('name')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{old('last_name', $user->last_name)}}">
                    @error('name')
                        <p class="error">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{old('email', $user->email)}}" readonly>
                    @error('name')
                        <p>{{$message}}</p>
                    @enderror
                </div>
                
                <select name="role">
                    @foreach($roles as $key=>$role)
                        <option value="{{$key}}" {{ $user->role === $key ? 'selected' : '' }}>{{$role}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</x-app-layout> 
