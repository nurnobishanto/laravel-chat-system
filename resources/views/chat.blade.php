@extends('layouts.chat')
@section('content')
<!-- partial:index.partial.html -->
  <div class="container">
    <div class="row">
        @include('include.nav')
      <section class="chat col">
        <div class="header-chat">
          <i class="icon fa fa-user-o" aria-hidden="true"></i>
          <p class="name">{{$user->name}}</p>
          <i class="icon clickable fa fa-ellipsis-h"></i>
        </div>
        <div class="messages-chat" style="overflow: auto;max-height: 500px;">
            @foreach($chats as $chat)
                @if($chat->sender_id == $me->id)
                    <div class="message text-only">
                        <div class="response">
                            <p class="text"> {{$chat->message}}</p>
                            <p class="response-time time"> {{ $chat->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @else
                    <div class="message text-only">
                        <p class="text"> {{$chat->message}}</p>
                    </div>
                    <p class="time"> {{ $chat->created_at->diffForHumans() }}</p>
                @endif
            @endforeach
        </div>
        <div class="footer-chat" style="width: 100%">
            <form action="{{route('send')}}" method="get" style="width: 100%">
                @csrf
                <input name="sender_id" value="{{$me->id}}" hidden required>
                <input name="receiver_id" value="{{$user->id}}" hidden required>
                <input name="message" value="" type="text" class="write-message" placeholder="Type your message here" required>
                <button class="icon send fa fa-paper-plane-o clickable" type="submit"> Send</button>
            </form>
        </div>
      </section>
    </div>
  </div>
</body>
<!-- partial -->
@endsection
