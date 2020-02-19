@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            {!! $page->post_content !!}
        </div>
    </div>
</div>
@endsection
