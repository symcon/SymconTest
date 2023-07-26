<?php

declare(strict_types=1);

include_once __DIR__ . '/stubs/autoload.php';
include_once __DIR__ . '/stubs/Validator.php';

class ModuleStrictValidationTest extends TestCaseSymconValidation
{
    public function testValidateStrictTest(): void
    {
        $this->validateModule(__DIR__ . '/../StrictTest');

        IPS\Kernel::reset();
        IPS\ModuleLoader::loadLibrary(__DIR__ . '/../library.json');

        $instanceID = IPS_CreateInstance('{0ED69498-2B43-808A-1AED-D53E1A9EB217}');
        
        $this->assertFalse(STS_ActiveParentCheck($instanceID));
        $this->assertTrue(STS_RegisterNewVariable($instanceID));
        $this->assertFalse(STS_RegisterNewVariable($instanceID));
        
    }
}