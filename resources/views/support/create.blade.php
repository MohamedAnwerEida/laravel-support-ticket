@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


        <div class="panel panel-default">
            <div class="panel-heading">create new ticket</div>

            <div class="panel-body">
                @if (@$sent == true )
                <div class="alert alert-success">
                    Done !
                </div>
                @else
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="appoform-wrapper noborder">
                    <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <fieldset class="row-fluid appoform">
                            <div class=" form-group">
                                <div class="col-md-12">
                                    <label class="sr-only">* The subject of the ticket </label>
                                    <input type="text" name="title" value="{{ @$post['title'] }}" class="form-control"
                                        placeholder="* The subject of the ticket" required>
                                </div>
                            </div>
                            <div class=" form-group">
                                <div class="col-md-12">
                                    <label class="sr-only">Section</label>
                                    <select class="selectpicker form-control" name="category" data-style="btn-white" required>
                                        @foreach ($categories as $category )
                                        @if (@$post['category'] == $category->id)
                                        <option value="{{ $category->id }}" selected> {{ $category->name }}</option>
                                        @elseif ($id == $category->id)
                                        <option value="{{ $category->id }}" selected> {{ $category->name }}</option>
                                        @else
                                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                
                
                            <div class=" form-group">
                                <div class="col-md-12">
                                    <label class="sr-only">* Text of the message</label>
                                    <textarea class="form-control" name="text" placeholder="* Text of the message"
                                        required>{{ @$post['text'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group  {{ $errors->has('files.*') ? ' has-error' : '' }}">
                                    <div class="control-group" id="file">
                                        <label class="control-label" for="file1">
                                            Add attachments
                                        </label>
                                        <div class="controls" style="margin-bottom: 10px">
                
                                            <div class="entry input-group col-xs-3" style="margin-bottom: 10px">
                                                <input class="btn btn-primary" name="files[]" multiple="multiple" type="file"
                                                    style="border-radius: 0px 3px 3px 0px ; ">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success btn-add" type="button"
                                                        style="border-radius: 3px 0px 0px 3px ;     padding: 7px 10px 7px 10px;">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </span>
                                            </div>
                
                                        </div>
                
                                    </div>
                                    @if ($errors->has('files.*'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('files.*') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class=" form-group">
                                <div class="col-md-12">
                                    <center>
                                        <button type="submit" class="btn  btn-primary btn-block  btn-lg"> Send</button>
                                    </center>
                
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
  
@endsection
@section('js')
<script type="text/javascript">

$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
      $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });
});
</script>

@endsection
