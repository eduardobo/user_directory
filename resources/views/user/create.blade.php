@extends('master')

@section('title', 'User')

@section('content')
<div class="mt-3">
    <div class="text-center my-3">
        <h1 class="text-2xl">{{ $user->id ? 'Updating' : 'Creating' }} User</h1>
    </div>

    <div class="border rounded rounded-lg p-4 lg:w-1/2 md:w-2/3 sm:w-full mx-auto">
        <div class="lg:w-1/2 md:w-2/3 sm:w-full mx-auto">
            <div class="w-full my-3">
                <div>
                    <label for="name">Name</label>
                </div>

                <input type="text" name="name" id="name"
                    class="border rounded rounded-lg w-full"
                    value="{{ $user->name }}">

                <div>
                    <span class="text-red-500 hidden" id="error_name">Error field required</span>
                </div>
            </div>

            <div class="w-full my-6">
                <div>
                    <label for="age">Age</label>
                </div>

                <input type="number" name="age" id="age" min="0"
                    class="border rounded rounded-lg w-full"
                    value="{{ $user->age }}">

                <div>
                    <span class="text-red-500 hidden" id="error_age">Error field required</span>
                </div>
            </div>

            <div class="w-full my-3">
                <input type="checkbox" name="status" id="status" value="1"
                    {{ $user->active ? 'checked' : '' }}>
                <label for="status">Active</label>

                <div>
                    <span class="text-red-500 hidden" id="error_active">Error field required</span>
                </div>
            </div>
        </div>

        <div class="text-right mt-3">
            <a href="{{ route('user.index') }}" 
                class="border rounded-lg py-1 px-2 mr-3 hover:bg-gray-200">
                Cancel
            </a>

            <button type="button"
                class="bg-green-500 hover:bg-green-600 rounded-lg py-1 px-2 text-white"
                id="btn_submit">
                {{ $user->id ? 'Update' : 'Create' }} user
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#btn_submit').click(() => {
    let url = "{{ $user->id ? route('user.update', $user->id) : route('user.store') }}";

    let data = {
        name: $('#name').val(),
        age: $('#age').val(),
        active: $('#status')[0].checked
    };

    fetch(url,
    {
        method: "{{ $user->id ? 'PATCH' : 'POST' }}",
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
    })
    .then((response) =>  response.json())
    .then((response) => {
        if(response.errors) {
            if(response.errors.name) {
                $('#error_name').text(response.errors.name);
                $('#error_name').show();
            }

            if(response.errors.age) {
                $('#error_age').text(response.errors.age);
                $('#error_age').show();
            }

            if(response.errors.active) {
                $('#error_active').text(response.errors.active);
                $('#error_active').show();
            }
            
            return;
        }

        window.location.replace("{{ route('user.index') }}");
    });
});

$('#name').change(() => {
    $('#error_name').hide();
});

$('#age').change(() => {
    $('#error_age').hide();
});

$('#status').change(() => {
    $('#error_active').hide();
});
</script>
@endsection