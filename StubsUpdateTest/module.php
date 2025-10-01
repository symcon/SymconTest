<?php

class StubsUpdateTest extends IPSModuleStrict
{
    public function StrictFunctions(): void
    {
        $this->SetVisualizationType(1 /*HTML*/);
        $this->UpdateVisualizationValue('Value');
    }
}
