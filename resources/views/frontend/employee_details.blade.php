@extends('layouts.app')

@section('title', $employee->name)

@section('sidebar')
    @parent
@endsection

@section('content')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <main id="main">
            <div class="container-fluid">
              <div class="row" style="padding:30px;">
                	<div class="col-sm-2"><img src="{{ $employee->image }}" alt="{{ $employee->name }}" style="width:100%; height:auto"> </div>
                    <div class="col-sm-10">
                        <header class="article-header">
                            <h2>{{ $employee->name }}</h2>
                            <h4>{{ $employee->designation }}</h4>
                        </header>

                        @if($employee->bio)
                        <p style="margin-bottom:20px;">{!! $employee->bio !!}</p>
                        @endif
                    </div>
              </div>
            </div>
    </main>
@endsection

@section('footer')
    @parent
@endsection
