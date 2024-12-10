
@extends('emails')

@section('head-title')
   Submission Updated
@endsection

@section('image-url')
{{ url('/images/emails/email-header.jpg') }}
@endsection

@section('email-heading')
   Submission Updated
@endsection

@section('email-greeting')
    Great news!
@endsection

@section('content')

@if ($submission->status == 'shipped')

    <p>Your submission has been completed and is heading your way!</p>

    <p> The total for shipping is <strong>${{ $submission->shipping_fee }}</strong>. If you could send that my way via <strong>{{ ucfirst($submission->user->payment_type) }}</strong>
        that would be great.
    </p>

     <p> Thank you! </p>

    <p style="margin-top: 16px; padding: 12px 16px; background: #EEEEEE; font-weight: bold">Pay to: 
        @switch(strtolower($submission->user->payment_type))
            @case('paypal')
                omaashopenings@gmail.com
            @break
            
            @case ('venmo')
                AlexRomney
            @break

            @case ('cash app')
                $AlexRomney
            @break
        @endswitch
    </p>

     <p style="margin-top: 16px; padding: 12px 16px; background: #EEEEEE; font-weight: bold">
        Tracking: {{ $submission->tracking_number }}
    </p>

@else

    <p>Your submission with the following ID has been updated. Copy your sub ID and take a look!</p>

@endif

<p style="margin-top: 16px; padding: 12px 16px; text-align: center; background: #EEEEEE; font-weight: bold; font-family: 'Bungee';">{{ $submission->sub_id }}</p>

<div style="margin: 0 auto; width: 100%; text-align: center;">
    <a class="btn" style="margin-top: 16px;" target="_blank" href={{ url(env('APP_URL') . "/middleman") }}>Check Status</a>
</div>

@endsection
