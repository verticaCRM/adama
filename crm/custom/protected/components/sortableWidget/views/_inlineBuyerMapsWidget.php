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
    Yii::app()->theme->baseUrl.'/css/components/sortableWidget/views/inlineBuyerMapsWidget.css'
);


$relationshipsDataProvider = $this->getDataProvider ();
?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&callback=initMap" async defer></script>

<style>
    #buyer_map {
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
var primary_ponit;
var markersArray = [];
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
    <div class="option_holder"><label>Asking Price between: </label><div class="input_holder"><input name="map_c_listing_askingprice_c_start" id="map_c_listing_askingprice_c_start"> - <input name="map_c_listing_askingprice_c_end" id="map_c_listing_askingprice_c_end"></div></div>
    <div class="option_holder"><label>Owners Cash Flow between: </label><div class="input_holder"><input name="map_c_ownerscashflow_start" id="map_c_ownerscashflow_start"> - <input name="map_c_ownerscashflow_end" id="map_c_ownerscashflow_end"></div></div>
    <div class="option_holder"><label>Down Payment between: </label><div class="input_holder"><input name="map_c_listing_downpayment_c_start" id="map_c_listing_downpayment_c_start"> - <input name="map_c_listing_downpayment_c_end" id="map_c_listing_downpayment_c_end"></div></div>
    <div class="option_holder"><label>Business Categories: </label><div class="input_holder">
        <select name="map_business_type" id="map_business_type">
            <option value="">-select-</option>
            <option value="Apparel">Apparel</option>
            <option value="Biotechnology">Biotechnology</option>
            <option value="Chemicals">Chemicals</option>
            <option value="Communications">Communications</option>
            <option value="Construction">Construction</option>
            <option value="Consulting">Consulting</option>
            <option value="Education">Education</option>
            <option value="Electronics">Electronics</option>
            <option value="Energy">Energy</option>
            <option value="Engineering">Engineering</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Environmental">Environmental</option>
            <option value="Finance">Finance</option>
            <option value="Government">Government</option>
            <option value="Healthcare">Healthcare</option>
            <option value="Hospitality">Hospitality</option>
            <option value="Insurance">Insurance</option>
            <option value="Machinery">Machinery</option>
            <option value="Manufacturing">Manufacturing</option>
            <option value="Media">Media</option>
            <option value="Not For Profit">Not For Profit</option>
            <option value="Recreation">Recreation</option>
            <option value="Retail">Retail</option>
            <option value="Shipping">Shipping</option>
            <option value="Technology">Technology</option>
            <option value="Telecommunications">Telecommunications</option>
            <option value="Transportation">Transportation</option>
            <option value="Utilities">Utilities</option>
            <option value="Other">Other</option>
            <option value="Absentee Business">Absentee Business</option>
            <option value="Accounting/Payroll/Tax">Accounting/Payroll/Tax</option>
            <option value="Adult home/assisted living">Adult home/assisted living</option>
            <option value="Advertising/Printing">Advertising/Printing</option>
            <option value="Agents/Brokers">Agents/Brokers</option>
            <option value="Agricultural Supplies">Agricultural Supplies</option>
            <option value="AGRICULTURE">AGRICULTURE</option>
            <option value="All Industries">All Industries</option>
            <option value="Amusement Parks/Arcades/Recreation">Amusement Parks/Arcades/Recreation</option>
            <option value="Apparel and Accessory Store">Apparel and Accessory Store</option>
            <option value="Apparel &amp; Finished conditions">Apparel &amp; Finished conditions</option>
            <option value="Art Galleries">Art Galleries</option>
            <option value="Art/Mirror/Framing Retail">Art/Mirror/Framing Retail</option>
            <option value="Assets Only Sale">Assets Only Sale</option>
            <option value="Automotive Dealers/Auto Retail">Automotive Dealers/Auto Retail</option>
            <option value="Auto Repair">Auto Repair</option>
            <option value="Auto/Truck Mechanical Repair">Auto/Truck Mechanical Repair</option>
            <option value="Bagel Stores">Bagel Stores</option>
            <option value="Bakers &amp; Confectioners">Bakers &amp; Confectioners</option>
            <option value="Banking">Banking</option>
            <option value="Bar/Tavern/Night Clubs">Bar/Tavern/Night Clubs</option>
            <option value="Beauty Salon/Barber Shop">Beauty Salon/Barber Shop</option>
            <option value="Beer Distributor">Beer Distributor</option>
            <option value="Best Deals!">Best Deals!</option>
            <option value="Bldg Materials/Hardware/Garden">Bldg Materials/Hardware/Garden</option>
            <option value="Bookstore">Bookstore</option>
            <option value="Building">Building</option>
            <option value="Business/Office Supplies">Business/Office Supplies</option>
            <option value="Business Services (Biz-to-biz)">Business Services (Biz-to-biz)</option>
            <option value="Business with Property Available">Business with Property Available</option>
            <option value="Card Shop/Stationery Store">Card Shop/Stationery Store</option>
            <option value="Carpet Sales &amp; Installation">Carpet Sales &amp; Installation</option>
            <option value="Car Wash">Car Wash</option>
            <option value="Catering and Event Planning">Catering and Event Planning</option>
            <option value="Chemicals &amp; Allied conditions">Chemicals &amp; Allied conditions</option>
            <option value="Children">Children</option>
            <option value="Cleaning Services">Cleaning Services</option>
            <option value="CONSTRUCTION BUSINESSES">CONSTRUCTION BUSINESSES</option>
            <option value="Consumer Services">Consumer Services</option>
            <option value="Convenience Store">Convenience Store</option>
            <option value="Delicatessen/Catering Services">Delicatessen/Catering Services</option>
            <option value="Distressed Sales!">Distressed Sales!</option>
            <option value="Domain Names/Basic Sites">Domain Names/Basic Sites</option>
            <option value="Dry Cleaning/Laundry Services">Dry Cleaning/Laundry Services</option>
            <option value="Durable Goods (conditions)">Durable Goods (conditions)</option>
            <option value="Educational Services/Schools">Educational Services/Schools</option>
            <option value="Electronic &amp; Electrical Equipment">Electronic &amp; Electrical Equipment</option>
            <option value="Electronics &amp; Technology">Electronics &amp; Technology</option>
            <option value="Engineering &amp; Accounting Services">Engineering &amp; Accounting Services</option>
            <option value="Equipment Rental and Sales">Equipment Rental and Sales</option>
            <option value="Fabricated Metal conditions">Fabricated Metal conditions</option>
            <option value="Farms">Farms</option>
            <option value="Fast Food Franchise">Fast Food Franchise</option>
            <option value="Florists">Florists</option>
            <option value="Food &amp; Kindred (Food Related) conditions">Food &amp; Kindred (Food Related) conditions</option>
            <option value="Freight Moving/Delivery/Storage/Warehousing">Freight Moving/Delivery/Storage/Warehousing</option>
            <option value="Gasoline Service Station">Gasoline Service Station</option>
            <option value="General Internet">General Internet</option>
            <option value="General Merchandise Store">General Merchandise Store</option>
            <option value="Gift and Specialty Retail">Gift and Specialty Retail</option>
            <option value="Gift Basket Companies">Gift Basket Companies</option>
            <option value="Gift Basket Company">Gift Basket Company</option>
            <option value="Graphic Designs">Graphic Designs</option>
            <option value="Green Businesses">Green Businesses</option>
            <option value="Green Grocers/Fruit Sellers">Green Grocers/Fruit Sellers</option>
            <option value="Gym/Health Club">Gym/Health Club</option>
            <option value="Health/Beauty/Nutrition Supply">Health/Beauty/Nutrition Supply</option>
            <option value="Healthcare Related Services">Healthcare Related Services</option>
            <option value="Health/Medical/Dental Practices">Health/Medical/Dental Practices</option>
            <option value="Heavy Construction">Heavy Construction</option>
            <option value="Home-Based Business">Home-Based Business</option>
            <option value="Home Furniture/Furnishings">Home Furniture/Furnishings</option>
            <option value="Hotel/Motel &amp; Other Lodging">Hotel/Motel &amp; Other Lodging</option>
            <option value="HR/Staffing">HR/Staffing</option>
            <option value="HVAC">HVAC</option>
            <option value="Ice Cream Parlour">Ice Cream Parlour</option>
            <option value="Illness Forces Sale!">Illness Forces Sale!</option>
            <option value="Industrial &amp; Commercial Machinery">Industrial &amp; Commercial Machinery</option>
            <option value="INTERNET/TECHNOLOGY BUSINESSES">INTERNET/TECHNOLOGY BUSINESSES</option>
            <option value="ISP/ASP Services">ISP/ASP Services</option>
            <option value="Jewelry Store">Jewelry Store</option>
            <option value="Landscaping &amp; Yard Services">Landscaping &amp; Yard Services</option>
            <option value="Laundromats">Laundromats</option>
            <option value="Leather &amp; Leather conditions">Leather &amp; Leather conditions</option>
            <option value="Legal Services">Legal Services</option>
            <option value="Liquor Store/Wine">Liquor Store/Wine</option>
            <option value="MANUFACTURING BUSINESSES">MANUFACTURING BUSINESSES</option>
            <option value="Marine Dealers &amp; Equipment">Marine Dealers &amp; Equipment</option>
            <option value="Marine Repair Parts &amp; Services">Marine Repair Parts &amp; Services</option>
            <option value="Measuring &amp; Analyzing Instruments">Measuring &amp; Analyzing Instruments</option>
            <option value="Misc. Agriculture">Misc. Agriculture</option>
            <option value="Misc. Construction/Non-classifiable">Misc. Construction/Non-classifiable</option>
            <option value="Misc. Internet/Technology/Non-classifiable">Misc. Internet/Technology/Non-classifiable</option>
            <option value="Misc. Manufacturing/Non-classifiable">Misc. Manufacturing/Non-classifiable</option>
            <option value="Misc. Retail/Non-classifiable">Misc. Retail/Non-classifiable</option>
            <option value="Misc. Services/Non-classifiable">Misc. Services/Non-classifiable</option>
            <option value="Misc. Wholesale/Distribution/Non-classifiable">Misc. Wholesale/Distribution/Non-classifiable</option>
            <option value="Motion Pictures">Motion Pictures</option>
            <option value="Must Sell/Drastic Price Reduction!">Must Sell/Drastic Price Reduction!</option>
            <option value="Nail Salons">Nail Salons</option>
            <option value="New To Market">New To Market</option>
            <option value="Non-Durable Goods (services/occupations)">Non-Durable Goods (services/occupations)</option>
            <option value="Nutrition &amp; Health Food">Nutrition &amp; Health Food</option>
            <option value="Optical">Optical</option>
            <option value="Other Business Services">Other Business Services</option>
            <option value="Other Eating &amp; Drinking Places">Other Eating &amp; Drinking Places</option>
            <option value="Other Food Stores">Other Food Stores</option>
            <option value="Pack &amp; Ship Store">Pack &amp; Ship Store</option>
            <option value="Passenger Transportation/Ambulette">Passenger Transportation/Ambulette</option>
            <option value="Pet Care &amp; Grooming">Pet Care &amp; Grooming</option>
            <option value="Pet Shop/Supplies">Pet Shop/Supplies</option>
            <option value="Pharmacies">Pharmacies</option>
            <option value="Photo studio/development">Photo studio/development</option>
            <option value="Pizza Parlour">Pizza Parlour</option>
            <option value="Primary Metal Industries">Primary Metal Industries</option>
            <option value="Printing/Publishing">Printing/Publishing</option>
            <option value="Professional Services">Professional Services</option>
            <option value="Repair Services">Repair Services</option>
            <option value="Restaurant/Cafes">Restaurant/Cafes</option>
            <option value="Restaurant Equipment Suppliers">Restaurant Equipment Suppliers</option>
            <option value="RETAILING BUSINESSES">RETAILING BUSINESSES</option>
            <option value="Routes">Routes</option>
            <option value="Rubber &amp; Plastic conditions">Rubber &amp; Plastic conditions</option>
            <option value="Schools/Education">Schools/Education</option>
            <option value="Screen Printing (T-Shirts &amp; Ad Specialties)">Screen Printing (T-Shirts &amp; Ad Specialties)</option>
            <option value="Security and Alarm Services">Security and Alarm Services</option>
            <option value="Seller Financing Available">Seller Financing Available</option>
            <option value="SERVICES BUSINESSES">SERVICES BUSINESSES</option>
            <option value="Shoe Repair">Shoe Repair</option>
            <option value="Sign Business">Sign Business</option>
            <option value="Social Services">Social Services</option>
            <option value="Software">Software</option>
            <option value="Spa/DaySpa">Spa/DaySpa</option>
            <option value="SPECIAL SITUATIONS">SPECIAL SITUATIONS</option>
            <option value="Special Trades">Special Trades</option>
            <option value="Sporting Goods/Exercise/Gyms">Sporting Goods/Exercise/Gyms</option>
            <option value="Stone/Clay/Glass/Concrete">Stone/Clay/Glass/Concrete</option>
            <option value="Storage Facility">Storage Facility</option>
            <option value="Supermarket">Supermarket</option>
            <option value="Tanning Salon">Tanning Salon</option>
            <option value="Textile Mill conditions">Textile Mill conditions</option>
            <option value="Tobacco conditions">Tobacco conditions</option>
            <option value="Transportation Equipment">Transportation Equipment</option>
            <option value="Travel Agencies">Travel Agencies</option>
            <option value="Vending Machines">Vending Machines</option>
            <option value="Web Design/Tech Services">Web Design/Tech Services</option>
            <option value="WHOLESALE/DISTRIBUTION BUSINESSES">WHOLESALE/DISTRIBUTION BUSINESSES</option>
            <option value="Winery/Vineyard">Winery/Vineyard</option>
            <option value="Wireless &amp; Mobile Phone">Wireless &amp; Mobile Phone</option>
        </select>
    </div></div>
    <div class="option_holder button_holder"><input type="button" id="map_filter_btn" name="Filter" value="Search"/></div>
