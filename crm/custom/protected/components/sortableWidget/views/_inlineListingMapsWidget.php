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
Yii::app()->clientScript->registerCssFile(
    Yii::app()->theme->baseUrl.'/css/components/sortableWidget/views/inlineListingMapsWidget.css'
);


// init qtip for contact names
Yii::app()->clientScript->registerScript('contact-qtip', '
function refreshQtip() {
    $("#buyersPortfolio-grid .contact-name").each(function (i) {
        var contactId = $(this).attr("href").match(/\\d+$/);

        if(contactId !== null && contactId.length) {
            $(this).qtip({
                content: {
                    text: "'.addslashes(Yii::t('app','loading...')).'",
                    ajax: {
                        url: yii.baseUrl+"/index.php/contacts/qtip",
                        data: { id: contactId[0] },
                        method: "get"
                    }
                },
                style: {
                }
            });
        }
    });

    if($("#BuyersPortfolio_Contacts_autocomplete").length == 1 &&
        $("BuyersPortfolio_Contacts_autocomplete").data ("uiAutocomplete")) {
        $("#BuyersPortfolio_Contacts_autocomplete").data( "uiAutocomplete" )._renderItem =
            function( ul, item ) {

            var label = "<a style=\"line-height: 1;\">" + item.label;
            label += "<span style=\"font-size: 0.7em; font-weight: bold;\">";
            if(item.city || item.state || item.country) {
                label += "<br>";

                if(item.city) {
                    label += item.city;
                }

                if(item.state) {
                    if(item.city) {
                        label += ", ";
                    }
                    label += item.state;
                }

                if(item.country) {
                    if(item.city || item.state) {
                        label += ", ";
                    }
                    label += item.country;
                }
            }
            if(item.assignedTo){
                label += "<br>" + item.assignedTo;
            }
            label += "</span>";
            label += "</a>";

            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( label )
                .appendTo( ul );
        };
    }
}

$(function() {
    refreshQtip();
});
');

$relationshipsDataProvider = $this->getDataProvider ();


?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&callback=initMap" async defer></script>

<style>
    #listing_map {
        height: 500px;
        width: 100%;
        margin-bottom:20px;
    }
    #map_radius_holder{
        background: #fff none repeat scroll 0 0;
        border: 2px solid #ddd;
        border-radius: 5px;
        font-size: 12px;
        margin: 10px;
        padding: 5px 10px;
        z-index: 10000;
    }
    #map_radius_holder .option_holder{
        margin: 5px 0;
    }
    #map_radius_holder .option_holder.button_holder{
        text-align:center;
        margin:20px 0 15px 0;
    }
    #map_radius_holder input {
        width: 90px;
        padding: 4px;
        border-radius: 4px;
        border:1px solid #ddd;
    }
    #map_radius_holder select {
        padding: 4px;
        border-radius: 4px;
        border:1px solid #ddd;
    }
    #map_radius_holder input#map_c_listing_address_c {
        width:200px;
    }
    #map_radius_holder label {
        width: 25%; display: inline-block;padding-top: 5px;
    }
    #map_radius_holder .input_holder {
        width: 70%; display: inline-block;  margin-top: 5px; vertical-align: top;
    }
</style>


<script>
//var address = "42 Broadway Suite 1815";

//var listingsArray = [];
// Multiple Markers
/*
 var markers = [
 '2 Thornbrook Lane',
 '3310 Webley Ct.'
 ]
 */

</script>
<div id="map_radius_holder" >
    <div class="option_holder"><label>Address: </label>
        <div class="input_holder"><input name="map_c_listing_address_c" id="map_c_listing_address_c" value="<?php echo $default_address; ?>"></div>
        <div><small>You can type in this field the city name, ZIP code, street name etc.</small></div>
    </div>
    <div class="option_holder">
        <label>Radius: </label><div class="input_holder"><input name="map_radius" id="map_radius" value="1000">
            &nbsp;
            <select name="map_radius_unit" id="map_radius_unit">
                <option value="Km" >Km</option>
                <option value="Miles" selected>Miles</option>
            </select>
        </div>
    </div>
    <div class="option_holder">
        <label>Status: </label><div class="input_holder"><select id="map_c_buyer_status" name="map_c_buyer_status" title="Buyer Status" tabindex="undefined">
            <option value="">--</option>
            <option value="Web Lead / Inquiry">Web Lead / Inquiry</option>
            <option selected="selected" value="Unregistered">Unregistered</option>
            <option value="Registered">Registered</option>
            <option value="Rejected">Rejected</option>
        </select>
        </div>
    </div>
    <div class="option_holder"><label>Net Cash Flow Desired: </label><div class="input_holder"><input name="map_c_NetCashFlowDesired_start" id="map_c_NetCashFlowDesired_start"> - <input name="map_c_NetCashFlowDesired_end" id="map_c_NetCashFlowDesired_end"></div></div>
    <div class="option_holder button_holder"><input type="button" id="map_filter_btn" name="Filter" value="Search"/></div>
