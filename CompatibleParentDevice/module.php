<?php

class CompatibleParentDevice extends IPSModule
{
    public function Create(): void
    {
        parent::Create();
    }

    public function GetCompatibleParents(): string
    {
        return json_encode([
            'moduleIDs' => [
                '{A6D2F2E1-4B14-4C9E-8C2D-1D6D25A1F101}'
            ],
            'type' => 'connect'
        ]);
    }
}