</div>

<div id="buyer_map"></div>


<div id="buyerMaps-form"
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
        'header' => Yii::t("contacts", 'Listing'),
        'value' => '(isset($data->name))
            ? CHtml::link($data->name,Yii::app()->createUrl("clistings",array($data->id=>"")),array())
            : ""
            ',

        /*  'value' =>  function($data){
                  printR('data');
                 printR($data);
                 die();

              },
  */
    ),
    array(
        'name'=>'c_name_dba_c',
        'type'=>'raw',
        'header' => Yii::t("contacts", 'DBA'),
        'value' => '(isset($data->c_name_dba_c))
            ? CHtml::link($data->c_name_dba_c,Yii::app()->createUrl("clistings",array($data->id=>"")),array())
            : ""
            ',


    ),

    array(
        'name' => 'c_listing_askingprice_c',
        'header' => Yii::t("contacts", 'Asking Price'),
        'value' => '$data->renderAttribute("c_listing_askingprice_c")',

        'type' => 'raw',
    ),
    array(
        'name' => 'c_ownerscashflow',
        'header' => Yii::t("contacts", 'Cash Flow'),
        'value' => '$data->renderAttribute("c_ownerscashflow")',

        'type' => 'raw',
    ),
    array(
        'name' => 'c_listing_region_c',
        'header' => Yii::t("contacts", 'State'),
        'value' => '$data->renderAttribute("c_listing_region_c")',

        'type' => 'raw',
    ),
    array(
        'name' => 'c_listing_city_c',
        'header' => Yii::t("contacts", 'City'),
        'value' => '$data->renderAttribute("c_listing_city_c")',

        'type' => 'raw',
    ),
    array(
        'name' => 'c_listing_town_c',
        'header' => Yii::t("contacts", 'County'),
        'value' => '$data->renderAttribute("c_listing_town_c")',

        'type' => 'raw',
    ),

    array(
        'name' => 'c_sales_stage',
        'header' => Yii::t('contacts', 'Status'),
        'value' => '$data->renderAttribute("c_sales_stage")',
        'type' => 'raw'
    ),


);
//var_dump('HERE2');
//var_dump($this->getFilterModel ());
//die();

