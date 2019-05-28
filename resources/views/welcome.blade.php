<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact Form</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container">

                <h1 class="text-center mt-3">Contact Form</h1>

                {{--include message--}}
                @include('inc.message')

                {{--Fields for the contact form--}}

                {{ csrf_field() }}

                <div class="col-md-12">
                    {!! Form::open(['action' => 'ContactController@sendMail', 'method' => 'post', 'name' => 'forms', 'onsubmit' => 'return validation()']) !!}
                    <div class="form-group">
                        <label>Name</label>
                        {{ Form::text('name','', ['class' => 'form-control', 'id' => 'name', 'onblur' => 'return onBlur("name")']) }}
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        {{ Form::email('email','', ['class' => 'form-control', 'id' => 'email', 'onblur' => 'return onBlur("email")']) }}
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        {{ Form::textarea('message','', ['class' => 'form-control', 'rows' => 5, 'id' => 'message', 'onblur' => 'return onBlur("message")']) }}
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <script>
            // validation data, if a field has no value then return required = true
            function validation(){
                let name = document.getElementById('name');
                let email = document.getElementById('email');
                let message = document.getElementById('message');
                if(name.value == ''){
                    name.required = true;
                    return false;
                } else if(email.value == ''){
                    email.required = true;
                    return false;
                } else if(message.value == ''){
                    message.required = true;
                    return false;
                } else {
                    return true;
                }
            }

            // if a field has no value, then change the color of the border in red
            function onBlur(name){
                let input = document.getElementById(name);
                if(input.value == ''){
                    input.style.borderColor = 'red';
                }
            }

        </script>
    </body>
</html>
