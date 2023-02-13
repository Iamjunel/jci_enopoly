@extends('layouts.master')

@section('title') Approved | Denied Supplier @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Caller @endslot
        @slot('title') Approved | Denied Supplier @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Approved | Denied are the suppliers that need to be approved by the company to be part of.
                    </p>
                  
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>ASIN</th>
                                <th>Company Name</th>
                                <th>Website Link</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Date Updated</th>
                                <th>Updated by</th>
                                <th>CSV Details</th>
            
            
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($supplier as $client)
                            <tr>
                                <td>{{$client->firstname}} {{$client->lastname}}</td>
                                <td>{{$client->asin}}</td>
                                <td>{{$client->company_name}}</td>
                                <td><a href="{{$client->website_link}}" target="blank_">{{$client->website_link}}</a></td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                <td> 
                                    @if($client->status == "Uncheck")
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-danger" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a> </span>
                                    @else 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                        <a id="view" href="#" data-bs-toggle="modal" class="text-success" data-bs-target="#status-{{$client->id}}">{{ucfirst($client->status)}}</a> </span>
                                    @endif
                                        
                                </td>
                                 <td>{{date('M d Y',strtotime($client->created_at))}}</td>
                                <td>{{$client->user->name}}</td>
                                <td> 
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#approved-{{$client->id}}" ><i class="bx bx-xs bx-pencil mr-1"></i></a>
                                    
                                </td>
                            -
                                    <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-sm" id="status-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Change Supplier Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="supplier/update/{{$client->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-12 col-form-label">Supplier Status:</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="status">
                                                                                <option value="Approved" {{($client->status == 'Approved')? 'selected' : ''}}>Approved</option>
                                                                                <option value="Denied" {{($client->status == 'Denied')? 'selected' : ''}}>Denied</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="productdesc">Caller Notes</label>
                                                                                <textarea class="form-control" name="caller_notes" id="productdesc" rows="5" placeholder="Input some notes"></textarea>
                                                                            </div>

                                                                        </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="caller_id" value="{{Auth::user()->id}}"/>
                                                        <input type="hidden" name="caller_updated_at" value="{{date('Y-m-d h:i:s')}}"/>
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  name="update_client" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                    </div>
                                </div>
                                 <!--Update Status Modal -->
                                    <div class="modal fade bs-example-modal-md" id="approved-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="mySmallModalLabel">Supplier CSV Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="update/{{$client->id}}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">
                                                        
                                                        
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">CSV Link <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="csv_link"  id="basicpill-firstname-input" placeholder="Enter Supplier CSV Link" value="{{$client->csv_link}}" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                        </div>
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">Username <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="username" id="basicpill-firstname-input" placeholder="Enter Supplier Username" value="{{$client->username}}" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                        </div>
                                                        <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">Password<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="password" id="basicpill-firstname-input" placeholder="Enter Supplier Password" value="{{$client->password}}" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="client_id" value="{{$client->id}}"/>
                                                         <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"  name="update_client" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                    </div>
                                
                               
                            </tr>
                                
                            @endforeach
                            
                           
                            
                            
                        </tbody>
                    </table>

                    

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
@endsection
