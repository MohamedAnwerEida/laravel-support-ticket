@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                {{$oneticket->title}}
            </div>

            <div class="panel-body">
                <table class="table table-striped table-hover">
                <thead>
                    <tr class="success">
                        <th>serial</th>
                        <th>data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> ticket number </th>
                        <td>{{ $oneticket->id }} </td>
                    </tr>
                    <tr>
                        <th> Subject  </th>
                        <td>{{ $oneticket->title }} </td>
                    </tr>
                    <tr>
                        <th> Section  </th>
                        <td>{{ $oneticket->categoryName->name}} </td>
                    </tr>
                    
                    <tr>
                        <th> Text of the message </th>
                        <td>{{ $oneticket->text }} </td>
                    </tr>
                    @if (isset($oneticket->ticket_file))
                    <tr>
                        <th> Attachments </th>
                        <td>
                        @foreach($oneticket->ticket_file as $one)
                            <a href="{{ url('/upload/files/'.$one->file) }}" download class="btn btn-success btn-sm">Download attachment</a>
                        @endforeach
                        </td>
                    </tr>
                    @endif
                </tbody>
                </table>
                <hr class="style-six">
                @if (count($oneticket->comments) > 0)
                    @foreach($oneticket->comments as $comment)
                        @if ($comment->check_admin != 1)
                            <ul class="list-group admin"  dir="rtl" >
                                <li class="list-group-item">
                                    @if ($comment->own == 0)
                                        <span class="badge pull-left">
                                            {{$oneticket->user->name}}
                                        </span>
                                    @else
                                        <span class="badge pull-left badge-admin">
                                            By a moderator
                                        </span>
                                    @endif

                                    @if (isset($comment->file_comment))

                                        @foreach($comment->file_comment as $one)
                                            <a href="{{ url('/upload/files/'.$one->file) }}" download class="btn btn-success btn-sm">Download attachment</a>
                                        @endforeach
                                        <hr class="style-six">
                                    @endif
                                    {!! $comment->comment !!}
                                    <span class="custom-span">{{ $comment->created_at->diffForHumans() }}</span>
                                </li>
                            </ul>
                        @endif
                    @endforeach
                @else
                <ul class="list-group admin"  dir="rtl">
                    <li class="list-group-item">
                        <span class="badge pull-left">0</span>
                        no comments
                    </li>
                </ul>
                @endif

                <hr class="style-six">
                @if (@$sent == true )
                            <div class="alert alert-success">
                                    Comment sent
                            </div>
                    <div class="clearfix"></div>
                    @else
                    <div class="h4 text-center" >Add new comment</div>
                    <form method="post" action="" dir="rtl" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group  {{ $errors->has('comment') ? ' has-error' : '' }}">
                                <div class="control-group" id="file">
                                    <label class="control-label" for="file1">
                                        Add attachments
                                    </label>
                                    <div class="controls" style="margin-bottom: 10px">

                                        <div class="entry input-group col-xs-3" style="margin-bottom: 10px">
                                            <input class="btn btn-primary" name="files[]" multiple="multiple" type="file" style="border-radius: 0px 3px 3px 0px ; ">
                                            <span class="input-group-btn">
                                                <button class="btn btn-success btn-add" type="button" style="border-radius: 3px 0px 0px 3px ;     padding: 7px 10px 7px 10px;">
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
                                <textarea class="form-control textarea" placeholder="Post your comment here" name="comment" required="required" dir="auto">{{ old('comment') }}</textarea>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-custom">send</button>
                        </div>
                    </form>
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
