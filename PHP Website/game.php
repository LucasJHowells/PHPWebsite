<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pgame, $preview, $pconsumer, $pcurrpage)
{
    // Get game overview i.e. game facts and image
    $tgameprofile = "";
    foreach ($pgame as $tp) {
        $tgameprofile .= renderGameOverview($tp);
    }
    // Get internal review and external review including images
    $treviewprofile = "";
    foreach ($preview as $tp) {
        $treviewprofile .= renderReviewOverview($tp);
    }
    // Get consumer information
    $tconsumerprofile = "";
    foreach ($pconsumer as $tp) {
        $tconsumerprofile .= renderConsumerOverview($tp);
    }

    // Get the Presentation Layer content (User Reviews)
    $treview = new BLLUserReview();
    $treview->reviewlist = jsonLoadAllUserReviews();

    // The pagination working out how many elements we need and
    $tnoitems = sizeof($treview->reviewlist);
    $tperpage = 5;
    $tnopages = ceil($tnoitems / $tperpage);

    // Create a Pagniated Array based on the number of items and what page we want.
    $tfiltergame = appPaginateArray($treview->reviewlist, $pcurrpage, $tperpage);
    $treview->reviewlist = $tfiltergame;

    // Render the HTML for our Table and our Pagination Controls
    $tgametable = renderUserReviewTable($treview);
    $tpagination = renderPagination($_SERVER['PHP_SELF'], $tnopages, $pcurrpage);

    $tcontent = <<<PAGE
            <ul class="breadcrumb">
    			<li><a href="index.php">Rankings</a></li>
    			<li class="active">Game</li>
    		</ul>
          {$tgameprofile}
          {$tconsumerprofile}
          {$treviewprofile}
          <div id="game-table">
    			    {$tgametable}
                    {$tpagination}
          </div>
    PAGE;
    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();

$tgames = [];
$treviews = [];
$tconsumers = [];
$tname = $_REQUEST["name"] ?? "";
$tid = $_REQUEST["id"] ?? - 1;
$tcurrpage = $_REQUEST["page"] ?? 1;
$tcurrpage = is_numeric($tcurrpage) ? $tcurrpage : 1;

// Handle our Requests and Search for Players using different methods
if (is_numeric($tid) && $tid > 0) {
    $tgame = jsonLoadOneGame($tid);
    $treview = jsonLoadOneReview($tid);
    $tconsumer = jsonLoadOneConsumer($tid);
    $tgames[] = $tgame;
    $treviews[] = $treview;
    $tconsumers[] = $tconsumer;
} else if (! empty($tname)) {
    // Filter the namee
    $tname = appFormProcessData($tname);
    $tgamelist = jsonLoadAllGame();
    foreach ($tgamelist as $tp) {
        if (strtolower($tp->name) === strtolower($tname)) {
            $tgames[] = $tp;
        }
    }
}

// Page Decision Logic - Have we found a game?
// Doesn't matter the route of finding them
if (count($tgames) === 0) {
    appGoToError();
} else {
    // We've found our game
    $tpagecontent = createPage($tgames, $treviews, $tconsumers, $tcurrpage);
    $tpagetitle = "Game Page";

    // ----BUILD OUR HTML PAGE----------------------------
    // Create an instance of our Page class
    $tpage = new MasterPage($tpagetitle);
    $tpage->setDynamic2($tpagecontent);
    $tpage->renderPage();
}
?>