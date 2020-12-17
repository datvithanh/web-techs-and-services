<?xml version="1.0"?>
<sins>
    <sin>pride</sin>
    <sin>envy</sin>
    <sin>anger</sin> 
    <sin>greed</sin>
    <sin>sloth</sin> 
    <sin>gluttony</sin> 
    <sin>lust</sin>
</sins>

<?php
// set name of XML file
    $file = "sins.xml"; 
    // load file
    $xml = simplexml_load_file($file) or die ("Unable to load XML file!");
    // iterate over <sin> element collection 
    foreach ($xml->sin as $sin) {
        echo "$sin\n"; 
    }
?>