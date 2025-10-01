<?php

declare(strict_types=1);

include_once __DIR__ . '/stubs/autoload.php';
include_once __DIR__ . '/stubs/Validator.php';
include_once __DIR__ . '/stubs/GlobalStubs.php';
include_once __DIR__ . '/stubs/KernelStubs.php';
include_once __DIR__ . '/stubs/ModuleStubs.php';

use PHPUnit\Framework\TestCase;

class StubUpdateTest extends TestCase
{
    protected $TileVisuID;
    protected $ArchiveID;

    public function testValidateStubUpdateTest(): void
    {

        IPS\Kernel::reset();

        //Register our core stubs for testing
        IPS\ModuleLoader::loadLibrary(__DIR__ . '/stubs/CoreStubs/library.json');

        $library = json_decode(file_get_contents(__DIR__ . '/../library.json'), true);
        IPS\ModuleLoader::loadSingleModule(__DIR__ . '/../StubsUpdateTest', $library['id']);

        $instanceID = IPS_CreateInstance('{79A1B1D8-6D89-1FFD-D840-BF6D6AF1A174}');
        $interface = IPS\InstanceManager::getInstanceInterface($instanceID);

        $interface->StrictFunctions();
        
        $this->assertTrue(true);
    }

    public function testArchiveStubs(): void
    {
        IPS\Kernel::reset();

        //Register or core stubs for testing
        IPS\ModuleLoader::loadLibrary(__DIR__ . '/stubs/CoreStubs/library.json');
        $archiveID = IPS_CreateInstance('{43192F0B-135B-4CE7-A0A7-1475603F3060}');

        // Testing new archive functions
        $variableID = IPS_CreateVariable(VARIABLETYPE_INTEGER);
        $this->assertFalse(AC_GetCounterIgnoreZeros($archiveID, $variableID));
        AC_SetCounterIgnoreZeros($archiveID, $variableID, true);
        $this->assertTrue(AC_GetCounterIgnoreZeros($archiveID, $variableID));
        
        $this->assertFalse(AC_GetGraphStatus($archiveID, $variableID));
        AC_SetGraphStatus($archiveID, $variableID, true);
        $this->assertTrue(AC_GetGraphStatus($archiveID, $variableID));
    }

    public function testTileVisuStubs(): void
    {
        IPS\Kernel::reset();

        //Register our core stubs for testing
        IPS\ModuleLoader::loadLibrary(__DIR__ . '/stubs/CoreStubs/library.json');

        $TileVisuID = IPS_CreateInstance('{B5B875BB-9B76-45FD-4E67-2607E45B3AC4}');

        VISU_OpenObject($TileVisuID, 12345, '');
        $this->assertEquals(VISU_PostNotification($TileVisuID, 'Title', 'Text', 'Info', 12345), 1);
        $this->assertEquals(VISU_PostNotificationEx($TileVisuID, 'Title', 'Text', 'heart', 'bell', 12345), 2);

        $this->assertTrue(true);
    }



    public function testWebFrontStubs(): void
    {
        IPS\Kernel::reset();

        //Register our core stubs for testing
        IPS\ModuleLoader::loadLibrary(__DIR__ . '/stubs/CoreStubs/library.json');

        $WebFrontID = IPS_CreateInstance('{3565B1F2-8F7B-4311-A4B6-1BF1D868F39E}');

        WFC_AudioNotification($WebFrontID, 'Title', 12345);
        WFC_OpenCategory($WebFrontID, 12345);
        WFC_PushNotification($WebFrontID, 'Title', 'Text', 'Sound', 12345);
        WFC_Reload($WebFrontID);
        WFC_SendNotification($WebFrontID, 'Title', 'Text', 'Icon', 15);
        WFC_SendPopup($WebFrontID, 'Title', 'Text');
        WFC_SwitchPage($WebFrontID, 'PageName');

        $this->assertTrue(true);
    }

    public function testTemplateStubs(): void
    {

        IPS\Kernel::reset();

        //Register our core stubs for testing
        IPS\ModuleLoader::loadLibrary(__DIR__ . '/stubs/CoreStubs/library.json');

        // Testing the new template implementation
        $templateID = IPS_CreateTemplate(VARIABLE_PRESENTATION_SLIDER);
        $deleteTemplate = IPS_CreateTemplate(VARIABLE_PRESENTATION_SWITCH);
        $this->assertEquals(count(IPS_GetTemplateList()), 2);
        $this->assertEquals(count(IPS_GetTemplateListByPresentation(VARIABLE_PRESENTATION_SLIDER)), 1);
        $this->assertEquals(count(IPS_GetTemplateListByPresentation(VARIABLE_PRESENTATION_SWITCH)), 1);
        // Set values
        IPS_SetTemplateName($templateID, 'TestTemplate');
        IPS_SetTemplateValues($templateID, ['MIN' => 0, 'MAX' => 10]);

        // Check values
        $template = IPS_GetTemplate($templateID);
        $this->assertEquals($template['Name'], 'TestTemplate');
        $this->assertEquals($template['PresentationID'], VARIABLE_PRESENTATION_SLIDER);
        $this->assertEquals(count($template['Values']), 2);
        $this->assertEquals($template['Values']['MAX'], 10);

        // Delete template and confirm
        IPS_DeleteTemplate($deleteTemplate);
        $this->assertEquals(count(IPS_GetTemplateList()), 1);
        $this->assertFalse(IPS_TemplateExists($deleteTemplate));
        $this->assertTrue(IPS_TemplateExists($templateID));

        $this->assertFalse(IPS_PresentationExists(VARIABLE_PRESENTATION_SLIDER));
    }

}
