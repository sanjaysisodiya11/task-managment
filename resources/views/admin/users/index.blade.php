<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <h3><a href="{{ url('admin/user/create') }}">Add New</a></h3>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{ucfirst($user->role)}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{ route('admin.users.edit', $user->id) }}">Edit</a> | 
                            <form action="{{route('admin.users.destroy',$user->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" />
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$users->links()}}
    </div>    
</x-app-layout>    
