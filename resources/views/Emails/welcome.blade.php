@extends('emails')

@section('head-title')
    Welcome to the Omaash Nation!
@endsection

@section('image-url')
{{ url('images/emails/email-header.jpg') }}
@endsection

@section('email-heading')
    Welcome to the Omaash Nation!
@endsection

@section('email-greeting')
    Hey {{ $username }}!
@endsection

@section('content')
    <p>
        Thank you for creating your Omaash account!
    </p>
    <p>
        This site was created to help the members of the Omaash Nation use my middleman service.
        No more sending off your cards and waiting until who knows when to get them back. From now
        on, you'll start and end right here and can check the status of your submission throughout
        the whole process. I hope that the site will help further your collection and 
        make getting your cards graded so much easier.
    </p>
    <p>
        Don't forget to CHOOSE YOUR POKEMON on the profile page! 
    </p>
@endsection