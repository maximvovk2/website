

<div class="pages-holder">
    <div class="page">
        <section class="main">
            <div class="m1">
                <div class="m2">
                    <ul class="breadcrumps group">
                        <li><a href="/">Home </a>&nbsp;&gt;&nbsp;&nbsp</li>
                        <li>Contact Us</li>
                    </ul>
                    <div class="section">
                        <div class="contact-box">
                            <ul class="contact-list">
                                <li>
                                    <strong class="title">General queries: </strong>
                                    <a href="mailto:<?php echo $modelContactdata->general; ?>"><?php echo $modelContactdata->general; ?></a>
                                </li>
                                <li>
                                    <strong class="title">Job opportunities</strong>
                                    <a href="mailto:<?php echo $modelContactdata->jobs; ?>"><?php echo $modelContactdata->jobs; ?></a>
                                </li>
                                <li>
                                    <strong class="title">Partnership</strong>
                                    <a href="mailto:<?php echo $modelContactdata->partnership; ?>"><?php echo $modelContactdata->partnership; ?></a>
                                </li>
                            </ul>
                            <div class="other-contacts">
                                <strong class="title">Call</strong>
                                <span class="phone"><?php echo $modelContactdata->phone; ?></span>
                                <strong class="title">Social</strong>
                                <ul class="social-networks">
                                    <li><a href="#" class="facebook">facebook</a></li>
                                    <li><a href="#" class="twitter">twitter</a></li>
                                    <li><a href="#" class="linkedin">linkedin</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="circle-box">
                            <div class="col">
                                <img class="circle-image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/circle12.png" alt="" width="182" height="182">
                                <strong class="title">Headquarters</strong>
                                <span>Moscow, Russia</span>
                            </div>
                            <div class="col">
                                <img class="circle-image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/circle2.png" alt="" width="182" height="182">
                                <strong class="title">Development Center</strong>
                                <span><?php echo $modelContactdata->adress; ?></span>
                            </div>
                        </div><p><a name="ask"></a></p>
                    </div><br><br><br>
                    <div id="inline-content">

                            <?php
                            $form=$this->beginWidget(
                                'CActiveForm',
                                array(
                                    'id'=>'contactus-form',
                                    'action'=>'/staticpages/Contact_us#ask',
                                    'enableAjaxValidation'=>false,
                                    'htmlOptions' => array('class' => 'form_help'),
                                )
                            ); ?>
                            <div class="popup_header_holder">
                                <h1>How can we help you?</h1>

                            </div>
                            <p><a name="ask"></a></p>
                            <?php if(Yii::app()->user->hasFlash('success')):?>
                                <div  class="info">
                                   <h3> <?php echo Yii::app()->user->getFlash('success'); ?></h3>
                                </div>
                            <?php endif; ?>

                            <div class="row-holder">
                                <div class="form-row">
                                    <?php echo $form->labelEx($modelContactus,'name'); ?>
                                    <?php echo $form->textField($modelContactus,'name',array('size'=>40,'maxlength'=>255)); ?>
                                    <?php echo $form->error($modelContactus,'name'); ?>
                                </div>

                                <div class="form-row">
                                    <?php echo $form->labelEx($modelContactus,'email'); ?>
                                    <?php echo $form->textField($modelContactus,'email',array('size'=>40,'maxlength'=>255)); ?>
                                    <?php echo $form->error($modelContactus,'email'); ?>
                                </div>

                                <div class="form-row">
                                    <?php echo $form->labelEx($modelContactus,'subject'); ?>
                                    <?php echo $form->textField($modelContactus,'subject',array('size'=>40,'maxlength'=>255)); ?>
                                    <?php echo $form->error($modelContactus,'subject'); ?>
                                </div>

                                <div class="form-row">
                                    <?php echo $form->labelEx($modelContactus,'body'); ?>
                                    <?php echo $form->textArea($modelContactus,'body',array('rows'=>6, 'cols'=>43)); ?>
                                    <?php echo $form->error($modelContactus,'body'); ?>
                                </div>
                            </div>
                            <div class="submit-holder">
                                <?php echo CHtml::submitButton('Send'); ?>
                            </div>

                            <?php $this->endWidget(); ?>

                            <!--</div>-->

                        </div>
                </div>
            </div>
        </section>
    </div>
</div>

