@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp
@section('title', 'বার্তা সমূহ')

@section('sidebar')
    @parent
@endsection

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <main id="main">
            <div class="container">
                	<h2 class="title" style="padding:20px; width:100%; float:left">বার্তা সমূহ</h2>
                    <div class="articleareas">
                            @if($managements!="")
                                <?php $i=0; ?>
                                @foreach($managements as $management)
                                <?php $i++; ?>
                                    <div class="col-sm-12">
                                        <div style="width:95%; height:auto; float:left; margin-bottom:10px; border:5px solid #eaeaea; text-align:left">
                                        	<div class="row" style="padding:10px 20px;">
                                                <div class="col-sm-2" style="margin:0; padding:0">
                                                    <img src="{{ $management->image }}" style="width:100%; height:auto; margin:0; padding:0"  />
                                                </div>
                                                <div class="col-sm-10">
                                                <h4>{{ $management->name }}</h4>
                                                <h5 style="margin:0; padding:0">{{ $management->designation }}</h5>
                                                <div style="text-align:justify; line-height:22px; font-size:16px; 	float:left; width:100%;">{!! strip_tags(Str::limit($management->details,300)) !!}</div>
                                                <a href="{{ route('management.details',$management->id) }}">বিস্তারিত দেখুন</a>
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
