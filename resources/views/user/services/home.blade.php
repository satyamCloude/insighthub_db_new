@extends('layouts.admin')
@section('title', 'Services')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  
  <div class="Invoicescreen">
      <div class="row">
                              <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <div class="card mb-4">
                                  <h5 class="card-header">Services</h5>
        
                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table border-top">
                                        <thead>
                                          <tr>
                                            <th class="control sorting_disabled dtr-hidden sorting_asc" rowspan="1" colspan="1" style="width: 27.6562px; display: none;" aria-label=""></th>
                                            <th>ID</th>
                                            <th>SERVICE NAME</th>
                                            <th>PRODUCT NAME</th>
                                            <th>AMOUNT</th>
                                            <th>CREATED ON</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($orderByServices  as $key=>$orderByService)

                                          <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{ucfirst($orderByService->category_name)}}</td>
                                            <td>{{ucfirst($orderByService->prod_name)}}</td>
                                            <td>{{$orderByService->prefix}} {{number_format($orderByService->final_total_amt,2)}}</td>
                                            <td>{{date('Y-m-d',strtotime($orderByService->created_at))}}</td>
                                                             

                                          </tr>
                                          @endforeach
                                      
                                          
                                         <!--  <tr>
                                            <td class="text-center" colspan="8">No Data Found</td>
                                          </tr> -->
                                         
                                        </tbody>

                                      </table>
                                    </div>

                                  </div>
                                </div>
                              </div>
      </div>
  </div>

</div>
<div class="modal fade" id="showedit" data-bs-backdrop="statics" tabindex="-1" aria-modal="true" role="dialog"></div>

@endsection
