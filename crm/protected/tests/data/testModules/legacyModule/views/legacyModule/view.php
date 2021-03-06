<?php
/*********************************************************************************
 * Copyright (C) 2011-2014 X2Engine Inc. All Rights Reserved.
 *
 * X2Engine Inc.
 * P.O. Box 66752
 * Scotts Valley, California 95067 USA
 *
 * Company website: http://www.x2engine.com
 * Community and support website: http://www.x2community.com
 *
 * X2Engine Inc. grants you a perpetual, non-exclusive, non-transferable license
 * to install and use this Software for your internal business purposes.
 * You shall not modify, distribute, license or sublicense the Software.
 * Title, ownership, and all intellectual property rights in the Software belong
 * exclusively to X2Engine.
 *
 * THIS SOFTWARE IS PROVIDED "AS IS" AND WITHOUT WARRANTIES OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, AND NON-INFRINGEMENT.
 ********************************************************************************/

Yii::app()->clientScript->registerCss('contactRecordViewCss',"

#content {
    background: none !important;
    border: none !important;
}
");

Yii::app()->clientScript->registerResponsiveCssFile(
    Yii::app()->theme->baseUrl.'/css/responsiveRecordView.css');

include("protected/modules/templates/templatesConfig.php");

$this->actionMenu = $this->formatMenu(array(
	array('label'=>Yii::t('module','{X} List',array('{X}'=>$moduleConfig['recordName'])), 'url'=>array('index')),
	array('label'=>Yii::t('module','Create {X}',array('{X}'=>$moduleConfig['recordName'])), 'url'=>array('create')),
	array('label'=>Yii::t('module','View {X}',array('{X}'=>$moduleConfig['recordName']))),
	array('label'=>Yii::t('module','Edit {X}',array('{X}'=>$moduleConfig['recordName'])), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('module','Delete {X}',array('{X}'=>$moduleConfig['recordName'])), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
    array(
        'label' => Yii::t('app', 'Send Email'), 'url' => '#',
        'linkOptions' => array('onclick' => 'toggleEmailForm(); return false;')),
    array('label' => Yii::t('app', 'Attach A File/Photo'), 'url' => '#', 'linkOptions' => array('onclick' => 'toggleAttachmentForm(); return false;')),
    array('label' => Yii::t('quotes', 'Quotes/Invoices'), 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => 'x2.inlineQuotes.toggle(); return false;')),
    array(
        'label' => Yii::t('app', 'Print Record'),
        'url' => '#',
        'linkOptions' => array (
            'onClick'=>"window.open('".
                Yii::app()->createUrl('/site/printRecord', array (
                    'modelClass' => "Templates",
                    'id' => $model->id,
                    'pageTitle' => 
                        Yii::t('app', '{X}', array ('{X}' => $moduleConfig['recordName'])).': '.$model->name
                ))."');"
        ),
    ),
));

$modelType = json_encode("Templates");
$modelId = json_encode($model->id);

Yii::app()->clientScript->registerScript('widgetShowData', "
$(function() {
	$('body').data('modelType', $modelType);
	$('body').data('modelId', $modelId);
});");
?>
<div class="page-title-placeholder"></div>
<div class="page-title-fixed-outer">
    <div class="page-title-fixed-inner">
<div class="page-title icon">
    <h2>
        <?php 
        echo Yii::t('module','View {X}',array('{X}'=>$moduleConfig['recordName'])); ?>: <?php 
        echo $model->name; 
        ?>
    </h2>
    <?php
    echo CHtml::link(
        '<span></span>', $this->createUrl('update', array('id' => $model->id)),
        array(
            'class' => 'x2-button icon edit right',
            'title' => Yii::t('app', 'Edit {X}', array('{X}'=>$moduleConfig['recordName'])),
        )
    );
    echo CHtml::link(
        '<img src="'.Yii::app()->request->baseUrl.'/themes/x2engine/images/icons/email_button.png'.
            '"></img>', '#',
        array(
            'class' => 'x2-button icon right email',
            'title' => Yii::t('app', 'Open email form'),
            'onclick' => 'toggleEmailForm(); return false;'
        )
    );
    ?>
</div>
</div>
</div>
<div id="main-column" class="half-width">
<?php $this->renderPartial('application.components.views._detailView',array('model'=>$model, 'modelName'=>'templates')); ?>

<?php

$this->widget('InlineEmailForm',
	array(
		'attributes'=>array(
			'to'=>implode (', ', $model->getRelatedContactsEmails ()),
			'modelName'=> get_class ($model),
			'modelId'=>$model->id,
		),
		'insertableAttributes' => 
            array(
                Yii::t('module','{modelName} Attributes',
                    array ('{modelName}' => get_class ($model))) => 
                        $model->getEmailInsertableAttrs ($model)
            ),
		'startHidden'=>true,
	)
);

$this->widget('Attachments', array('associationType' => 'templates', 'associationId' => $model->id, 'startHidden' => true)); 

$this->widget('X2WidgetList', array('model'=>$model));
?>
<div id="quote-form-wrapper">
    <?php
    $this->widget('InlineQuotes', array(
        'startHidden' => true,
        'contactId' => $model->id,
        'modelName' => X2Model::getModuleModelName ()
    ));
    ?>
</div>
</div>
<div class="history half-width">
<?php
$this->widget('Publisher',
	array(
		'associationType'=>'templates',
		'associationId'=>$model->id,
		'assignedTo'=>Yii::app()->user->getName(),
		'calendar' => false
	)
);
$this->widget('History',array('associationType'=>'templates','associationId'=>$model->id));
?>
</div>
