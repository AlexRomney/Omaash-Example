
@extends('emails')

@section('head-title')
   Submission Reminder
@endsection

@section('image-url')
{{ url('/images/emails/email-header.jpg') }}
@endsection

@section('email-heading')
   Submission Reminder
@endsection

@section('email-greeting')
    Hey {{ $sub->user->username }},
@endsection

@section('content')
<p>
    You created a submission on <strong>{{ date('m/d/Y', strtotime($sub->created_at)) }}</strong> that has not been received yet. When you’re ready, please prepare 
    your cards and send them my way to begin the grading process. You can find lots of tips on the best way to package your cards on my website.
</p>

<p> I’m excited to help you get your cards graded! Thank you for using my service! </p>

<p style="margin-top: 16px; padding: 12px 16px; text-align: center; background: #EEEEEE; font-weight: bold; font-family: 'Bungee';">{{ $sub->sub_id }}</p>

<p style="margin-top: 16px;">If you wish to cancel your submission you can do so through your
    <a href={{ env('APP_URL') }}/middleman/submissions target="_blank" style="text-decoration: underline;">
        Omaash
    </a> account. 
</p>

@endsection
