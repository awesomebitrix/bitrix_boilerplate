<?php

use Bitrix\Main\Application;

define('CONSOLE_ENCODING', 'cp866');

$_SERVER["DOCUMENT_ROOT"] = __DIR__;
$_SERVER['PHP_SELF'] = '/index.php';

define('install_edition', 'start');
define("B_PROLOG_INCLUDED", true);
define("DEBUG_MODE", true);

ob_start();
$success = include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/install/wizard/wizard.php");
if (!$success)
    die('Folder /bitrix/ is inaccessible for writing and/or reading');
ob_end_clean();
unset($wizard);

require __DIR__ . '/install.inc.php';

$exceptionHandlerOutput = new ExceptionHandlerOutput();
Application::getInstance()->getExceptionHandler()->setHandlerOutput($exceptionHandlerOutput);

$wizard = new CWizardBase(str_replace("#VERS#", SM_VERSION, InstallGetMessage("INS_TITLE")), $package = null);
$arSteps = Array("CreateDBStep", "CreateModulesStep", "CreateAdminStep");
$wizard->AddSteps($arSteps); //Add steps
$wizard->SetTemplate(new WizardTemplate);
$wizard->SetReturnOutput();
//$content = $wizard->Display();

$vars = array(
    // Настойки базы данных для мастера установки
    'dbType' => 'mysql',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost', // port is optional
    'database' => 'www',
    'create_database' => 'Y',
    'create_user' => 'N',
    'create_database_type' => '', // empty or innodb
    'root_user' => '', // if create_database == 'Y'
    'root_password' => '', // if create_database == 'Y'
    'file_access_perms' => '0644',
    'folder_access_perms' => '0755',
    'utf8' => 'Y',

    // @todo Заполнить переменные остальных шагов
);

foreach ($vars as $name => $value)
{
    $wizard->SetVar($name, $value);
}

ob_start(function ($content) {
    return mb_convert_encoding($content, CONSOLE_ENCODING, INSTALL_CHARSET);
});

/** @var CWizardStep[] $steps */
$steps = $wizard->GetWizardSteps();
foreach ($steps as $stepName => $step)
{
    echo 'Running installer step ' . $stepName . "...\n";
    $step->OnPostForm();
    InstallWizardException::check($step);
}

ob_get_flush();
