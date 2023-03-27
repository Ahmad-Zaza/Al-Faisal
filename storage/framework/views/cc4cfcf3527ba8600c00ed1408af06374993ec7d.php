<?php $__env->startSection('content'); ?>

    <div>

        <?php if(CRUDBooster::getCurrentMethod() != 'getProfile' && $button_cancel): ?>
            <?php if(g('return_url')): ?>
                <p><a title='Return' href='<?php echo e(g("return_url")); ?>'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; <?php echo e(trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])); ?></a></p>
            <?php else: ?>
                <p><a title='Main Module' href='<?php echo e(CRUDBooster::mainpath()); ?>'><i class='fa fa-chevron-circle-left '></i>
                        &nbsp; <?php echo e(trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])); ?></a></p>
            <?php endif; ?>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><i class='<?php echo e(CRUDBooster::getCurrentModule()->icon); ?>'></i> <?php echo isset($page_title) ? $page_title : "Page Title"; ?></strong>
            </div>

            <div class="panel-body" style="padding:20px 0px 0px 0px">
                <?php
$action = (@$row) ? CRUDBooster::mainpath("edit-save/$row->id") : CRUDBooster::mainpath("add-save");
$return_url = ($return_url) ?: g('return_url');
?>
                <form class='form-horizontal' method='post' id="form" enctype="multipart/form-data" action='<?php echo e($action); ?>'>
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type='hidden' name='return_url' value='<?php echo e(@$return_url); ?>'/>
                    <input type='hidden' name='ref_mainpath' value='<?php echo e(CRUDBooster::mainpath()); ?>'/>
                    <input type='hidden' name='ref_parameter' value='<?php echo e(urldecode(http_build_query(@$_GET))); ?>'/>
                    <?php if($hide_form): ?>
                        <input type="hidden" name="hide_form" value='<?php echo serialize($hide_form); ?>'>
                    <?php endif; ?>
                    <div class="box-body" id="parent-form-area">

                        <?php if($command == 'detail'): ?>
                            <?php echo $__env->make("crudbooster::default.form_detail", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make("crudbooster::default.form_body", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    </div><!-- /.box-body -->

                    <div class="box-footer" style="background: #F5F5F5">

                        <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                           

                                <?php if(CRUDBooster::isCreate() || CRUDBooster::isUpdate()): ?>

                                    <?php if(CRUDBooster::isCreate() && $button_addmore==TRUE && $command == 'add'): ?>
                                       <?php if(CRUDBooster::getCurrentModule()->hasImage==1): ?>
                                        <input type="submit" name="submit" value='<?php echo e(trans("crudbooster.button_save_and_images")); ?>' class='btn btn-success'>
                                        <?php else: ?>
                                        <input type="submit" name="submit" value='<?php echo e(trans("crudbooster.button_save_more")); ?>' class='btn btn-success'>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($button_save && $command != 'detail' ): ?>

                                      <?php if(CRUDBooster::getCurrentModule()->hasImage==1 && $row!=null): ?>
                                      <?php
                                            $images = \DB::table('image_model')->where([
                                                'model' => CRUDBooster::getCurrentModule()->name,
                                                'model_id' =>$row->id
                                            ])->get();
                                        ?>
                                        
                                        <input type="hidden"  id="list_images" name="list_images[]">
                                        <input type="hidden"  id="moduleName"  value="<?php echo e(CRUDBooster::getCurrentModule()->name); ?>">
                                        <input type="hidden"  id="rowId" value="<?php echo e($row->id); ?>">
                                                    
                                        <a onclick="OpenInsertImage('<?php echo e(CRUDBooster::getCurrentModule()->name); ?>',<?php echo e($row->id); ?>)" class="btn btn-primary" >Add Images </a>
                                        <div id="show-images" class="well">
                                        
                                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a data-lightbox="roadtrip" id="image<?php echo e($element->id); ?>" href="<?php echo e(url(''.$element->path)); ?> ">
                                            <img style="width:150px;height:150px;" title="Image For Image" src="<?php echo e(url(''.$element->path)); ?>">
                                            </a>
                                            <span onclick="deleteImageList(<?php echo e($element->id); ?>)" id="span-<?php echo e($element->id); ?>" style='color:red;position: relative;cursor:pointer;bottom: 58px;'><i class='fa fa-close'></i></span>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                         <?php endif; ?>

                                        <input type="submit" name="submit" value='<?php echo e(trans("crudbooster.button_save")); ?>' class='btn btn-success'>


                                    <?php endif; ?>

                                <?php endif; ?>
                                <?php if($button_cancel && CRUDBooster::getCurrentMethod() != 'getDetail'): ?>
                                    <?php if(g('return_url')): ?>
                                        <a href='<?php echo e(g("return_url")); ?>' class='btn btn-default'><i
                                                    class='fa fa-chevron-circle-left'></i> <?php echo e(trans("crudbooster.button_back")); ?></a>
                                    <?php else: ?>
                                        <a href='<?php echo e(CRUDBooster::mainpath("?".http_build_query(@$_GET))); ?>' class='btn btn-default'><i
                                                    class='fa fa-chevron-circle-left'></i> <?php echo e(trans("crudbooster.button_back")); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>


                    </div><!-- /.box-footer-->

                </form>
            </div>
        </div>
    </div><!--END AUTO MARGIN-->
    <div class="modal fade" id="modalInsertPhoto" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Insert Image</h4>
                </div>
                <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

   <script language="javascript" type="text/javascript">
    $("#form").submit(function(e) {
        var data= $("#form").serialize();
        $("#form").submit();
        console.log(data);
    debugger;

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('crudbooster::admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>