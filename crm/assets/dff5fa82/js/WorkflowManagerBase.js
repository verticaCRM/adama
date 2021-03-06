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

if (typeof x2 === 'undefined') x2 = {};

x2.WorkflowManagerBase = (function () {

function WorkflowManagerBase (argsDict) {
    argsDict = typeof argsDict === 'undefined' ? {} : argsDict;
    var defaultArgs = {
        translations: [],
        getStageDetailsUrl: '',
        startStageUrl: '',
        completeStageUrl: '',
        revertStageUrl: ''
    };
    auxlib.applyArgs (this, defaultArgs, argsDict);

    $(function () {
        $.fn.extend({loading:function(){
            $(this).html("<img src=\""+yii.themeBaseUrl+"/images/loading.gif\" class=\"loading\">");
        }});
    });
}


/*
Public static methods
*/

/*
Private static methods
*/

/*
Public instance methods
*/

WorkflowManagerBase.prototype._afterSaveStageDetails = function (response, modelId, modelName) {};
WorkflowManagerBase.prototype._beforeSaveStageDetails = function (
    form, modelId, modelName, stageNumber) {

    return true;
};
        
WorkflowManagerBase.prototype.saveWorkflowStageDetails = function (
    modelId, modelName, stageNumber) {

    if (!this._beforeSaveStageDetails (
        $('#workflowDetailsForm'), modelId, modelName, stageNumber)) {

        return false;
    }

    var that = this;
    $.ajax({
        url: $("#workflowDetailsForm").attr("action"),
        type: "POST",
        data: $("#workflowDetailsForm").serialize(),
        beforeSend: function() { $("#workflowStageDetails").loading(); },
        success: function(response) {
            $("#workflowStageDetails").dialog("close");
            x2.Notifs.updateHistory();
            that._afterSaveStageDetails (response, modelId, modelName, stageNumber);
        }
    });

    return true;
};

WorkflowManagerBase.prototype._getStageDetailsTitle = function (stageNumber) {
    var that = this;
    var dialogTitle = that.translations['Stage {n}'].replace(
        "{n}",stageNumber);

    var stageLabels = $("#workflow-diagram .workflow-funnel-stage b");
    if(stageLabels.length >= stageNumber)
        dialogTitle += ": "+$(stageLabels[stageNumber-1]).html();

    return dialogTitle;
};

WorkflowManagerBase.prototype.workflowStageDetails = function (
    workflowId,stageNumber,modelName,modelId) {

    var modelName = typeof modelName === 'undefined' ? this.modelName : modelName; 
    var modelId = typeof modelId === 'undefined' ? this.modelId : modelId; 


    var that = this;

    var dialogTitle = this._getStageDetailsTitle (stageNumber, modelName, modelId);
    var dialogBox = $("#workflowStageDetails");

    dialogBox.dialog("option","title",dialogTitle);
    
    dialogBox.removeClass("editMode");

    $("#workflowDetails_createDate, #workflowDetails_startDate").datepicker("destroy");
    dialogBox.parent().find(".ui-dialog-buttonpane button:nth-child(1)").hide(); // save
    dialogBox.parent().find(".ui-dialog-buttonpane button:nth-child(2)").hide(); // edit
    dialogBox.parent().find(".ui-dialog-buttonpane button:nth-child(3)").hide(); // cancel
    dialogBox.data ('modelId', modelId);
    dialogBox.data ('modelName', modelName);
    dialogBox.data ('stageNumber', stageNumber);
    
    dialogBox.dialog("open");
    
    dialogBox.loading();
    
    $.ajax({
        url: that.getStageDetailsUrl,
        type: "GET",
        data: "workflowId="+workflowId+"&stage="+stageNumber+"&modelId=" +
            modelId + '&type=' + modelName,
        success: function(response) {
            if(response=="") return;
            $("#workflowStageDetails").html(response);
            
            // remove the edit button if theres no form
            if($("#workflowStageDetails #workflowDetailsForm").length)    
                dialogBox.parent().find(".ui-dialog-buttonpane button:nth-child(2)").show();
            else
                dialogBox.parent().find(".ui-dialog-buttonpane button:nth-child(2)").hide();
            
        }
    });
};

/*
Private instance methods
*/


WorkflowManagerBase.prototype._setUpStageDetailsDialog = function () {
    var that = this;
    $("#workflowStageDetails").dialog({
        autoOpen:false,
        closeOnEscape:true,
        resizable: false,
        modal: false,
        show: "fade",
        hide: "fade",
        width:400,
        buttons:[
            {
                text:that.translations['Save'], 
                click: function() { 
                    if (!that.saveWorkflowStageDetails(
                        $(this).data ('modelId'), $(this).data ('modelName'),
                        $(this).data ('stageNumber'))) {

                        $(this).dialog ('close');
                    }
                },
            },
            {
                text: that.translations['Edit'], 
                click: function() {
                    $(this).addClass("editMode");
                    
                    // save
                    $(this).parent().find(".ui-dialog-buttonpane button:nth-child(1)").show();    
                    // edit
                    $(this).parent().find(".ui-dialog-buttonpane button:nth-child(2)").hide();    
                    // cancel
                    $(this).parent().find(".ui-dialog-buttonpane button:nth-child(3)").show();    
                }, 
            },
            {
                text: that.translations['Cancel'],
                click: function() {
                    $(this).removeClass("editMode");

                    // save
                    $(this).parent().find(".ui-dialog-buttonpane button:nth-child(1)").hide();     
                    // edit
                    $(this).parent().find(".ui-dialog-buttonpane button:nth-child(2)").show();    
                    // cancel
                    $(this).parent().find(".ui-dialog-buttonpane button:nth-child(3)").hide();     
                },
            },
            {
                text: that.translations['Close'], 
                click: function() { 
                    $(this).dialog("close"); 
                }
            }
        ]
    });
};

return WorkflowManagerBase;

}) ();

