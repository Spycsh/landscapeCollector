<?php
require ("RecordController.php");

$crc = new RecordController();

$crc->createRecord("Germany","Koeln","./image/Koln-1.jpg",
    "The church is amazing. This city is worth visiting","5");

$crc->createRecord("Germany","Luebeck","./image/Luebeck.jpg",
    "Christmas market in Luebeck is beautiful. There are many shops selling snacks and wein. ","5");

?>