@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if ($myticket->isEmpty())
        <div class="alert alert-success text-center">
            <p class="lead">
                There are no tickets you can add a ticket from here,
            </p>
            <a title=" فتح تذكرة " class="btn btn-primary btn-lg" href="{{url('/support')}}"> Open a ticket </a>
        </div>
        @else
        <div class="panel panel-default">
            <div class="panel-heading">
                tickets
            </div>
        
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <tr class="success">
                        <td>#</td>
                        <td> The subject of the ticket</td>
                        <td> The name </td>
                        <td> From </td>
                    </tr>
                    @foreach ($myticket as $value)
                    <tr>
        
                        <td> {{ $value->id }} </td>
        
                        <td>
                            <a title="  Add a comment " href="{{ url('/support/myticket/'.$value->id )}}">
                                {{ $value->title }}
                            </a>
                        </td>
                        <td> {{ $value->user->name }} </td>
                        <td>
                            {{ $value->created_at->diffForHumans() }}
                        </td>
        
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
