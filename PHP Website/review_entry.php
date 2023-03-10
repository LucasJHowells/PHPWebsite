<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createFormPage()
{
    $tmethod = appFormMethod();
    $taction = appFormActionSelf();
    $tcontent = <<<PAGE
        <form class="form-horizontal" method="{$tmethod}" action="{$taction}">
    	<fieldset>
    		<!-- Form Name -->
    		<legend>Enter a Review</legend>
    		<!-- Select Basic -->
    		<div class="form-group">
    			<label class="col-md-4 control-label" for="game">Game</label>
    			<div class="col-md-4">
    				<select id="game" name="game" class="form-control">
    					<option value="FIFA 20">FIFA 20</option>
    					<option value="FORZA HORIZON 4">FORZA HORIZON 4</option>
    					<option value="NBA 2K20">NBA 2K20</option>
    					<option value="MINECRAFT">MINECRAFT - XBOX ONE EDITION</option>
    					<option value="WWE 2K16">WWE 2K16</option>
    					<option value="STAR WARS: BATTLEFRONT II">STAR WARS: BATTLEFRONT II</option>
    					<option value="OVERWATCH">OVERWATCH</option>
                        <option value="ROCKET LEAGUE">ROCKET LEAGUE</option>
                        <option value="MADDEN NFL 25">MADDEN NFL 25</option>
                        <option value="TITANFALL">TITANFALL</option>
    				</select>
                    <span class="help-block">Select the Game</span>
    			</div>
    		</div>
    		<!-- Textarea -->
    		<div class="form-group">
    			<label class="col-md-4 control-label" for="score">Score</label>
    			<div class="col-md-4">
    				<textarea class="form-control" id="score" name="score"></textarea>
                    <span class="help-block">Enter a score for the game</span>
    			</div>
    		</div>
            <!-- Textarea -->
    		<div class="form-group">
    			<label class="col-md-4 control-label" for="userReview">Review</label>
    			<div class="col-md-4">
    				<textarea class="form-control" id="userReview" name="userReview"></textarea>
                    <span class="help-block">Enter a Review for the game</span>
    			</div>
    		</div>
    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="form-sub">Submit Form</label>
      <div class="col-md-4">
        <button id="form-sub" name="form-sub" type="submit" class="btn btn-danger">Add New Review</button>
      </div>
    </div>
    	</fieldset>
    </form>
    PAGE;
    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------

session_start();
$tpagecontent = "";

if (appFormMethodIsPost()) {
    // Capture the Bio Data
    // Map the Form Data
    $treview = new BLLReview();
    $treview->game = appFormProcessData($_REQUEST["game"] ?? "");
    $treview->score = appFormProcessData($_REQUEST["score"] ?? "");
    $treview->userReview = appFormProcessData($_REQUEST["userReview"] ?? "");
    $tvalid = true;
    // TODO: PUT SERVER-SIDE VALIDATION HERE
    if ($tvalid) {
        $tid = jsonNextReviewID();
        $treview->id = $tid;

        // Convert Review to JSON
        $tsavedata = json_encode($treview) . PHP_EOL;

        $tfilecontent = file_get_contents("data/json/userReview.json");
        $tfilecontent .= $tsavedata;

        file_put_contents("data/json/userReview.json", $tfilecontent);
        $tpagecontent = "<h1> Review with ID = {$treview->id} has been saved</h1>";
    } else {
        $tdest = appFormActionSelf();
        $tpagecontent = <<<ERROR
                                 <div class="well">
                                    <h1>Form was Invalid</h1>
                                    <a class="btn btn-warning" href="{$tdest}">Try Again</a>
                                 </div>
        ERROR;
    }
} else {
    // This page will be created by default.
    $tpagecontent = createFormPage();
}
$tpagetitle = "Review Entry Page";
$tpagelead = "";
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