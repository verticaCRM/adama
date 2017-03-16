$(document).ready(function(){

$("#Clistings_c_listing_country_c").on('change',function(){

$.ajax({
            url:"/site/dynamicDropdown",
            type:"GET",
            data:{"val":$(this).val(),"dropdownId":"1001"},
            success:function(data){
            	$("#Clistings_c_listing_region_c").html(data);
				},
				failure:function(data){
					console.log ("FAILURE");
					console.log(data);
				}
})
});

$("#Clistings_c_listing_region_c").on('load change',function(){

$.ajax({
            url:"/site/dynamicDropdown",
            type:"GET",
            data:{"val":$(this).val(),"dropdownId":"1002"},
            success:function(data){
            	$("#Clistings_c_listing_town_c").html(data);
				},
				failure:function(data){
					console.log ("FAILURE");
					console.log(data);
				}
})

});

    var TotalExpensesSections = [ "Occupancy Expenses", "Operating Expenses", "Payroll Expenses", "Miscellaneous Expenses" ];
    var AdjustmentsSections = [ "Add-Backs/Adjustments" ];

    function clearLocaleString (value)
    {
        return parseFloat(value.toString().replace(/\,/g, '')) || 0 ;
    }
    function input2LocaleString(selector, selector_value)
    {
        var selector_valueFormated = selector_value.toLocaleString("en");
        $(selector).val(selector_valueFormated);
    }
    function input2money(selector, selector_value)
    {
        var selector_value_number = parseFloat(selector_value.toString().replace(/\,/g, '')).toFixed(2);
        $(selector).attr("value", selector_value_number).maskMoney (x2.currencyInfo).maskMoney ('mask');
    }

    function updateFinancialsFields(goods_type)
    {
        /*
         percentage is filled with 33% => Cost of Goods Sold  = 33% from 1.000.000 (sales)

         Gross Profit = Gross Revenue - Cost of Goods Sold
         OR
         Gross Profit = Gross Revenue - Gross Revenue * Cost of Goods Sold Percentage

         Gross Revenue = Sales + Other income - Sales Tax
         Monthly Sales  = Sales / 12
         Monthly Revenue  = Gross Revenue / 12
         Other Income  = Other Income / 12
         Monthly Profit  = Gross Profit / 12
         */

        //goods_type is percentage or number
        goods_number = $("#Clistings_c_financial_cgstotal_c").val();
        goods_number_value = clearLocaleString(goods_number);

        goods_percentage = $("#Clistings_c_financial_cgs_c").val();
        if (goods_percentage == '')
        {
            goods_percentage = 0;
        }

        sales_input = $("#Clistings_c_financial_sales_c").val();
        sales_value = clearLocaleString(sales_input);

        other_income_input = $("#Clistings_c_otherincome").val();
        other_income_value = clearLocaleString(other_income_input);

        sales_tax_input = $("#Clistings_c_lesssalestax").val();
        sales_tax_value = clearLocaleString(sales_tax_input);

        gross_revenue_value = parseFloat(sales_value) + parseFloat(other_income_value) - parseFloat(sales_tax_value);
        $("#Clistings_c_financial_grossrevenue_c").val(gross_revenue_value);

        monthly_sales_value = sales_value / 12;
        input2LocaleString("#Clistings_c_financial_monthly_sales_c", monthly_sales_value);

        monthly_revenue_value = gross_revenue_value / 12;
        input2LocaleString("#Clistings_c_financial_monthly_revenue_c", monthly_revenue_value);

        other_income_financial_value = other_income_value / 12;
        input2LocaleString("#Clistings_c_financial_other_income_c", other_income_financial_value);

        if (goods_type == 'percentage')
        {
            gross_profit_value =  gross_revenue_value - (gross_revenue_value * goods_percentage/100);
            //we need to calculate Cost of Goods Sold;
            goods_number_value = ( goods_percentage * gross_revenue_value ) / 100;
            input2LocaleString("#Clistings_c_financial_cgstotal_c", goods_number_value);
        }
        else
        {
            gross_profit_value =  gross_revenue_value - goods_number_value;
            //we need to calculate Cost of Goods Sold Percentage;
            goods_percentage_value = parseFloat((goods_number_value * 100) / gross_revenue_value) || 0;
            input2LocaleString("#Clistings_c_financial_cgs_c", goods_percentage_value);
        }
        input2LocaleString("#Clistings_c_financial_grossprofit_c", gross_profit_value);

        monthly_profit_value = gross_profit_value / 12;
        input2LocaleString("#Clistings_c_financial_monthly_profit_c", monthly_profit_value);

    }


    function calculateTotals ()
    {

        var totalExpenses = 0;
        $('.formSection').each (function ()
        {
            //check if is the right section related to expenses
            expensesTitleSpan = $(this).find('.sectionTitle');
            expensesTitle = expensesTitleSpan.attr('title');
            if ($.inArray(expensesTitle, TotalExpensesSections) != -1)
            {
                // sum all the inputs values
                $('input', this).each(function(inputIndex) {
                    //remove all commas inside the input value eg:1,407,300 => 1407300
                    input_value = $(this).val();
                    if (input_value == '')
                    {
                        clean_value = 0;
                    }
                    else
                    {
                        clean_value = input_value.replace(/\,/g, '');
                    }
                    totalExpenses = parseFloat(totalExpenses) + parseFloat(clean_value);
                });
            }
        });

        return totalExpenses;
    }

    function calculateAdjustments()
    {

        var totalAdjustments = 0;
        $('.formSection').each (function ()
        {
            //check if is the right section related to expenses
            adjustmentTitleSpan = $(this).find('.sectionTitle');
            adjustmentTitle = adjustmentTitleSpan.attr('title');
            if ($.inArray(adjustmentTitle, AdjustmentsSections) != -1)
            {
                // sum all the inputs values
                $('input', this).each(function(inputIndex) {
                    //remove all commas inside the input value eg:1,407,300 => 1407300
                    input_value = $(this).val();
                    if (input_value == '')
                    {
                        clean_value = 0;
                    }
                    else
                    {
                        clean_value = input_value.replace(/\,/g, '');
                    }
                    totalAdjustments = parseFloat(totalAdjustments) + parseFloat(clean_value);
                });
            }
        });
        return totalAdjustments;
    }
    function updateAdjustmentsFields()
    {
        totalAdjustments = calculateAdjustments();

        netProfit = $("#Clistings_c_financial_net_profit_c").maskMoney('unmasked')[0];

        netProfitValue = 0;
        if (netProfit != '')
        {
            netProfitValue = netProfit;

        }
        //Clistings_c_ownerscashflow = Clistings_c_financial_net_profit_c + All the fields from Add-Backs/Adjustments
        ownersCashFlow = parseFloat(netProfitValue) + parseFloat(totalAdjustments);
        input2money("#Clistings_c_ownerscashflow",ownersCashFlow );

        monthlyOwnersCashFlow = parseFloat(ownersCashFlow / 12);
        input2money("#Clistings_c_monthly_ownerscashflow",monthlyOwnersCashFlow );

    }

    function updateTotalsFields()
    {

        //calculate and update totals inputs
        totalExpensesValue = calculateTotals ();
        input2money("#Clistings_c_financial_total_expenses_c",totalExpensesValue );

        //monthly expenses: Clistings_c_financial_monthly_expense_c = 1/12 * totalExpensesValue
        monthlyExpensesValue =  1/12 * parseFloat(totalExpensesValue);
        input2money("#Clistings_c_financial_monthly_expense_c",monthlyExpensesValue );

        //netProfit: Clistings_c_financial_net_profit_c = Clistings_c_financial_grossprofit_c - totalExpensesValue
        grossProfit = $("#Clistings_c_financial_grossprofit_c").val();
        grossProfitValue = clearLocaleString(grossProfit);

        netProfitValue = parseFloat(grossProfitValue) - parseFloat(totalExpensesValue);
        input2money("#Clistings_c_financial_net_profit_c",netProfitValue );

        //monthlyProfit: Clistings_c_monthlyProfit = 1/12 * Clistings_c_financial_net_profit_c
        monthlyProfitValue =  1/12 * netProfitValue;
        input2money("#Clistings_c_monthlyProfit",monthlyProfitValue );

        //update Owners Cash Flow as well
        updateAdjustmentsFields();
    }



    //make currency format for several fields
    input2money("#Clistings_c_financial_total_expenses_c", $("#Clistings_c_financial_total_expenses_c").val());
    input2money("#Clistings_c_financial_monthly_expense_c", $("#Clistings_c_financial_monthly_expense_c").val());
    input2money("#Clistings_c_financial_net_profit_c", $("#Clistings_c_financial_net_profit_c").val());
    input2money("#Clistings_c_monthlyProfit", $("#Clistings_c_monthlyProfit").val());

    input2money("#Clistings_c_monthly_ownerscashflow", $("#Clistings_c_monthly_ownerscashflow").val());
    input2money("#Clistings_c_ownerscashflow", $("#Clistings_c_ownerscashflow").val());

    //some fields need to be just readonly:
    $('#Clistings_c_financial_grossrevenue_c').prop('readonly', true);
    $('#Clistings_c_financial_grossprofit_c').prop('readonly', true);
    $('#Clistings_c_financial_monthly_sales_c').prop('readonly', true);
    $('#Clistings_c_financial_monthly_revenue_c').prop('readonly', true);
    $('#Clistings_c_financial_other_income_c').prop('readonly', true);
    $('#Clistings_c_financial_monthly_profit_c').prop('readonly', true);

    $('#Clistings_c_financial_total_expenses_c').prop('readonly', true);
    $('#Clistings_c_financial_monthly_expense_c').prop('readonly', true);
    $('#Clistings_c_financial_net_profit_c').prop('readonly', true);
    $('#Clistings_c_monthlyProfit').prop('readonly', true);

    $('#Clistings_c_ownerscashflow').prop('readonly', true);
    $('#Clistings_c_monthly_ownerscashflow').prop('readonly', true);


    $("#Clistings_c_financial_cgs_c, #Clistings_c_financial_cgstotal_c, #Clistings_c_financial_sales_c, #Clistings_c_otherincome, #Clistings_c_lesssalestax").on('change',function(){
        if ($(this).attr("id") == 'Clistings_c_financial_cgs_c')
        {
            updateFinancialsFields('percentage');
        }
        else {
            updateFinancialsFields();
        }

        updateTotalsFields();

    });

    // for each expenses input recalculate entire total
    $('.formSection').each (function ()
    {
        //check if is the right section related to expenses
        expensesTitleSpan = $(this).find('.sectionTitle');
        expensesTitle = expensesTitleSpan.attr('title');
        if ($.inArray(expensesTitle, TotalExpensesSections) != -1)
        {
            // sum all the inputs values
            $('input', this).on('change',function() {
                if ($(this).attr('id') == "Clistings_c_financial_officersalary_c")
                {
                    $("#Clistings_c_financial_officersalaries_c").val($(this).val());
                }
                updateTotalsFields();
            });
        }
    });

    // for each Adjustments input recalculate Owners Cash Flow
    $('.formSection').each (function ()
    {
        //check if is the right section related to expenses
        expensesTitleSpan = $(this).find('.sectionTitle');
        expensesTitle = expensesTitleSpan.attr('title');
        if ($.inArray(expensesTitle, AdjustmentsSections) != -1)
        {
            // sum all the inputs values
            $('input', this).on('change',function() {
                if ($(this).attr('id') == "Clistings_c_financial_officersalaries_c")
                {
                    $("#Clistings_c_financial_officersalary_c").val($(this).val());
                }
                updateAdjustmentsFields();
            });
        }
    });

    function prepare4Submit(selector)
    {
        $(selector).prop('readonly',false)
                    .val($(selector).maskMoney('unmasked')[0]);

    }

    $("#clistings-form").on('submit',function(e){

        //e.preventDefault();
        //unmask fields before submit in order to get the right value;
        prepare4Submit("#Clistings_c_financial_total_expenses_c");
        prepare4Submit("#Clistings_c_financial_net_profit_c");
        prepare4Submit("#Clistings_c_financial_monthly_expense_c");
        prepare4Submit("#Clistings_c_monthlyProfit");

        prepare4Submit("#Clistings_c_ownerscashflow");
        prepare4Submit("#Clistings_c_monthly_ownerscashflow");

       // return false;
        //$(this).submit();
    });


});
