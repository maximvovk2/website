<div id="inline-content">
    <form action="/vacancies/sendcv" class="send-cv"  enctype="multipart/form-data">
        <div class="popup_header_holder">
            <h1>vacancy request</h1>
        </div>
        <div class="row-holder">
            <div class="form-row">
                <label>Name<span>*</span></label>
                <input type="text" name="title">
            </div>
            <div class="form-row">
                <label>Email <span>*</span></label>
                <input type="email" name="email">
            </div>
            <div class="form-row msg">
                <label>Comments</label>
                <textarea name="message"></textarea>
            </div>
            <div class="form-row">
                <div class="add-resume">
                    <div class="button">
                        <span>Add resume</span>
                        <input type="file" class="custom-file" name="cv">
                    </div>
                    <span class="name"></span>
                </div>
            </div>
        </div>
        <div class="submit-holder">
            <?php
                echo CHtml::ajaxSubmitButton('Send', Yii::app()->request->baseUrl.'/ajax/SummarySend', array(
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
                            $("#error").html(data.error);
                        }
                    }'
                ),
                array(
                    'type' => 'submit'
                ));
            ?>
        </div>
        <input type="hidden" name="jobid" value="<?php echo $_GET['id']; ?>"/>
    </form>
</div>