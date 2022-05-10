@extends('master')

@section('title', 'Palindrom')

@section('content')
<div class="mt-3">
    <div class="text-center">
        <h1 class="text-2xl">Palindrom</h1>
    </div>

    <div class="mx-auto border m-3 lg:w-1/2 md:w-2/3 sm:w-full rounded-lg">
        <form id="palindrom_form" class="mx-3 my-4">
            <div class="text-center">
                <label for="text" class="mr-7">text</label>
                <input class="border" type="text" name="text" id="text"/>
                <div>
                    <span id="text_error" class="text-sm text-red-400"></span>
                </div>
            </div>

            <div class="bg-gray-100 m-3 hidden" id="result_container">
                <p id="result"></p>
            </div>

            <div class="mt-4 text-right">
                <button type="submit" 
                    class="bg-cyan-500 mt-1 px-2 rounded-lg text-white font-semibold">
                    Check Palindrom
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#palindrom_form').submit((event) => {
    $('#result').removeClass('text-red-400');
    $('#result').removeClass('text-green-400');

    event.preventDefault();
    $('#result_container').hide();
    $('#text_error').hide();
    $('#result').text('');

    let text = $('#text').val();
    let data = {text};

    fetch('/api/palindrom/check_palindrom', {
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
            $('#text_error').text(data.error);
            $('#text_error').show();
            return;
        }

        $('#result').text(data.message);
        $('#result').addClass(data.color);
        $('#result_container').show();
    });
});

$('#text').change(() => {
    $('#result_container').hide();
    $('#text_error').hide();
    $('#result').text('');
});
</script>
@endsection
