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

    <form method="post" action="/quotes/{{$quote->id}}">
        <div class="form-group">
             <label for="title">Judul</label><br />
             <input type="text" name="title" class="form-control"
             value="{{ old('title') ? old('title') : $quote->title }}" placeholder="tulis judul disini">
        </div>

        <div class="form-group">
            <label for="subject"> Isi kutipan </label><br />
            <textarea name="subject" class="form-control" rows="8" cols="80">{{ old('subject') ? old('subject') : $quote->subject }}</textarea>
        </div>

        <div id="tag_wrapper">
            <label for="">Tag(Maximal 3)</label>
            <div id="add_tag">Add Tag</div>

            @foreach($quote->tags as $oldtags)
              <select name="tags[]" id="tag_select">
                <option value="0">Tidak ada</option>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}"
                        @if ($oldtags->id == $tag->id)
                          selected="selected"
                        @endif
                      >{{$tag->name}}</option>
                @endforeach
              </select>
            @endforeach

            <script src="{{asset('js/tag.js')}}" charset="utf-8"></script>
        </div>
        <br>

        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <button type="submit" class="btn btn-default btn-block">Submit kutipan</button>
    </form>
</div>
@endsection
