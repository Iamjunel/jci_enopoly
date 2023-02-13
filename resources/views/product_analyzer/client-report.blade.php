@extends('layouts.master')

@section('title') Client List By Date From {{$date_from}} To {{$date_to}} @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Client Corr @endslot
        @slot('title') Client List By Date   @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Onboarding Clients Reports are the clients reports by the company to be part of.
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="../client/report-with-date" method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                                        <div class="col-12">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-text">From</div>
                                                 <input class="form-control" type="date" name="date_from" value="{{$date_from}}" id="example-date-input">
                                            </div>
                                            
                                        </div>

                                        

                                        <div class="col-12">
                                            <div class="input-group">
                                                <div class="input-group-text">To</div>
                                                 <input class="form-control" type="date" name="date_to" value="{{$date_to}}" id="example-date-input">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                                            <select class="form-select" id="inlineFormSelectPref" name="status">
                                                <option value="Incomplete" {{($status == 'Incomplete')?'selected' : ''}}>Incomplete</option>
                                                <option value="Completed" {{($status == 'Completed')?'selected' : ''}}>Completed</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-md">Get Report</button>
                                        </div>
                                    </form>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                   
                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Home Address</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Company</th>
                                <th>RDIA</th>
                                <th>RDIA Id</th>
                                <th>Payment Method</th>
                                <th>Email Address(FB)</th>
                                <th>Password(FB)</th>                                
                                <th>Status</th>
                                <th>Date Added</th>
                                <th>Added By</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td>{{$client->firstname}} {{$client->lastname}}</td>
                                 <td>{{$client->address}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{$client->company->name}}</td>
                                <td>{{$client->rdia}}</td>
                                <td>{{$client->rdia_id}}</td>
                                <td>{{$client->payment_method}}</td>
                                <td>{{$client->fb_email_address}}</td>
                                 <td>{{$client->fb_password}}</td>
                                <td> 
                                    @if($client->status == "Incomplete")
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                    @else 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                    @endif    
                                        {{ucfirst($client->status)}} </span>
                                </td>
                                 <td>{{date('M d Y',strtotime($client->created_at))}}</td>
                                 <td>{{$client->user->name}}</td>
                               
                            </tr>
                                
                            @endforeach
                            
                           
                            
                            
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <div class="insertHere"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>

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
