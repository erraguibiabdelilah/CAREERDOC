<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat with OpenAI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        .response {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Chat with OpenAI</h1>

    <form action="{{ route('openai.chat') }}" method="POST">
        @csrf
        <textarea name="messages[0][content]" placeholder="Type your message here..."></textarea>
        <input type="hidden" name="messages[0][role]" value="user">
        <button type="submit">Send</button>
    </form>

    @isset($result)
    <div class="response">
        <h3>Response:</h3>
        @if(isset($result->original['choices'][0]['message']['content']))
            <p>{{ $result->original['choices'][0]['message']['content'] }}</p>

         
        @else
            <p>No response content found or error occurred.</p>
            @if(isset($result->original['error']))
                <p>Error: {{ $result->original['error'] }}</p>
            @endif
        @endif
    </div>
    @endisset


</body>
</html>
