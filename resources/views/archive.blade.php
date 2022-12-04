@extends('layouts.chat')
@section('content')
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="row">
            @include('include.nav')
            <section class="discussions col">
                @foreach($inboxes as $inbox)
                    <div class="discussion ">
                        @if($inbox->user->image)
                            <div class="photo" style="background-image: url({{asset('storage/'.$inbox->user->image)}});"></div>
                        @else
                            <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);"></div>
                        @endif


                        <div class="desc-contact">
                            <p class="name"> <a href="{{route('chat',['id'=>$inbox->user->id])}}">{{$inbox->user->name}}</a></p>
                            <p class="message">{{$inbox->last_message}}</p>
                        </div>
                        <div class="timer">{{ $inbox->updated_at->diffForHumans() }}</div>
                        <div class="p-2 btn">
                            <a href="{{route('unarchived',['id'=>$inbox->user->id])}}">
                            <i class="fa fa-archive"> Unarchive</i>
                            </a>
                        </div>
                        <div class=" p-2 btn">
                            <a href="{{route('delete',['id'=>$inbox->user->id])}}">
                            <i class="fa fa-remove"> Delete</i>
                            </a>
                        </div>

                    </div>
                @endforeach

            </section>
        </div>
    </div>
    </body>
    <!-- partial -->
@endsection
