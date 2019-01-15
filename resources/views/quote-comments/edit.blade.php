@extends('layouts.app')

@section('content')
<div class="container">

  @if(count($errors) >0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>
  @endif

    <form method="post" action="/quotes-comment/{{$comment->id}}">
        <div class="form-group">
            <label for="subject"> Isi Komentar</label><br />
            <textarea name="subject" class="form-control" rows="8" cols="80">{{ old('subject') ? old('subject') : $comment->subject }}</textarea>
        </div>

        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <button type="submit" class="btn btn-default btn-block">Submit kutipan</button>
    </form>
</div>
@endsection
