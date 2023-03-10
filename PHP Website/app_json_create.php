<?php
require_once ("api/api.inc.php");

function jsonCreateNewsItemsFormat($pfile)
{
    $tni = new BLLNewsItem();
    $tni->id = 1;
    $tni->heading = "";
    $tni->img_href = "news-mainXX.jpg";
    $tni->thumb_href = "news-mainXX.jpg";
    $tni->item_href = "niXX.part.html";
    $tni->content = "";
    $tni->tagline = "";
    $tni->summary = "";
    $tdata = json_encode($tni) . PHP_EOL;
    file_put_contents($pfile, $tdata);
    return $tdata;
}

// ---------Create JSON Files---------------------------------------------
// UNCOMMENT TO CREATE A NEW FILE
// jsonCreateManagerFormat("data/json/managers1.json");
// jsonCreatePlayerFormat("data/json/players1.json");
// jsonCreateStadiumFormat("data/json/stadiums1.json");
// jsonCreateExecutivesFormat("data/json/executives1.json");
// jsonCreateKitsFormat("data/json/kits1.json");
// jsonCreateFixturesFormat("data/json/fixtures1.json");
// jsonCreateCoachesFormat("data/json/coaches1.json");
// jsonCreateClubsFormat("data/json/clubs1.json");
// jsonCreateNewsItemsFormat("data/json/newsitems1.json");

?>