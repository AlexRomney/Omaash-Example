@extends('emails')

@section('head-title')
   Submission Created
@endsection

@section('image-url')
{{ url('/images/emails/email-header.jpg') }}
@endsection

@section('email-heading')
   Submission Created
@endsection

@section('email-greeting')
    Congrats on submitting your cards with Omaash!
@endsection

@section('content')
<p>{{$name}} here is your unique submission ID:</p>

<p style="margin-top: 16px; padding: 12px 16px; text-align: center; background: #EEEEEE; font-weight: bold; font-family: 'Bungee';">{{ $submission->sub_id }}</p>

<p style="margin-top: 16px;">
    You can check the status of your submission anytime while you wait for your cards to be returned. To do this, simply head to 
    the Omaash website, click on the middleman tab, and input your submission ID. 
</p>

<div style="margin: 0 auto; width: 100%; text-align: center;">
    <a class="btn" style="margin: 16px 0;" target="_blank" href={{ url(env('APP_URL') . "/middleman/submission-printout/{$submission->sub_id}") }}>View Submission Details</a>
</div>

<p style="margin-top: 16px;">
    You will be notified by Omaash when the cards have been returned and are ready to be sent back.
</p>
@endsection

