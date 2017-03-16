function formatMoney(amount){
	var n = amount, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

jQuery(document).ready(function() {
jQuery('#form-reg').prop('disabled', true);
 jQuery('#acceptance').change(function() {
console.log( jQuery(this) )
if(jQuery(this).attr("checked")) {
jQuery('#form-reg').prop('disabled', false);
}else{
jQuery('#form-reg').prop('disabled', true);
}
});
});
 
jQuery(document).ready(function(){

	jQuery(".listing_link").click(function(event){
			//event.preventDefault();
			jQuery.getJSON('../_auth.php',{query:	'AJAX',action: 'setpagelistingid',_id:jQuery(this).data("id"),_href:jQuery(this).attr("href")},function(res){
				//console.log(res)
			});
			//jQuery("#listing-form").attr("action",jQuery(this).attr("href"))		
			//jQuery("#listing-id").val(jQuery(this).data("id"))
			//jQuery("#listing-form").submit();
	});
	
	jQuery(".contactbroker").click(function(event){
			var buyer;
			var listing;
			var assignedTo;
			var portfolioid;

targetbroker = jQuery(this).attr('id');
portfolioid = jQuery(this).data('portfolioid')
jQuery.when(jQuery.getJSON('../_auth.php',
	{query:	'AJAX',action: 'x2apicall',_class:"Contacts/"+jQuery(this).data('buyerid')+".json"} 
).done(function(response){
			buyer = response
console.log(buyer)
		}),

			jQuery.getJSON('../_auth.php',
			{query:	'AJAX',action: 'x2apicall',_class:"Clistings/"+jQuery(this).data('listingid')+".json"}
	).done(function(response){
		listing = response
console.log(listing)
		})
	).then(function(){
		assigned = (targetbroker=="contactbuyerbroker")?buyer.assignedTo:listing.assignedTo;
			gender = (buyer.c_gender == "Male")?"him":"her";
console.log(buyer.assignedTo)
console.log(listing.assignedTo)			
console.log(targetbroker)			
console.log(assigned)			
		jsondata = {
		'actionDescription':buyer.firstName+" has requested that you contact "+gender+" regarding the listing "+listing.name+"(id #"+listing.id+"). As the buyer's broker, it is your responsibility to make contact as soon as possible:<br>Phone:"+buyer.phone+"<br>Mobile:"+buyer.c_cellphone+"<br>Alt Phone:"+buyer.c_phone2+"<br><br>Please remember to log this contact and mark this action complete.",
		'assignedTo'	:	assigned,
		'associationId' : portfolioid,
		'associationType' : 'portfolio',
		'associationName' : buyer.name,
		'subject'	:	'Contact Request from '+buyer.name,
		'dueDate':'+4 hours'
		}	
//console.log(jsondata);
		jQuery.getJSON('../_auth.php',
				{query:'AJAX',action: 'x2apicall',_class:"Brokers/by:nameId="+encodeURIComponent(buyer.c_broker)+".json"}
			)
			.done(function(response){
				assignedTo = response
//console.log(jsondata)
//console.log(portfolioid)
//obj = jQuery.parseJSON(jsondata);
			jQuery.when(jQuery.getJSON('../_auth.php',
					{'query':'AJAX','action':'x2apipost','_format':'json','_class':'Portfolio/'+portfolioid+'/Actions','_data':jsondata}	
				)
				).then(function(response){
//console.log(response);
					})
			});
		
	});		
});
});



/////////////////////
/*
Featured Search jQuery Functions
These variables are set in the template file, since they rely on dynamically generated PHP values
@brokerJSON
@authURI
*/
/////////////////////
if (typeof brokerJSON=="undefined"){
brokerJSON = '';
chooseABrokerTxt = '';
pleaseWaitTxt = '';
}
	jQuery(document).ready(function(){ 
	jQuery(".advancedsearch").click(function(event){
	event.preventDefault()
//console.log( jQuery(this).parent().next() );
	 jQuery(this).parent().next("#advanced").show()
	})

jQuery(".broker-select").each( function(){	
	var newBrokers = brokerJSON;
		var el = jQuery(this);
		el.append(jQuery("<option></option>").attr("value", "").text(chooseABrokerTxt));			
			jQuery.each(newBrokers, function(key, value) {
				el.append(jQuery("<option></option>").attr("value", value).text(key));
			});
});

jQuery(".fs_select").change(function(){
stateEl = jQuery(this)
dropdown = stateEl.closest("form").find("#c_listing_town_c")					
dropdown.empty().attr("disabled",true).append(jQuery("<option></option>").attr("value","").text(pleaseWaitTxt));
	jQuery.getJSON(authURI,
	{query:	'AJAX',action: 'x2apicall',_class:"dropdowns/"}, 
	function(response){
			jQuery.each(response, function(key, value) {

				if(value.parentVal==stateEl.val()){

				dropdown.empty().attr("disabled",false).append(jQuery("<option></option>").attr("value", "").text(selectCountyTxt));
				jQuery.each(value.options, function(nam, val) {
					dropdown.append(jQuery("<option></option>").attr("value", val).text(val));
					})	
				}
			});
	});
})		


jQuery("#broker").change(function(){
	jQuery.getJSON(authURI,
	{query:	'AJAX',action: 'x2apicall',_class:"Brokers/by:nameId="+encodeURI(jQuery(this).val())+".json"}, 
	function(response){
//		console.log(response)
		jQuery("#assignedTo").remove();
		jQuery("#form_buyerreg").append("<input type='hidden' id='assignedTo' name='assignedTo' value='"+response.assignedTo+"' />");
	});
})		
	})
