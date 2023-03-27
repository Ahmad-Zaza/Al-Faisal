<?php $__env->startPush('bottom'); ?>
<script type="text/javascript">


    var selectId=null;

    $(document).ready(function () {

        var FileManager = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="fa fa-pencil"/> FileManager',
            tooltip: 'FileManager',
            click: function() {
            //fesal
                $("#modalInsertPhotoEditor .modal-body").html(`<iframe width="100%" height="400" src="/js/includes/filemanager/dialog.php?type=2&multiple=0&field_id=input_<?php echo e($name); ?>" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>`);
                $("#modalInsertPhotoEditor").modal();
            }
        });

     return button.render();
    }




    var FormManager = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="fa fa-pencil"/> FormManager',
            tooltip: 'FormManager',
            click: function() {
            //fesal
            //    alert("donnne");
            //    $('#modelForms').modal('show');

            selectId='<?php echo e($name); ?>';
               $.ajax({
                url: '<?php echo e(url("/modules/getForms")); ?>',
                contentType: JSON,
                type: "get",
                success: function (data) {
                    // var image = $('<img>').attr('src', url);
                    // $('#textarea_<?php echo e($name); ?>').summernote("insertNode", image[0]);
                    $("#tbody-forms").empty();
                    data.data.forEach(function(element) {
                        $("#tbody-forms").append(
                            "<tr>" +
                                "<td>"+element.id+"</td>" +
                                "<td>"+element.name+"</td>" +
                                "<td><a class='btn btn-primary' onClick='selectElement("+element.id+")'>Select</a></td>" +
                            "</tr>"
                 );    
                    }, this);
                    
                    $('#modelForms').modal('show');


                },
                error: function (data) {
                    console.log(data);
                }
            });
            }
        });



     return button.render();
    }


 

        $('#textarea_<?php echo e($name); ?>').summernote({
            height: ($(window).height() - 500),
            toolbar: [
                ['FileManager', ['FileManager']],
                ['FormManager', ['FormManager']],
                
                ['style', ['style']],

                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['picture', ['picture']],
                ['link', ['link']],
                ['video', ['video']],
                ['table', ['table']],
                ['backcolor', ['backcolor']],
                ['codeview', ['codeview']],
                ['cleaner',['cleaner']], // The Button

                
                
                //fesal


            ],
            cleaner: {
                            action: 'button', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                            newline: '<br>', // Summernote's default is to use '<p><br></p>'
                            notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
                            icon: 'Clear Format',
                            keepHtml: true, // Remove all Html formats
                            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>', '<i>', '<a>'], // If keepHtml is true, remove all tags except these
                            keepClasses: false, // Remove Classes
                            badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
                            badAttributes: ['style', 'start','class'], // Remove attributes from remaining tags
                            limitChars: false, // 0/false|# 0/false disables option
                            limitDisplay: 'html', // text|html|both
                            limitStop: false // true/false
                        },
                        
            callbacks: {
                onImageUpload: function (image) {
                    uploadImage<?php echo e($name); ?>(image[0]);
                },

            },
            buttons: {
                FileManager: FileManager,
                FormManager: FormManager
                
            },




        });

        function uploadImage<?php echo e($name); ?>(image) {
            var data = new FormData();
            data.append("userfile", image);
            $.ajax({
                url: '<?php echo e(CRUDBooster::mainpath("upload-summernote")); ?>',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function (url) {
                    var image = $('<img>').attr('src', url);
                    $('#textarea_<?php echo e($name); ?>').summernote("insertNode", image[0]);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    })

    function selectElement(id) {
        //fesal
        var formatForm="##form##"+id+"##end_form##";
        $('#textarea_'+selectId+'').summernote('pasteHTML', formatForm);
        $('#modelForms').modal('hide');
        
    }


        $('#modalInsertPhotoEditor').on('hidden.bs.modal', function () {
                $("#input_<?php echo e($name); ?>").trigger("change")
        })

        $("#input_<?php echo e($name); ?>").on("change", function () {
            var is_empty=$(this).val();
            
            if(is_empty)
            {
            $("#textarea_<?php echo e($name); ?>").summernote('pasteHTML', '<img src="'+$(this).val()+'" style="width:100px;height:100px;"> ');                    
            }


            $(this).val("");

        });
</script>
<?php $__env->stopPush(); ?>
<div class='form-group' id='form-group-<?php echo e($name); ?>' style="<?php echo e(@$form['style']); ?>">
<label class='control-label col-sm-2'><?php echo e($form['label']); ?></label>

<div class="<?php echo e($col_width?:'col-sm-10'); ?>">
<input type="hidden" id="input_<?php echo e($name); ?>">
<!-- <a class="btn btn-primary" data-toggle="modal" onclick="openIfram('<?php echo e($name); ?>','<?php echo e(CRUDBooster::getCurrentModule()->table_name); ?>','<?php echo e(CRUDbooster::getCurrentId()); ?>')" data-target="#model_scrach">edit from scratch</a> -->
    <textarea id='textarea_<?php echo e($name); ?>'  <?php echo e($required); ?> <?php echo e($readonly); ?> <?php echo e($disabled); ?> name="<?php echo e($form['name']); ?>" class='form-control'
              rows='5'><?php echo e($value); ?></textarea>
    <div class="text-danger"><?php echo e($errors->first($name)); ?></div>
    <p class='help-block'><?php echo e(@$form['help']); ?></p>
</div>
</div>


<div class="modal fade" id="modalInsertPhotoEditor" >
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


<style>
   #model_scrach .modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

#model_scrach .modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
</style>

<div class="modal fade" id="model_scrach"style="height:100%;width:100%" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Insert Image</h4>
            </div>
            <div class="modal-body" style="display: contents" >
                <iframe id="full-screen-me" src="" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" frameborder="0" wmode="transparent"></iframe>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="modelForms" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Select Form</h4>
                </div>
                <div class="modal-body" style="padding:0px; margin:0px; width: 100%;">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            id
                                        </th>
                                        <th>
                                            title
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-forms">
        
                                </tbody>
                            </table>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
    function openIfram(field_name,table_name,current_id){
        
        var url="<?php echo e(URL::to('/')); ?>"+"/modules/fromscratch?filed_name="+field_name+"&table_name="+table_name+"&current_id="+current_id;
        $("#full-screen-me").attr("src", url);

    }
    </script>