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


$menuOptions = array(
    'index', 'create', 'import', 'export',
);
$this->insertMenu($menuOptions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('opportunities-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class='flush-grid-view'>
<?php
$this->widget('X2GridView', array(
	'id'=>'product-grid',
	'title'=>Yii::t('products','{module}', array('{module}'=>Modules::displayName())),
	'buttons'=>array('advancedSearch','clearFilters','columnSelector','autoResize','showHidden'),
	'template'=> 
        '<div id="x2-gridview-top-bar-outer" class="x2-gridview-fixed-top-bar-outer">'.
        '<div id="x2-gridview-top-bar-inner" class="x2-gridview-fixed-top-bar-inner">'.
        '<div id="x2-gridview-page-title" '.
         'class="page-title icon quotes x2-gridview-fixed-title">'.
        '{title}{buttons}{filterHint}'.
        /* x2prostart */'{massActionButtons}'./* x2proend */
        '{summary}{topPager}{items}{pager}',
    'fixedHeader'=>true,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('class'=>'CLinkPager','maxButtonCount'=>10),
	'modelName'=>'Product',
	'viewName'=>'products',
	// 'columnSelectorId'=>'contacts-column-selector',
	'defaultGvSettings'=>array(
        'gvCheckbox' => 30,
		'name' => 244,
		'type' => 67,
		'description' => 117,
		'createDate' => 120,
		'gvControls' => 73,
	),
	'specialColumns'=>array(
		'name'=>array(
			'name'=>'name',
			'header'=>Yii::t('products','Name'),
			'value'=>'$data->link',
			'type'=>'raw',
		),
	),
	'enableControls'=>true,
	'fullscreen'=>true,
));
?>
</div>
