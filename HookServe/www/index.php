<?php

echo "Dies ist ein Beispiel mit einer PHP-Datei! Die aktuelle Uhrzeit ist " . date("H:i");

?>

<br/><br/>
Weitere Beispiele:<br/>
<a href="jquery">JQuery Demo</a><br/>
<a href="dynamic/test.php?foo=bar">GET Demo</a><br/>
<form action="dynamic/test.php" method="post">
    <input type="hidden" name="foo" value="bar">
    <input type="submit" value="POST Demo">
</form>