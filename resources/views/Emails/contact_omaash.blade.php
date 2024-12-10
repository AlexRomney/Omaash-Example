@extends('emails')

@section('head-title')
    Someone is trying to contact Omaash!
@endsection

@section('image-url')
{{ url('images/emails/email-header.jpg') }}
@endsection

@section('email-heading')
    Someone is trying to contact Omaash!
@endsection

@section('email-greeting')
    Contact Alert!
@endsection

@section('content')
    <p> <strong>Name:</strong> {{ $name }} <p>
    <p> <strong>Email:</strong> {{ $email }} <p>
    <p> <strong>Message:</strong> {{ $text }} </p>
@endsection