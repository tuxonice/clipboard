<?xml version="1.0" encoding="UTF-8"?>
<root>
<?php 
foreach($storedValue as $key=>$value){
    echo("<$key>".htmlentities($value)."</$key>"); 
} ?>
</root>
