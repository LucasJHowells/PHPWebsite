<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pimgdir, $pcurrpage)
{
    // Get the Presentation Layer content
    $trank = new BLLRank();
    $trank->gamelist = jsonLoadAllGames();

    // The pagination working out how many elements we need and
    $tnoitems = sizeof($trank->gamelist);
    $tperpage = 5;
    $tnopages = ceil($tnoitems / $tperpage);

    // Create a Pagniated Array based on the number of items and what page we want.
    $tfiltergame = appPaginateArray($trank->gamelist, $pcurrpage, $tperpage);
    $trank->gamelist = $tfiltergame;

    // Render the HTML for our Table and our Pagination Controls
    $tranktable = renderGameTable($trank);
    $tpagination = renderPagination($_SERVER['PHP_SELF'], $tnopages, $pcurrpage);

    $tcontent = <<<PAGE
    		<ul class="breadcrumb">
    			<li><a href="index.php">Home</a></li>
    			<li class="active">Rankings</li>
    		</ul>
    		<div class="row">
    			<div class="panel panel-primary">
    			<div class="panel-body">
    				<div id="rank-table">
    			    {$tranktable}
                    {$tpagination}
    		        </div>
    		    </div>
    			</div>
    		</div>
    PAGE;

    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();
$tcurrpage = $_REQUEST["page"] ?? 1;
$tcurrpage = is_numeric($tcurrpage) ? $tcurrpage : 1;

$tpagetitle = "Rankings";
$tpage = new MasterPage($tpagetitle);
$timgdir = $tpage->getPage()->getDirImages();

// Build up our Dynamic Content Items.
$tpagelead = "";
$tpagecontent = createPage($timgdir, $tcurrpage);
$tpagefooter = "";

// ----BUILD OUR HTML PAGE----------------------------
// Set the Three Dynamic Areas (1 and 3 have defaults)
if (! empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if (! empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
// Return the Dynamic Page to the user.
$tpage->renderPage();
?>