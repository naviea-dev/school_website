@extends('admin.include.master')
@section('title') Welcome to ফরিদপুর পৌরসভা.com @endsection
@section('content')

<style>
  body{
    font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi;
  }
  .card {
    background-color: #333333;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    margin-bottom: 15px;
    color: #FFFFFF;
  }

  .card-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  .card-label {
    font-size: 22px;
    color: #eaeaea;
    margin-bottom: 5px;
  }

  .card-title {
    font-size: 32px;
    font-weight: bold;
    color: #FFD700;
  }

  .doughnutchart-wrapper,
  .barchart-wrapper {
    width: 100%;
    height: 300px;
    /* Adjust height as needed */
  }

  .custom-card {
    background: #1e1e1e;
    /* Dark gray background */
    border-radius: 8px;
    /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    /* Subtle shadow */
    margin: 10px;
    /* Spacing around cards */
    overflow: hidden;
    /* Clip overflow */
  }

  .custom-card-header {
    background: #2c2c2c;
    /* Darker gray background for header */
    padding: 16px;
    /* Padding for the header */
    font-size: 18px;
    /* Font size for the header */
    text-align: center;
    /* Center header text */
    font-weight: bold;
    /* Bold font weight */
    color: #ffffff;
    /* White text for the header */
  }

  .chart-wrapper {
    width: 100%;
    height: 400px;
    /* Fixed height for charts */
  }
</style>
<div class="layout-content">
  <div class="layout-content-body">
    <div class="title-bar">
      <h1 class="title-bar-title"><span class="d-ib">তথ্য বিশ্লেষণ ড্যাশবোর্ড: আপনার মূল সূচকগুলো চিত্রায়িত করুন</span></h1>
    </div>
    <div class="row gutter-xs">
      <!-- Metric Cards -->
      <div class="col-xs-6 col-md-4">
        <div class="card">
          <div class="card-content">
            <small class="card-label">সর্বমোট মেম্বার</small>
            <h3 class="card-title">{{ $statisticData['totalMembers'] }}</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-4">সর্বশেষ মেম্বারদের তথ্য</h3> <!-- Headline -->
        <div class="mt-3"> <!-- Top margin for the table -->
          <table class="table table-bordered table-strip">
            <tr>
              <th>নাম</th>
              <th>পদবী</th>
              <th>শাখা</th>
              <th>বিভাগ</th>
              <th>মোবাইল নং</th>
            </tr>
            @foreach($statisticData['lastInsertedMember'] as $holdingData)
            <tr>
              <td>{{ $holdingData->name }}</td>
              <td>{{ $holdingData->designation }}</td>
              <td>{{ $holdingData->branch }}</td>
              <td>{{ $holdingData->department }}</td>
              <td>{{ $holdingData->mobile }}</td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>

      
    </div>


  </div>

</div>


@endsection