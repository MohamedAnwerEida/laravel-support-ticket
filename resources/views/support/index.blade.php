@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="alert alert-info">
        <p class="lead ">
            You can send a technical support ticket and select the appropriate section from the bottom
        </p>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">technical support ticket</div>
 
            <div class="panel-body">
                <div class="tick-features">
                @foreach ($categories as $category )
                <div class="col-md-6">
                    <a href="{{ url('/support/'.$category->id)}}" class="tick-feat">
                        <div class="t-feat-img">
                            <i class="{{ $category->icon }}"></i>
                        </div>
                        <div class="t-feat-info">
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->text }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
