<?
class SpaceModule extends IPSModule {

	public function GetConfigurationForm()
	{
		
		return '{ "actions": [ { "type": "Label", "label": "It works!" } ] }';
	
	}
	
	public function HelloWorld() {
		echo "Hello World!";
	}

}
?>