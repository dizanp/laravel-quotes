@extends('layouts.app')

@section('content')
<div class="container">

  @if(session('msg'))
    <div class="alert alert-success">
        <p> {{session('msg')}} </p>
    </div>
  @endif

  <div class="jumbotron">
      <h1>{{$quote->title}}</h1>
      <p>{{$quote->subject}}</p>
      <p>Ditulis oleh: <a href="/profile/{{$quote->user->id}}" >{{$quote->user->name}}</a></p>

      <p><a href="/quotes" class="btn btn-primary btn-lg">Kembali Ke daftar</a></p>

        @component('layouts/likes',
          ['content' => $quote, 'model_id'=> 1])
        @endcomponent

      @if($quote->isOwner())
        <p><a href="/quotes/{{$quote->id}}/edit" class="btn btn-primary btn-lg">edit</a></p>
        <form method="post" action="/quotes/{{$quote->id}}">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-danger btn-lg">Hapus kutipan</button>
        </form>
      @endif
  </div>


  @foreach($quote->comments as $comment)
    <div class="row">
      <div class="col-md-2">
          {{$comment->subject}} <a href="/profile/{{$comment->user->id}}" >{{$comment->user->name}}</a>
      </div>

      <div  class="col-md-2">
        @if($comment->isOwner())
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
              action<span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="/quotes-comment/{{$comment->id}}/edit">edit</a></li>
              <li>
                <form method="post" action="/quotes-comment/{{$comment->id}}">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger btn-lg">Hapus</button>
        </form>
              </li>
            </ul>
          </div>
        @endif
      </div>

      <div class="col-md-2">
        @component('layouts/likes',
          ['content' => $comment, 'model_id'=> 2])
        @endcomponent
      </div>
    </div>
  @endforeach


  @if(count($errors) >0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>
  @endif

  <form method="POST" action="/quotes-comment/{{$quote->id}}">
     <div class="form-group">
         <label for="subject">Isi Komentar</label><br />
         <textarea name="subject" class="form-control" rows="8" cols="80">{{old('subject')}}</textarea>
     </div>
     {{ csrf_field() }}
     <button type="submit" class="btn btn-default btn-block">Submit Komentar</button>
 </form>

 <script src="{{asset('js/quote.js')}}" charset="utf-8"></script>
</div>
@endsection
