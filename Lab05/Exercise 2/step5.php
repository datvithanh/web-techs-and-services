<?xml version="1.0"?> 
<ingredients> 
    <item>
        <desc>Boneless chicken breasts</desc>
        <quantity>2</quantity>
    </item> 
    <item> 
        <desc>Chopped onions</desc> 
        <quantity>2</quantity>
    </item>
    <item>
        <desc>Ginger</desc> 
        <quantity>1</quantity>
    </item>
    <item>
        <desc>Garlic</desc>
        <quantity>1</quantity> 
    </item> 
    <item> 
        <desc>Red chili powder</desc>
        <quantity>1</quantity>
    </item> 
    <item> 
        <desc>Coriander seeds</desc>
        <quantity>1</quantity>
    </item>
    <item> 
        <desc>Lime juice</desc> 
        <quantity>2</quantity>
    </item> 
</ingredients>

<?php
// set name of XML file 
    $file = "ingredients.xml";
    // load file
    $xml = simplexml_load_file($file) or die ("Unable to load XML file!"); 
    // get all the <desc> elements and print 
    foreach ($xml->xpath('//item[quantity > 1]/desc') as $desc) {
        echo "$desc\n";       
    } 
?>