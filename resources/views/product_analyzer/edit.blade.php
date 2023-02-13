@extends('layouts.master')

@section('title') Onboarding Client @endsection



@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Client Corr @endslot
        @slot('title') Create Onboarding Client @endslot
    @endcomponent
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                 <p class="card-title-desc"> Onboarding Clients are the clients approved by the company to be part of.
                    </p>
                <form class="repeater" action="../../client/update/{{$client->id}}" method="POST">
                   
                    <section class="border-bottom py-2">
                         <h3>Client Details</h3>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">First name</label>
                                    <input type="text" class="form-control" id="basicpill-firstname-input" name="firstname" placeholder="Enter Your First Name" value="{{$client->firstname}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-lastname-input">Last name</label>
                                    <input type="text" class="form-control" id="basicpill-lastname-input" name="lastname" placeholder="Enter Your Last Name" value="{{$client->lastname}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-phoneno-input">Phone</label>
                                    <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" placeholder="Enter Your Phone No." value="{{$client->phone}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-email-input">Email</label>
                                    <input type="email" class="form-control" id="basicpill-email-input" name="email" placeholder="Enter Your Email ID" value="{{$client->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="col-md-6 ">Company</label>
                                    <div class="col-md-12">
                                        <select class="form-select" name="company_id">
                                            @foreach ($companies as $company)
                                                <option value="{{$company->id}}" {{($client->company_id == $company->id)? 'selected' : ''}}>{{ucfirst($company->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="mb-3">
                                        <label for="basicpill-address-input">Address</label>
                                        <input type="text" class="form-control" name="address" id="basicpill-email-input" placeholder="Enter Your Home Address"  value="{{$client->address}}">
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                        <input type="text" class="form-control" name="rdia" id="basicpill-email-input" placeholder="Enter Remote Desktop Application" value="{{$client->rdia}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                        <input type="text" class="form-control" name="rdia_id" id="basicpill-email-input" placeholder="Enter Remote Desktop Application Id" value="{{$client->rdia_id}}">
                                    </div>
                                </div>
                            </div>
                                                                             
                    </section>
                    
                    <section class="border-bottom py-2">
                        <h3>Facebook Platform Details</h3>
                        <div class="row">
                                
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="col-md-6 col-form-label">Email Address:</label>
                                        <input type="text" class="form-control" name="fb_email_address" id="basicpill-email-input" placeholder="Enter Your Email ID" value="{{$client->fb_email_address}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="col-md-6 col-form-label">Password</label>
                                        <input type="text" class="form-control" name="fb_password" id="basicpill-email-input" placeholder="Enter Your Password" value="{{$client->fb_password}}">
                                    </div>
                                </div>
                            </div>
                    </section>
                    <section class="border-bottom py-2">
                    <h3>Store Details</h3>
                    <div data-repeater-list="store">
                        <div data-repeater-item class="row">
                        @if(!$client->store_details->isEmpty())
                        
                        @foreach($client->store_details as $key => $store)
                        
                            
                                <div class="mb-3 col-lg-2">
                                    <label class="col-md-12 ">Company/Platform</label>
                                    <div class="col-md-12">
                                        <select class="form-select" id="payment_method" name="platform">
                                            <option value="Amazon" {{($store->platform =="Amazon")?'selected':''}}>Amazon</option>
                                            <option value="Walmart" {{($store->platform =="Walmart")?'selected':''}}>Walmart</option>
                                            
            
                                        </select>
                                    </div>
                                </div> 
                                <div class="mb-3 col-lg-2">
                                <label for="name">Name</label>
                                <input type="text" id="name"  name="store_name" class="form-control" placeholder="Enter Store Name" value="{{$store->name}}"/>
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="email">Website Link:</label>
                                <input type="text" id="message" class="form-control" name="store_line" placeholder="http://example.com" value="{{$store->link}}"/>
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="email">Email/Username :</label>
                                <input type="text" id="email" class="form-control" name="store_username" placeholder="Enter Store Email/Username" value="{{$store->username}}"/>
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="subject">Password</label>
                                <input type="text" id="subject" class="form-control" name="store_password" placeholder="Enter Store Password" value="{{$store->password}}"/>
                            </div>

                            <div class="col-lg-2 align-self-center">
                                <div class="d-grid">
                                    <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" />
                                </div>
                            </div>
                       
                        @endforeach
                        
                        @else
                         
                            <div class="mb-3 col-lg-2">
                                    <label class="col-md-12 ">Company/Platform</label>
                                    <div class="col-md-12">
                                        <select class="form-select" id="payment_method" name="platform">
                                            <option value="Amazon" >Amazon</option>
                                            <option value="Walmart" >Walmart</option>
                                            
            
                                        </select>
                                    </div>
                                </div> 
                                <div class="mb-3 col-lg-2">
                                <label for="name">Name</label>
                                <input type="text" id="name"  name="store_name" class="form-control" placeholder="Enter Store Name" />
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="email">Website Link:</label>
                                <input type="text" id="message" class="form-control" name="store_line" placeholder="http://example.com"/>
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="email">Email/Username :</label>
                                <input type="text" id="email" class="form-control" name="store_username" placeholder="Enter Store Email/Username" />
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="subject">Password</label>
                                <input type="text" id="subject" class="form-control" name="store_password" placeholder="Enter Store Password" />
                            </div>

                            <div class="col-lg-2 align-self-center">
                                <div class="d-grid">
                                    <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" />
                                </div>
                            </div>
                        @endif
                        
                            
                        </div>

                    <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
                    </section> 
                    <input type="hidden" name="added_by" value="{{Auth::user()->id}}"/>
                                                <div class="d-flex justify-content-end">
                                                <a href="{{route('client_corr.client.index')}}" class="btn btn-light px-4 mx-1" >Cancel</a>
                                                <button type="submit" name="add_client" class="btn btn-primary px-4 mx-1">Save</button>
                                                </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-repeater.int.js') }}"></script>
    
    <script>
        $('#payment_method').change(function() {
        //Use $option (with the "$") to see that the variable is a jQuery object
        var $option = $(this).find('option:selected');
        //Added with the EDIT
        var value = $option.val();//to get content of "value" attrib
        var text = $option.text();//to get <option>Text</option> content

        if(text == "CREDIT CARD"){
            $('#credit_card').css('display','block');
        }else{
             $('#credit_card').css('display','none');
        }

        console.log(text);
});
        </script>
    
@endsection
