@extends('layouts.app')

@section('title', 'শিক্ষক মণ্ডলী')

@section('sidebar')
    @parent
@endsection
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
</style>
@section('content')
	 <div id="page" class="page">
          <div class="container-fluid">
                	<div class="row">
                    <div class="col-sm-12">

                        	<h2 class="title" style="padding:10px 0; margin:10px 0; float:left">শিক্ষক মণ্ডলী</h2>
                            @if($allemployee!="")
                              <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead style="background:#C1DFFD;">
                                    <tr>
                                      <th width="4%">ক্রমিক</th>
                                      <th width="15%">ছবি</th>
                                      <th width="20%">নাম</th>
                                      <th width="24%">পদবি</th>
                                      <th width="24%">মোবাইল</th>
                                      <th width="24%">ইমেইল</th>
                                  </tr>
                			  </thead>
                               <tbody>
                			<?php $i=0; ?>
                            @foreach($allemployee as $employee)
                            <?php $i++;
							?>

                            <tr>
                              <td>{{ $i }}</td>
                              <td><img src="{{ $employee->image }}" style="width:70px; height:auto" /></td>
                              <td>{{ $employee->name }}</td>
							  <td>{{ $employee->designation }}</td>
                              <td>{{ $employee->mobile }}</td>
                              <td>{{ $employee->email }}</td>
                            </tr>
                            @endforeach
            				</tbody>
                      </table>
                            @endif
                        </div>
                      </div>
    	  </div>
  	</div>
@endsection


@section('footer')
    @parent
@endsection
