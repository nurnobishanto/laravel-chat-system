@extends('layouts.chat')
@section('content')
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="row">
            @include('include.nav')
            <section class="discussions col">

                @foreach($users as $user)
                    <a href="{{route('chat',['id'=>$user->id])}}">
                    <div class="discussion ">
                        @if($user->image)
                            <div class="photo" style="background-image: url({{asset('storage/'.$user->image)}});"></div>
                        @else
                        <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"></div>
                        @endif

                        <div class="desc-contact">
                            <p class="name">{{$user->name}}</p>
                            <p class="message">{{$user->email}}</p>
                        </div>
{{--                        <div class="timer">{{ $user->updated_at->diffForHumans() }}</div>--}}
                    </div>
                    </a>
                @endforeach

            </section>
        </div>
    </div>
    </body>
    <!-- partial -->
@endsection
