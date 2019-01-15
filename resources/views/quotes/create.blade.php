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
    <div class="alert alert-danger"> {{session('tag_error')}} </div>
  @if(session('tag_error'))

  @endif

    <form method="post" action="/quotes">
        <div class="form-group">
             <label for="title">Judul</label><br />
             <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="tulis judul disini">
        </div>

        <div class="form-group">
            <label for="subject"> Isi kutipan </label><br />
            <textarea name="subject" class="form-control" rows="8" cols="80">{{old('subject')}}</textarea>
        </div>

        <div id="tag_wrapper">
            <label for="">Tag(Maximal 3)</label>
            <div id="add_tag">Add Tag</div>

            @if(old('tags'))
                @for ($i=0; $i < count(old('tags')); $i++)
                  <select name="tags[]" id="tag_select">
                    <option value="0">Tidak ada</option>
                    @foreach ($tags as $tag)
                      <option value="{{$tag->id}}"
                        @if (old('tags.'.$i) == $tag->id) selected="selected" @endif >
                        {{$tag->name}}</option>
                    @endforeach
                  </select>
                @endfor
            @else
              <select name="tags[]" id="tag_select">
                <option value="0">Tidak ada</option>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
              </select>
            @endif

            <script src="{{asset('js/tag.js')}}" charset="utf-8"></script>
        </div>
        <br>

        {{ csrf_field() }}

        <button type="submit" class="btn btn-default btn-block">Submit kutipan</button>
    </form>
</div>
@endsection
