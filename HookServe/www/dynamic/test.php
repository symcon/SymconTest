<?php

if(sizeof($_GET) > 0)
    var_dump($_GET);
elseif(sizeof($_POST) > 0)
    var_dump($_POST);
else
    echo "No Data";