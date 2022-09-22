@extends('statamic::layout')
@section('title', 'Postmark made easy')

@section('content')
    <div class="flex items-start flex-col mb-3">
        <h1 class="flex-1">Postmark made easy</h1>
        <p class="text-sm">
            We've installed all the packages and will change the env file to use postmark for you. You just need your postmark API key.
            <br>
            Don't know how to find it? try this link <a class="text-blue-300" href="https://docs.gravityforms.com/get-postmark-api-keys/" target="_blank">here</a>
            <br>
            And you can test it to with the email form test at the bottom of this page
        </p>
    </div>
    <div class="mb-3">
        <div class="card mt-2">
            <p><strong>Current Status:</strong> On/off</p>
        </div>
        <div class="mt-2">
            <publish-form
                title="Settings"
                action="{{ cp_route('weareframework.postmark-made-easy.dashboard.update-settings') }}"
                :blueprint='@json($blueprint)'
                :meta='@json($meta)'
                :values='@json($values)'
            />
        </div>
        <div class="card mt-2">
            <p @class('mb-1')><strong>Testing</strong> <br> We will use the email set above to send a test email through postmark.</p>
            @if(isset($values['postmark_made_easy_mail_driver']) && !is_null($values['postmark_made_easy_mail_driver']) && !empty($values['postmark_made_easy_mail_driver']))
                <a href="{{ cp_route('weareframework.postmark-made-easy.dashboard.send-test') }}" class="btn">Send test email</a>
            @else
                <p>No email set above in settings</p>
            @endif

        </div>
    </div>
@stop