$this->widget('X2GridViewGeneric', array(
    'id' => "buyerMaps-grid",
    'enableGridResizing' => true,
    'showHeader' => CPropertyValue::ensureBoolean (
        $this->getWidgetProperty('showHeader')),
    'defaultGvSettings' => array (
        'nameId' => '22%',
        'c_name_dba_c' => '13%',
       // 'c_seller' => '15%',
        'c_listing_askingprice_c' => '10%',
        'c_listing_region_c' => '10%',
        'c_ownerscashflow' => '10%',
        'c_listing_city_c' => '10%',
        'c_listing_town_c' => '10%',
        'c_sales_stage' => '10%',
     //   'c_is_hidden' => '10%',
      //  'city' => '10%',
      ////  'country' => '10%',
      //  'state' => '10%',
      //  'phone' => '10%',
      //  'email' => '10%',

    ),
    'filter' => $this->getFilterModel (),
    'htmlOptions' => array (
        'class' =>
            ($relationshipsDataProvider->itemCount < $relationshipsDataProvider->totalItemCount ?
            'grid-view has-pager' : 'grid-view'),
    ),
    'dataColumnClass' => 'X2DataColumnGeneric',
    'gvSettingsName' => 'inlineBuyerMapsGrid',
    'buttons'=>array('clearFilters','autoResize'),
    'template' => '<div class="title-bar">{summary}</div>{buttons}{items}{pager}',
    'afterAjaxUpdate' => 'js: function(id, data) { refreshQtip(); }',
    'dataProvider' => $relationshipsDataProvider,
    'columns' => $columns,
    'enablePagination' => true,
));
?>

</div>
