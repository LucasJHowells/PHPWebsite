<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage()
{
    // Page-Specific Static Content
    $twelcome = file_get_contents("data/static/index_welcome.part.html");

    $tgamelist = new PLNewsList();
    $gamehtml = "";
    foreach ($tgamelist->gameitems as $tnitem) {
        $gamehtml .= $tnitem->getHTML();
    }

    $tcontent = <<<PAGE
            <div class="row">
                {$twelcome}
    		</div>
            <div class="row details">
                <h1>Welcome To Our Games Site</h1>
    		</div>
            <div class="list-group">
                    {$gamehtml}
    	    </div>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/0adBlAMsFX8" frameborder="0" allow="accelerometer; autoplay; encrypted-media;
            gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/0CrwDj5zcT4" frameborder="0" allow="accelerometer; autoplay; encrypted-media;
            gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
    PAGE;
    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();

// Build up our Dynamic Content Items.
$tpagetitle = "Home Page";
$tpagelead = "";
$tpagecontent = createPage();
$tpagefooter = "";

// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
// Set the Three Dynamic Areas (1 and 3 have defaults)
if (! empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if (! empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
// Return the Dynamic Page to the user.
$tpage->renderPage();
?>