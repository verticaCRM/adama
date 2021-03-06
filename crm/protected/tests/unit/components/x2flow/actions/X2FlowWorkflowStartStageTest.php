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

/**
 * @package application.tests.unit.components.x2flow.actions
 */
class X2FlowWorkflowStartStageTest extends X2FlowTestBase {

    public $fixtures = array (
        'x2flow' => array ('X2Flow', '.X2FlowWorkflowStartStageTest'),
    );

    /**
     * Trigger flow with a model that doesn't support workflows. 
     */
    public function testInvalidModelType () {
        $params = array (
            'user' => 'admin'
        );
        $retVal = $this->executeFlow (
            X2Flow::model ()->findByAttributes ($this->x2flow['flow1']), $params);

        // assert flow executed with error indicating that model was invalid
        $this->assertFalse ($this->checkTrace ($retVal['trace']));

    }
}

?>
