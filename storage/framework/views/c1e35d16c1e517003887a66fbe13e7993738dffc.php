

<?php $__env->startSection('title'); ?> Onboarding Client <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link href="<?php echo e(URL::asset('/assets/libs/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> <?php echo e(ucfirst(Auth::user()->type)); ?> <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Onboarding Client <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="card-title-desc"> Onboarding Clients are the clients approved by the company to be part of.
                    </p>
                    <!-- Static Backdrop modal Button -->
                    <button type="button" class="btn btn-primary waves-effect waves-light my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                       + Add Onboarding Client
                    </button>
                    <button type="button" class="btn btn-success waves-effect waves-light my-2" disabled >
                       + Import Excel/CSV File
                    </button>


                    <!-- Add Onboarding Client Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Onboarding Client</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="basic-example">
                                                    <!-- Seller Details -->
                                                    <h3>Client Details</h3>
                                                    <section>
                                                        <form action="client/store" method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-firstname-input">First name</label>
                                                                        <input type="text" class="form-control" id="basicpill-firstname-input" name="firstname" placeholder="Enter Your First Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-lastname-input">Last name</label>
                                                                        <input type="text" class="form-control" id="basicpill-lastname-input" name="lastname" placeholder="Enter Your Last Name">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                                        <input type="text" class="form-control" id="basicpill-phoneno-input" name="phone" placeholder="Enter Your Phone No.">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="basicpill-email-input">Email</label>
                                                                        <input type="email" class="form-control" id="basicpill-email-input" name="email" placeholder="Enter Your Email ID">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Company</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="company_id">
                                                                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($company->id); ?>"><?php echo e(ucfirst($company->name)); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="col-md-6 col-form-label">Payment Method</label>
                                                                        <div class="col-md-12">
                                                                            <select class="form-select" name="payment_method">
                                                                                <option value="VISA">VISA</option>
                                                                                <option value="ACH">ACH</option>
                                                                                <option value="AMEX">AMEX</option>
                                                                                <option value="WIRE">WIRE</option>
                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                                                            <input type="text" class="form-control" name="rdia" id="basicpill-email-input" placeholder="Enter Remote Desktop Application" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                                                            <input type="text" class="form-control" name="rdia_id" id="basicpill-email-input" placeholder="Enter Remote Desktop Application Id" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-address-input">Address</label>
                                                                            <input type="text" class="form-control" name="address" id="basicpill-email-input" placeholder="Enter Your Home Address" >
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                        </section>
                                                        <h3>Facebook Platform Details</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Email Address:</label>
                                                                            <input type="text" class="form-control" name="fb_email_address" id="basicpill-email-input" placeholder="Enter Your Email ID">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Password</label>
                                                                            <input type="text" class="form-control" name="fb_password" id="basicpill-email-input" placeholder="Enter Your Email ID">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </section>
                                                        
                                                     <h3>Store Details is in progress..</h3>

                                                
                                                </div>

                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="added_by" value="<?php echo e(Auth::user()->id); ?>"/>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Home Address</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Company</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>


                        <tbody>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($client->firstname); ?> <?php echo e($client->lastname); ?></td>
                                 <td><?php echo e($client->address); ?></td>
                                <td><?php echo e($client->email); ?></td>
                                <td><?php echo e($client->phone); ?></td>
                                <?php if($client->company_id): ?>
                                <td><?php echo e($client->company->name); ?></td>
                                <?php else: ?> 
                                <td></td>
                                <?php endif; ?>
                                <td><?php echo e($client->payment_method); ?></td>
                                <td> 
                                    <?php if($client->status == "incomplete"): ?>
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                    <?php else: ?> 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                    <?php endif; ?>    
                                        <?php echo e(ucfirst($client->status)); ?> </span>
                                </td>
                                <td> <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#view-<?php echo e($client->id); ?>"><i class="bx bx-xs bx-user mr-2"></i> </a> 
                                    <a id="view" href="#" data-bs-toggle="modal" data-bs-target="#edit-<?php echo e($client->id); ?>"><i class="bx bx-xs bx-pencil mr-1"></i></a>
                                 </td>
                                    <!-- View Modal -->
                                <div class="modal fade bs-example-modal-xl" id="view-<?php echo e($client->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Onboarding Client Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="basic-example">
                                                        <!-- Seller Details -->
                                                        <h3>Client Details</h3>
                                                        <section>
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">First name</label>
                                                                            <input type="text" class="form-control" id="basicpill-firstname-input" placeholder="Enter Your First Name" value="<?php echo e($client->firstname); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-lastname-input">Last name</label>
                                                                            <input type="text" class="form-control" id="basicpill-lastname-input" placeholder="Enter Your Last Name" value="<?php echo e($client->lastname); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-phoneno-input">Contact No.</label>
                                                                            <input type="text" class="form-control" id="basicpill-phoneno-input" placeholder="Enter Your Phone No." value="<?php echo e($client->phone); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-email-input">Email Address</label>
                                                                            <input type="email" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->email); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Company</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->company->name); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Payment Method</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->payment_method); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA)</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->rdia); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Remote Desktop Application(RDA) Id</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->rdia_id); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-address-input">Address</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->address); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                        </section>
                                                        <h3>Facebook Platform Details</h3>
                                                        <section>
                                                            <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Email Address:</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->fb_email_address); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Password</label>
                                                                            <input type="text" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID" value="<?php echo e($client->fb_password); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </section>
                                                        <h3>Store Details is in progress..</h3>
                                                        
                                                        
                                                            
                                                        
                                                    </div>

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                                <!-- end card -->
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   <!-- Edit Modal -->
                                <div class="modal fade bs-example-modal-xl" id="edit-<?php echo e($client->id); ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add Onboarding Client</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="basic-example">
                                                        <!-- Seller Details -->
                                                        <h3>Client Details</h3>
                                                        <section>
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-firstname-input">First name</label>
                                                                            <input type="text" class="form-control" id="basicpill-firstname-input" placeholder="Enter Your First Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-lastname-input">Last name</label>
                                                                            <input type="text" class="form-control" id="basicpill-lastname-input" placeholder="Enter Your Last Name">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-phoneno-input">Phone</label>
                                                                            <input type="text" class="form-control" id="basicpill-phoneno-input" placeholder="Enter Your Phone No.">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-email-input">Email</label>
                                                                            <input type="email" class="form-control" id="basicpill-email-input" placeholder="Enter Your Email ID">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Company</label>
                                                                            <div class="col-md-12">
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                    <option>Large select</option>
                                                                                    <option>Small select</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label class="col-md-6 col-form-label">Payment Method</label>
                                                                            <div class="col-md-12">
                                                                                <select class="form-select">
                                                                                    <option>Select</option>
                                                                                    <option>Large select</option>
                                                                                    <option>Small select</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="basicpill-address-input">Address</label>
                                                                            <textarea id="basicpill-address-input" class="form-control" rows="2" placeholder="Enter Your Address"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                        </section>

                                                        <!-- Company Document -->
                                                        <h3>Store Details</h3>
                                                        <section>
                                                            
                                                        </section>
                                                    </div>

                                                </div>
                                                <!-- end card body -->
                                            </div>
                                                <!-- end card -->
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Understood</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                                
                               
                            </tr>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                           
                            
                            
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Required datatable js -->
    <script src="<?php echo e(URL::asset('/assets/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/pdfmake/pdfmake.min.js')); ?>"></script>
    <!-- Datatable init js -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/datatables.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('/assets/js/pages/form-repeater.int.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skote_v4.0.0\Laravel - ENOPOLY\Admin\resources\views/clients/client.blade.php ENDPATH**/ ?>