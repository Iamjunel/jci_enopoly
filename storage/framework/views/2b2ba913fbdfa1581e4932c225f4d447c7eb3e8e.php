

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

                    
                    <p class="card-title-desc"> Onboarding Clients Reports are the clients reports by the company to be part of.
                    </p>
                   
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
                                <th>Added By</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($client->firstname); ?> <?php echo e($client->lastname); ?></td>
                                 <td><?php echo e($client->address); ?></td>
                                <td><?php echo e($client->email); ?></td>
                                <td><?php echo e($client->phone); ?></td>
                                <td><?php echo e($client->company->name); ?></td>
                                <td><?php echo e($client->rdia); ?></td>
                                <td><?php echo e($client->rdia_id); ?></td>
                                <td><?php echo e($client->payment_method); ?></td>
                                <td><?php echo e($client->fb_email_address); ?></td>
                                 <td><?php echo e($client->fb_password); ?></td>
                                <td> 
                                    <?php if($client->status == "incomplete"): ?>
                                    <span class="badge badge-pill badge-soft-danger font-size-11">
                                    <?php else: ?> 
                                    <span class="badge badge-pill badge-soft-success font-size-11">
                                    <?php endif; ?>    
                                        <?php echo e(ucfirst($client->status)); ?> </span>
                                </td>
                                 <td><?php echo e($client->user->name); ?></td>
                               
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Skote_v4.0.0\Laravel - ENOPOLY\Admin\resources\views/clients/client-report.blade.php ENDPATH**/ ?>