</div>

<div id="listing_map"></div>


<div id="listingMaps-form"
    <?php /* x2prostart */ ?>
     style="<?php echo ($displayMode === 'grid' ?  '' : 'display: none;'); ?>"
    <?php /* x2proend */ ?>
     class="<?php echo ($this->getWidgetProperty ('mode') === 'simple' ?
         'simple-mode' : 'full-mode'); ?>">

<?php



$columns = array(
    array(
        'name'=>'nameId',
        'type'=>'raw',
        'header' => Yii::t("contacts", 'Buyer'),
        'value' => '(isset($data->relatedModel->name))
            ? CHtml::link($data->relatedModel->name,Yii::app()->createUrl("contacts",array($data->relatedModel->id=>"")),array())
            : ""
            ',
        /*'value' =>  function($data){
                printR($data->relatedModel); die();

                $c_buyer_status = '-';
               return $c_buyer_status;

            },
        'type' => 'raw',*/

    ),
    /*array(
        'name' => 'assignedTo',
        'header' => Yii::t("contacts", 'Broker'),
       // 'value' => '$data->relatedModel->Contacts->renderAttribute("c_broker")',
       // 'value' => '$data->relatedModel->Contacts->renderAttribute("assignedTo")',
        'value' =>  function($data){
                if (isset($data->relatedModel->Contacts->c_broker))
                {
                    $c_broker = $data->relatedModel->Contacts->renderAttribute("c_broker");
                }
                else
                {
                    $c_broker = '-';
                }

                return $c_broker;

            },
        'type' => 'raw',
    ),*/
   /* array(
        'name' => 'c_seller',
        'header' => Yii::t("contacts", 'Seller'),
        'value' => '$data->relatedModel->Clisings->renderAttribute("c_seller")',
        'type' => 'raw',
    ),*/
    /*array(
        'name' => 'c_listing_date_approved_c',
        'header' => Yii::t("contacts", 'Date approved'),
        'value' => '$data->relatedModel->Clisings->renderAttribute("c_listing_date_approved_c")',

        'type' => 'raw',
    ),
    array(
        'name' => 'leadstatus',
        'header' => Yii::t("contacts", 'Buyer Status'),
        //'value' => '$data->relatedModel->Contacts->renderAttribute("c_buyer_status")',
        'value' =>  function($data){
                if (isset($data->relatedModel->Contacts->c_buyer_status))
                {
                    $c_buyer_status = $data->relatedModel->Contacts->renderAttribute("c_buyer_status");
                }
                else
                {
                    $c_buyer_status = '-';
                }

                return $c_buyer_status;

            },
        'type' => 'raw',
    ),
    array(
        'name' => 'createDate',
        'header' => Yii::t('contacts', 'Added Date'),
        'value' => '$data->renderAttribute("createDate")',
        'filterType' => 'dateTime',
        'type' => 'raw'
    ),
    array(
        'name' => 'c_created_by_user',
        'header' => Yii::t('contacts', 'Added By'),
        'value' =>  function($data){
                if ($data->relatedModel->c_created_by_user != '')
                {
                    $CreatedBy = $data->relatedModel->renderAttribute("c_created_by_user");
                }
                else
                {
                    $CreatedBy = $data->relatedModel->renderAttribute("c_create_by_buyer");
                }

                return $CreatedBy;

            },

        'type' => 'raw'
    ),
    array(
        'name' => 'c_added_from',
        'header' => Yii::t('contacts', 'Added From'),
        'value' => '$data->renderAttribute("c_added_from")',
        'type' => 'raw'
    ),

    array(
        'name' => 'c_released_by',
        'header' => Yii::t('contacts', 'Released By'),
        //'value' => '$data->renderAttribute("c_released_by")',
        'value' =>  function($data){
                if ($data->relatedModel->c_released_by != '' && $data->relatedModel->c_released_by != 'Anyone')
                {
                    $c_released_by = $data->relatedModel->renderAttribute("c_released_by");
                }
                else
                {
                    $c_released_by = '-';
                }

                return $c_released_by;

               //return '-';
            },
        'type' => 'raw'
    ),

    array(
        'name' => 'c_date_released',
        'header' => Yii::t('contacts', 'Released Date'),
        'value' => '$data->renderAttribute("c_date_released")',
       // 'value' => '$data->relatedModel->Portfolio->renderAttribute("c_date_released")',
      //  'value' => ' Formatter::formatCompleteDate($data->c_date_released) ',
        'filterType' => 'dateTime',
        'type' => 'raw'
    ),
    */
    array(
        'name' => 'phone',
        'header' => Yii::t('contacts', 'Phone'),
        'value' => '$data->relatedModel->renderAttribute("phone")',
        'type' => 'raw'
    ),
    array(
        'name' => 'email',
        'header' => Yii::t('contacts', 'Email'),
        'value' => '$data->relatedModel->renderAttribute("c_email")',
        'type' => 'raw'
    ),
    /*array(
        'name' => 'c_release_status',
        'header' => Yii::t('contacts', 'Status'),
        'value' => '$data->renderAttribute("c_release_status")',
        'type' => 'raw'
    ),*/
    /*array(
        'name' => 'c_is_hidden',
        'header' => Yii::t('contacts', 'Is Hidden'),
        'value' =>  function($data){
                $c_is_hidden = $data->getHiddenStatus();
                if ($c_is_hidden == 0)
                {
                    $hiddenStatus = 'Visible';
                }
                else
                {
                    $hiddenStatus = 'Hidden';
                }

                return $hiddenStatus;

            },
        'type' => 'raw'
    ),
    */
    array(
        'name' => 'city',
        'header' => Yii::t("contacts", 'City'),
        'value' => '$data->relatedModel->renderAttribute ("city")',
        'type' => 'raw',
    ),
    array(
        'name' => 'country',
        'header' => Yii::t("contacts", 'County'),
        'value' => '$data->relatedModel->renderAttribute("country")',
        'type' => 'raw',
    ),
    array(
        'name' => 'state',
        'header' => Yii::t("contacts", 'State'),
        'value' => '$data->relatedModel->renderAttribute("state")',
        'type' => 'raw',
    ),



);
//var_dump('HERE2');
//var_dump($this->getFilterModel ());
//die();

