<?php
//for initialize the database
//give a few records in advance using account of admin
require_once ("./controller/DBController.php");
require_once ("./model/Record.php");
require_once ("./model/User.php");

$db = new DBController();
$db->connect();

//https://www.flaticon.com/search?word=head

$user = new User('admin','admin','admin.jpg');

$id = $db->iniRegister($user);

$records = array();

$records[0] = new Record("Germany","Cologne","Koln-1.jpg",
       "A great spot for taking photos. I greatly recommend the landsacpe of Cologne at night. ",'5',$id);

$records[1] = new Record("Germany","Berlin","Berlin.jpg",
    "Berlin Wall is always a famous place for visitors. I have always seen this picture on the wall in books. Now I see it by my eyes in reality!",'5',$id);

$records[2] = new Record("Germany","Fussen","Fussen.jpg",
    "Neuschwanstein in Fussen is beautiful,and it looks like a building in the fairy tale. 
    The place is near Munich. If you are in Munich, please do not miss such a amazing spot.",'5',$id);

$records[3] = new Record("Germany","Hamburg","hamburg-oldchurch.jpg",
    "A very old church in Hamburg, which was burned to be gray and black.
    You can climb the church by elevator. If you are lucky enough, you may hear the bell ringing on the church.",'4',$id);

$records[4] = new Record("Germany","Hamburg","Hamburg_Concert_Hall.jpg",
    "Elbe Philharmonic Hall is special in design. The top of the building looks like sea wave.
    People are allowed to enter the hall by buying tickets. Small shops for souvenirs and eatings
    are in the building. The landscape of Hamburg is available on the top of the hall.",'4',$id);

$records[5] = new Record("Germany","Hamburg","Hamburg_virgin_dike.jpg",
    "This lake locates just near the city hall. There are many shops around. A good choice for sightseeing and shopping.
    When I was there, a marathon took place around the lake.",'5',$id);

$records[6] = new Record("Germany","Hamburg","hamburg-church.jpg",
    "Hamburg city hall is super beautiful and Free for visiting! You should visit city halls when 
    you are sightseeing in Europe. I really like this large building. The Faded walls have a mysterious atmosphere.",'5',$id);

$records[7] = new Record("Germany","Cologne","Koln_church.jpg",
    "I took this photo inside the Cologne Cathedral. This is the largest cathedral I visited in Germany.
    The cathedral is in black in the day, and sometimes in gray in camera at night. Loaction is near the center train station.
    I climb to the top of the cathedral. What a great experience!",'5',$id);

$records[8] = new Record("France","Paris","Louvre.jpg",
    "The Louvre is one of the largest art treasures. I visit it with my parents. I think the building itself
    is a masterpiece.",'5',$id);

$records[9] = new Record("France","Paris","Louvre-2.jpg",
    "The Louvre looks really charming in this photo. Paris is worth visiting. ;)",'5',$id);

$records[10] = new Record("Germany","Luebeck","Luebeck_eating.jpg",
    "A noodle bar in Luebeck near town center. One of the senior students introduced this place to me.
    But this restaurant opens only in the evening.",'4',$id);

$records[11] = new Record("Germany","Luebeck","Luebeck_market.jpg",
    "This is the Christmas market in Luebeck. It is in the square in the city center, which should be easy to find.
    I bought a lot of snacks there.",'4',$id);

$records[12] = new Record("Germany","Munich","Munich_climb.jpg",
    "I am climbing the Zugspitze! Cold but exciting. It is the highest place in Germany.
    A little bit dangerous. Unforgettable experience.",'5',$id);

$records[13] = new Record("France","Paris","Paris.jpg",
    "I love Eiffel Tower. No matter where and when you take photos, it is beautiful.
    But be careful to the thieves in Paris.",'5',$id);

$records[14] = new Record("Switzerland","Lucerne","Rigi.jpg",
    "Every where is snow. Switzerland is worth visiting in winter and Christmas. But it is expensive and cold.",'4',$id);

$records[15] = new Record("Germany","Rugen","Rugen.jpg",
    "A small island in the most north of Germany. One-day or two-day trip is suitable with families. 
    ",'5',$id);

$records[16] = new Record("China","Shanghai","Shanghai.jpg",
    "Landscape at night in Shanghai is always beautiful. Many people are still working, so as me. What a sad story. :(
    ",'4',$id);

$records[17] = new Record("Germany","Munich","Zugspitze.jpg",
    "If you want to see snow and mountains, here is the best choice. Gondola and ski are all available. 
    ",'5',$id);

$records[18] = new Record("Switzerland","Zurich","Zurich-2.jpg",
    "Bad weather, but good city. Zurich is the biggest city in Switzerland. I am here!
    ",'4',$id);

$records[19] = new Record("Switzerland","Zurich","Zurich.jpg",
    "Christmas in Switzerland is colder. I am looking forward for the snow!
    ",'5',$id);


for($i=0;$i<count($records);$i++){
    $db->iniCreateRecord($records[$i]);
}

$db->disconnect();
?>