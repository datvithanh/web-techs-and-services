<?xml version="1.0"?> 
<review id="57" category="2">
    <title>Moulin Rouge</title> 
    <teaser> Baz Luhrmann's over-the-top vision of Paris at the turn of the century is witty, sexy...and completely unforgettable </teaser>
    <cast>
        <person>Nicole Kidman</person>
        <person>Ewan McGregor</person> 
        <person>John Leguizamo</person>
        <person>Jim Broadbent</person> 
        <person>Richard Roxburgh</person>
    </cast> 
    <director>Baz Luhrmann</director>
    <duration>120</duration> 
    <genre>Romance/Comedy</genre>
    <year>2001</year>
    <body>
        A stylishly spectacular extravaganza, Moulin Rouge is hard to
        categorize; it is, at different times, a love story, a costume drama,
        a musical, and a comedy. Director Baz Luhrmann (well-known for the
        very hip William Shakespeare's Romeo + Juliet) has taken some simple
        themes - love, jealousy and obsession - and done something completely
        new and different with them by setting them to music.
    </body>
    <rating>5</rating>
</review>

<?php 
// set name of XML file
// normally this would come through GET
// it's hard-wired here for simplicity
    $file = "57.xml";
    // load file
    $xml = simplexml_load_file($file) or die ("Unable to load XML file!");
?> 
<html>
    <head><basefont face="Arial"></head>
    <body>
        <!-- title and year --> 
        <h1><?php echo $xml->title; ?> (<?php echo $xml->year; ?>)</h1> 
        <!-- slug -->
        <h3><?php echo $xml->teaser; ?></h3>
        <!-- review body --> 
            <?php echo $xml->body; ?>
        <!-- director, cast, duration and rating -->
        <p align="right"/>
        <font size="-2">
        Director: <b><?php echo $xml->director; ?></b>
        <br /> 
        Duration: <b><?php echo $xml->duration; ?> min</b>
        <br /> 
        Cast: <b><?php foreach ($xml->cast->person as $person) { echo "$person "; } ?></b>
        <br />
        Rating: <b><?php echo $xml->rating; ?></b> 
        </font>
    </body>
</html>