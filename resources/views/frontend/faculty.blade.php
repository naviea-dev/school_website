@extends('layouts.app')

@section('title', 'শিক্ষক মণ্ডলী ও প্রশাসন')

@section('sidebar')
    @parent
@endsection

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <main id="main">
            <div class="container">
                	<h2 class="title" style="padding:20px; width:100%; float:left">শিক্ষক মণ্ডলী ও প্রশাসন</h2>
                    <div class="articleareas">
                            @if($faculties->count())
                                @foreach($faculties as $faculty)
                                    <div class="col-sm-12">
                                        <div style="width:95%; height:auto; float:left; margin-bottom:10px; border:5px solid #eaeaea; text-align:left">
                                        	<div class="row" style="padding:10px 20px;">
                                                <div class="col-sm-2" style="margin:0; padding:0">
                                                    @if($faculty->image)
                                                    <img src="{{ $faculty->image }}" style="width:100%; height:auto; margin:0; padding:0"  />
                                                    @endif
                                                </div>
                                                <div class="col-sm-10">
                                                <h4>{{ $faculty->name }}</h4>
                                                <h5 style="margin:0; padding:0">{{ $faculty->position }}</h5>
                                                <div style="color:#666">{{ $faculty->designation }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 @endforeach
                            @endif
                      </div>
                </div>

  	</main>
@endsection

@section('footer')
    @parent
@endsection
