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

/* @edition:pro */

Yii::import ('application.modules.contacts.models.*');
Yii::import ('application.components.*');
Yii::import ('application.components.x2flow.*');
Yii::import ('application.components.x2flow.triggers.*');
Yii::import ('application.components.permissions.*');

/**
 * @package application.tests.unit.components.x2flow.triggers
 */
class NewsletterEmailClickTest extends X2FlowTestBase {

    public $fixtures = array (
        'x2flow' => array ('X2Flow', '_1'),
        'contacts' => array ('Contacts', '_2'),
        'x2ListItem' => 'X2ListItem',
        'x2Lists' => 'X2List',
        'campaigns' => 'Campaign',
    );

    /**
     * Trigger config contains leadSource = 'Google' condition
     */
    public function testCheckConditions () {
        $listItem = X2ListItem::model()
            ->findByAttributes ($this->x2ListItem['newsletterCampaignEntry']);
        $params = array (
            'item' => $listItem,
            'email' => $listItem->emailAddress,
            'campaign' => $listItem->list->campaign->name,
            'url' => 'test url'
        );

        $retVal = $this->executeFlow (
            X2Flow::model ()->findByAttributes ($this->x2flow['flow5']), $params);

        // assert flow executed without errors
        $this->assertTrue ($this->checkTrace ($retVal['trace']));
    }

}

?>
