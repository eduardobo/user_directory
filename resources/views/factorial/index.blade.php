@extends('master')

@section('title', 'Factorial')

@section('content')
<div class="mt-3">
    <div class="text-center">
        <h1 class="text-2xl">Factorial</h1>
    </div>

    <div class="mx-auto border m-3 lg:w-1/2 md:w-2/3 sm:w-full rounded-lg">
        <form id="factorial_form" class="mx-3 my-4">
            <div class="text-center">
                <label for="number" class="mr-7">Number</label>
                <input class="border" type="number" name="number" id="number"/>
                <div>
                    <span id="number_error" class="text-sm text-red-400"></span>
                </div>
            </div>

            <div class="bg-gray-100 m-3 hidden" id="result_container">
                <p>The factorial is: <span id="result"></span></p>
            </div>

            <div class="mt-4 text-right">
                <button type="submit" 
                    class="bg-cyan-500 mt-1 px-2 rounded-lg text-white font-semibold">
                    Calculate Factorial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#factorial_form').submit((event) => {
    event.preventDefault();
    $('#result_container').hide();
    $('#number_error').hide();
    $('#result').text('');

    let number = $('#number').val();
    let data = {number};

    fetch('/api/factorial/calulate_factorial', {
        method: 'post',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then((response) => {
        // if(!response.ok) {
        //     throw Error(response.status);
        // }

        return response.json();
    })
    .then((data) => {
        if(data.error) {
            $('#number_error').text(data.error);
            $('#number_error').show();
            return;
        }

        $('#result').text(data.factorial);
        $('#result_container').show();
    });
});

$('#number').change(() => {
    $('#result_container').hide();
    $('#number_error').hide();
    $('#result').text('');
});
</script>
@endsection