$this->widget('X2GridViewGeneric', array(
    'id' => "listingMaps-grid",
    'enableGridResizing' => true,
    'showHeader' => CPropertyValue::ensureBoolean (
        $this->getWidgetProperty('showHeader')),
    'defaultGvSettings' => array (
        'nameId' => '22%',
       // 'assignedTo' => '13%',
       // 'c_seller' => '15%',
       /* 'c_listing_date_approved_c' => '10%',
        'leadstatus' => '10%',
        'createDate' => '10%',
        'c_created_by_user' => '10%',
        'c_added_from' => '10%',
        'c_date_released' => '10%',
        'c_release_status' => '10%',
        'c_released_by' => '10%',
     //   'c_is_hidden' => '10%',*/
        'phone' => '10%',
        'email' => '10%',
        'city' => '10%',
        'country' => '10%',
        'state' => '10%',
    ),
    'filter' => $this->getFilterModel (),
    'htmlOptions' => array (
        'class' =>
            ($relationshipsDataProvider->itemCount < $relationshipsDataProvider->totalItemCount ?
            'grid-view has-pager' : 'grid-view'),
    ),
    'dataColumnClass' => 'X2DataColumnGeneric',
    'gvSettingsName' => 'inlineListingMapsGrid',
    'buttons'=>array('clearFilters','autoResize'),
    'template' => '<div class="title-bar">{summary}</div>{buttons}{items}{pager}',
    'afterAjaxUpdate' => 'js: function(id, data) { refreshQtip(); }',
    'dataProvider' => $relationshipsDataProvider,
    'columns' => $columns,
    'enablePagination' => true,
));
?>

</div>
