<?php
include_once 'vtlib/Vtiger/Module.php';
$moduleInstance = Vtiger_Module::getInstance('ExtensionStore');
if ($moduleInstance) $moduleInstance->deleteLink('HEADERSCRIPT', 'ExtensionStoreCommonHeaderScript');
echo "OK, ads banner removed !";