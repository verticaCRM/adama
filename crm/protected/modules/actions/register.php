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


$install = implode(DIRECTORY_SEPARATOR, array(__DIR__, 'data', 'install.sql'));
$uninstall = implode(DIRECTORY_SEPARATOR, array(__DIR__, 'data', 'uninstall.sql'));
$installPro = implode(DIRECTORY_SEPARATOR, array(__DIR__, 'data', 'install-pro.sql'));
$uninstallPro = implode(DIRECTORY_SEPARATOR, array(__DIR__, 'data', 'uninstall-pro.sql'));

return array(
    'name'=>"Actions",
    'install'=>file_exists($installPro) ? array($install, $installPro) : array($install),
    'uninstall'=>file_exists($uninstallPro) ? array($uninstall, $uninstallPro) : array($uninstall),
    'editable'=>false,
    'searchable'=>true,
    'adminOnly'=>false,
    'custom'=>false,
    'toggleable'=>false,
    'version' => '2.0',
);
?>
