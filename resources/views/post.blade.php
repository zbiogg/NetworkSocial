@extends('header.header')
@section('title','ZBIO')
@section('content')

<div class="zbio-main container-fluid">
    <div class="row">
        <div class="c-main col-md-6 offset-md-3">
            <div class="" style="margin: 0 0 30px 0">
                @if($posts= DB::table('posts')->where('status',0)->where('postID',$postID)->get())
                @include('posts.allpost')
                @endif
            </div>
        </div>
    </div>
</div>

@include('myjs.customjs')

@endsection

