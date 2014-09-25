<script>
    jcf.customForms.replaceAll();

    $('#download_file').click(function(){
        var list = null, res = new Array(), posts = '';
        var i = 1;

        list = $('.form_documents input:checkbox:checked');
        list.each( function() {
            res[i] = $(this).val();
            posts += 'doc'+i+'='+res[i]+'&';
            i++;
        });

        if(i >= 3){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/index.php/ajax/documents',
                data: posts,
                success: function (data) {
                    if(data.true) {
                        location.href = "/documents/"+data.true;
                        $.colorbox.close();
                    }
                }
            });
        }else{
            window.open('/documents/'+res[1]);
            $.colorbox.close();
        }

        return false;
    });
</script>
<div id="inline-content">
    <?php echo CHtml::beginForm('','', array('class' => 'form_documents')); ?>
        <div class="popup_header_holder">
            <h1>CHI Marketing Documents</h1>
        </div>
        <p>Please select what marketing documents you would like to download.</p>
<!--        <div class="two-columns group">-->
            <div class="col">
                <?php
                $i = 1;
                foreach($files as $item) : ?>
                    <div class="row group">
                        <input type="checkbox" id="doc<?php echo $i; ?>" name="file<?php echo $i; ?>" value="<?php echo $item->file; ?>" <?php if($_GET['id'] == $item->id) echo 'checked'; ?>>
                        <label for="doc<?php echo $i; ?>"><?php echo $item->title; ?></label>
                    </div>
                    <?php $i++; endforeach; ?>
            </div>
<!--        </div>-->
        <div class="submit-holder">
            <?php
                echo CHtml::SubmitButton('Download Selected Documents', array('id' => 'download_file'));
            ?>
        </div>
        <div class="form-row">
            <label>Email<span>*</span></label>
            <input type="email" id="email" name="email">
        </div>
        <div class="submit-holder">
            <p id="err" style="display: block;"></p>

            <?php
                echo CHtml::ajaxSubmitButton('Send', Yii::app()->request->baseUrl.'/index.php/ajax/documentsemail', array(
                    'type' => 'POST',
                    'dataType' => 'json',
                    'success'=>'function (data) {
                        if(data.true) {
                            function boxClose(){
                                $.colorbox.close();
                            }
                            setTimeout(boxClose,5000);
                            $(".success").html(data.true);
                            $.colorbox.resize();
                        }
                        if(data.error) {
                            $("#err").html(data.error);
                            $("#email").css("border","solid 1px red");
                            $("#err").css("color","red");
                            $.colorbox.resize();
                        }
                    }'
                ),
                array(
                    'type' => 'submit'
                ));
            ?>
        </div>
        <p class="success" style="display: block;"></p>
    <?php echo CHtml::endForm(); ?>
</div>
