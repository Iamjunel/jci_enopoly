@extends('layouts.master')

@section('title') Announcement @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Admin @endslot
        @slot('title') Announcement @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc">You can create an announcement for all the users.
                    </p>
                    <!-- Static Backdrop modal Button -->
                    <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                       + Add an Announcement
                    </button>

                    <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-lg-12">
                                <div class="card">
                                    <form action="announcement/store" method="POST">
                                        @csrf
                                    <div class="card-body">
                                        <div id="basic-example">
                                            <!-- Seller Details -->
                                           
                                            <section>
                                                
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="productdesc">Announcement</label>
                                                            <textarea class="form-control" name="message"  rows="10" placeholder="Whats new"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                            </section>
                                        </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                    <!-- end card -->
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Announcement</th>
                                
                                <th>Added by</th>
                                <th>Date Added</th>                                                       
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($announcement as $client)
                            <tr>
                                <td>{{mb_strimwidth($client->message,0,100,'...')}}</td>
                                 
                                <td>{{date('M d Y h:i:s a',strtotime($client->created_at))}}</td>
                                 <td>{{$client->user->name}}</td>
                                <td> <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#edit-{{$client->id}}"><i class="bx bx-xs text-success  bx-pencil mr-1"></i></a>
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#delete-{{$client->id}}"><i class="bx bx-xs text-danger bx-trash mr-1"></i></a>
                                 </td>

                                   <!-- Edit Modal -->
                                <div class="modal fade bs-example-modal-xl" id="edit-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog  modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Update Announcement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                            <div class="card">
                                                <form action="announcement/update/{{$client->id}}" method="POST">
                                                @csrf
                                                <div class="card-body">
                                                    <div id="basic-example">
                                                        <!-- Seller Details -->
                                                        <h3>Company Details</h3>
                                                        <section>

                                                             <section>
                                                
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="productdesc">Announcement</label>
                                                                            <textarea class="form-control" name="message"  rows="10" placeholder="Whats new">{{$client->message}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                    </div>

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                                <!-- end card -->
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!--  Delete Modal-->
                                <div class="modal fade  bs-example-modal-sm" id="delete-{{$client->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="mySmallModalLabel">Delete Announcement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this announcement ?</p>
                                                
                                            </div>
                                            <form action="announcement/destroy/{{$client->id}}" method="POST">
                                                @csrf
                                                
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Yes I'm sure</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                
                               
                                
                               
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
    
@endsection
