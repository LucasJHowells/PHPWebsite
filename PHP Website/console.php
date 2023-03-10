<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage()
{
    // Get the Data we need for this page
    $tconsole = jsonLoadOneConsole(1);

    // Build the UI Component
    $tconsolehtml = renderConsoleSummary($tconsole);

    // Construct the Page
    $tcontent = <<<PAGE
    <ul class="breadcrumb">
    			<li><a href="index.php">Home</a></li>
    			<li class="active">Console</li>
    </ul>
    <section class="row details" id="Console-Summary">
        </section>
        <div class="panel">
          <div class="panel-heading">
             <h3 class="panel-title">Console Information</h3>
          </div>
          <div class="panel-body">
            {$tconsolehtml}
           </div>
        </div>
    </section>
    PAGE;

    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();

// Build up our Dynamic Content Items.
$tpagetitle = "Console Information";
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