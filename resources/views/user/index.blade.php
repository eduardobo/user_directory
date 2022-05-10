@extends('master')

@section('title', 'User')

@section('content')
<div class="mt-3">
    <div class="text-center">
        <h1 class="text-2xl">Users</h1>
    </div>

    <div class="mx-auto m-3 w-full">
        <div class="flex justify-between mb-3">
            <div>
                <a href="{{ route('user.create') }}" class="bg-green-500 hover:bg-green-600 rounded-lg text-white py-1 px-2">Add new user +</a>
            </div>

            <form>
                <div>
                    <label for="searcher">Search user</label>
                </div>

                <input class="border rounded-lg" type="text" name="searcher" id="searcher"
                    value="{{ request()->get('searcher') }}">


                <div class="text-right mt-1">
                    <button class="bg-green-500 hover:bg-green-600 rounded-lg text-white px-2"
                        id="search">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <table class="border rounded-lg border-collapse table-auto w-full text-sm text-left">
            <thead>
                <tr>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-2 pb-3">Id</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-2 pb-3">Name</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-2 pb-3">Age</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-2 pb-3">Status</th>
                    <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-2 pb-3">Options</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @foreach($users as $user)
                <tr>
                    <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">{{ $user->id }}</td>
                    <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">{{ $user->name }}</td>
                    <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">{{ $user->age }}</td>
                    
                    <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">
                        @if($user->active)
                            <span class="rounded bg-green-500 px-1 text-white">Active</span>
                        @else
                            <span class="rounded bg-red-500 px-1 text-white">Inactive</span>
                        @endif
                    </td>

                    <td class="border-b border-slate-100 p-4 pl-8 text-slate-700">
                        <a href="{{ route('user.edit', $user->id) }}"
                            class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 mr-2">
                            Edit
                        </a>

                        <button onclick="deleteUser({{ $user->id }})"
                            class="rounded-lg bg-red-500 hover:bg-red-600 text-white px-2 py-1">
                            delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteUser(id) {
        let url = "/api/user/" + id;

        console.log(url);
        let result = confirm("Are you sure to delete user with the id " + id + "?");

        if(result) {
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then((respose) => respose.json())
            .then((respose) => {
                window.location.replace("{{ route('user.index') }}");
            });
        }
    }
</script>
@endsection