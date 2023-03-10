<?php
require_once ("oo_bll.inc.php");
require_once ("oo_pl.inc.php");

// ===========RENDER BUSINESS LOGIC OBJECTS=======================================================================

// ----------NEWS ITEM RENDERING------------------------------------------
function renderNewsItemAsList(BLLNewsItem $pitem)
{
    $titemsrc = ! empty($pitem->thumb_href) ? $pitem->thumb_href : "blank-thumb.jpg";
    $tnewsitem = <<<NI
    		    <section class="list-group-item clearfix">
    		        <div class="media-left media-top">
                        <img src="img/news/{$titemsrc}" width="100" />
                    </div>
                    <div class="media-body">
    				<h4 class="list-group-item-heading">{$pitem->heading}</h4>
    				<p class="list-group-item-text">{$pitem->tagline}</p>
    				<a class="btn btn-xs btn-default" href="news.php?storyid={$pitem->id}">Read...</a>
    				</div>
    			</section>
    NI;
    return $tnewsitem;
}

function renderNewsItemAsSummary(BLLNewsItem $pitem)
{
    $titemsrc = ! empty($pitem->thumb_href) ? $pitem->thumb_href : "blank-thumb.jpg";
    $tnewsitem = <<<NI
    		    <section class="row details clearfix">
    		    <div class="media-left media-top">
    				<img src="img/news/{$titemsrc}" width="256" />
    			</div>
    			<div class="media-body">
    				<h2>{$pitem->heading}</h2>
    				<div class="ni-summary">
    				<p>{$pitem->summary}</p>
    				</div>
    				<a class="btn btn-xs btn-default" href="news.php?storyid={$pitem->id}">Get the Full Story</a>
    	        </div>
    			</section>
    NI;
    return $tnewsitem;
}

function renderNewsItemFull(BLLNewsItem $pitem)
{
    $titemsrc = ! empty($pitem->img_href) ? $pitem->img_href : "blank-thumb.jpg";
    $tnewsitem = <<<NI
    		    <section class="row details">
    		        <div class="well">
    		        <div class="media-left">
    				    <img src="img/news/{$titemsrc}" />
    				</div>
    				<div class="media-body">
    				    <h1>{$pitem->heading}</h1>
    				    <p id="news-tag">{$pitem->tagline}</p>
    				    <p id="news-summ">{$pitem->summary}</p>
    				    <p id="news-main">{$pitem->content}</p>
    				</div>
    				</div>
    			</section>
    NI;
    return $tnewsitem;
}

// ----------RANK/GAME RENDERING---------------------------------------
function renderGameTable(BLLRank $prank)
{
    $trowdata = "";
    foreach ($prank->gamelist as $tp) {
        $trowdata .= <<<ROW
        <tr>
           <td>{$tp->id}</td>
           <td>{$tp->name}</td>
           <td>{$tp->platform}</td>
           <td>{$tp->genre}</td>
            <td>{$tp->ageRating}</td>
            <td>{$tp->score}</td>
           <td><a class="btn btn-info" href="game.php?id={$tp->id}">More...</a></td>
        </tr>
        ROW;
    }
    $ttable = <<<TABLE
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th id="sort-id">#</th>
    			<th id="sort-name">Game</th>
    			<th id="sort-platform">Platform</th>
    			<th id="sort-genre">Genre</th>
                <th id="sort-ageRating">Age Rating</th>
    			<th id="sort-score">Score</th>
    			<th> </th>
    		</tr>
    	</thead>
    	<tbody>
    	{$trowdata}
    	</tbody>
    </table>
    TABLE;
    return $ttable;
}

function renderUserReviewTable(BLLUserReview $puserreview)
{
    $trowdata = "";
    $passoc = "";
    foreach ($puserreview->reviewlist as $tp) {
        $trowdata .= <<<ROW
        <tr>
           <td>{$tp->score}</td>
            <td>{$tp->userReview}</td>
        </tr>
        ROW;
    }
    $ttable = <<<TABLE
    <h3>User Reviews</h3>
    <table class="table table-striped table-hover">
    	<thead>
    		<tr>
    			<th id="sort-score">Score</th>
    			<th id="sort-userReview">Review Description</th>
    			<th> </th>
    		</tr>
    	</thead>
    	<tbody>
    	{$trowdata}
    	</tbody>
    </table>
    TABLE;
    return $ttable;
}

function renderGameOverview(BLLGame $pp)
{
    $timgref = "img/game/{$pp->id}.jpg";
    $timg = $timgref;
    $toverview = <<<OV
        <article class="row marketing">
            <h2>Game Details</h2>
            <div class="media-left">
                <img src="$timg" width="256" />
            </div>
            <div class="media-body">
                <div class="well">
                    <h1>{$pp->name}</h1>
                </div>
                <h2>Genre: {$pp->genre}</h2>
                <h4>Creator: {$pp->creator}</h4>
                <h4>Age Rating: {$pp->ageRating}</h4>
                <h4>Recomendation Score: {$pp->score}</h4>
                <h4>Release Date: {$pp->release}</h4>
                <h4>Platform: {$pp->platform}</h4>
                <p>{$pp->description}</p>
            </div>
        </article>
    OV;
    return $toverview;
}

function renderReviewOverview(BLLReview $pp)
{
    $toverview = <<<OV
        <article class="row marketing">
            <div class="media-body">
                <h4>Interal Review</h4>
                <p>{$pp->review}</p>
                <h4>External Review</h4>
                <a class="btn btn-xs btn-default" href="{$pp->link1}">Metacritic Review</a>
                <a class="btn btn-xs btn-default" href="{$pp->link2}">Gamespot Review</a>
                <a class="btn btn-xs btn-default" href="{$pp->link3}">IGN Review</a>
            </div>
        </article>
    OV;
    return $toverview;
}

function renderConsumerOverview(BLLConsumer $pp)
{
    $toverview = <<<OV
        <article class="row marketing">
            <div class="media-body">
                <h4>Consumer Information</h4>
                <h4>Price: {$pp->price}</h4>
                <a class="btn btn-xs btn-default" href="{$pp->link1}">Game</a>
                <a class="btn btn-xs btn-default" href="{$pp->link2}">Amazon</a>
                <a class="btn btn-xs btn-default" href="{$pp->link3}">CEX</a>
            </div>
        </article>
    OV;
    return $toverview;
}

function renderUserReviewOverview(BLLUserReview $pp)
{
    $toverview = <<<OV
        <article class="row marketing">
            <div class="media-body">
                <h4>User Review</h4>
                <p>{$pp->userReview}</p>
            </div>
        </article>
    OV;
    return $toverview;
}

// ----------CONSOLE RENDERING--------------------------------------------
function renderConsoleSummary(BLLConsole $ps)
{
    $tshtml = <<<OVERVIEW
        <div class="well">
                <ul class="list-group">
                    <li class="list-group-item">
                        Console: <strong>{$ps->name}</strong>
                    </li>
                    <li class="list-group-item">
                        Description: <strong>{$ps->description}</strong>
                    </li>
                    <li class="list-group-item">
                        Capacity: <strong>{$ps->capacity}</strong>
                    </li>
                    <li class="list-group-item">
                        <img src={$ps->imgsrc}></img>
                    </li>
                    <li class="list-group-item">
                        Release: <strong>{$ps->release}</strong>
                    </li>
                    <li class="list-group-item">
                        Release: <strong>{$ps->history}</strong>
                    </li>
                    <br>
                    <a class="btn btn-xs btn-default" href="{$ps->newssrc}">News Related To XBOX...</a>
                </ul>
        </div>
    OVERVIEW;
    return $tshtml;
}

// =============RENDER PRESENTATION LOGIC OBJECTS==================================================================
function renderUICarousel(array $pimgs, $pimgdir, $pid = "mycarousel")
{
    $tci = "";
    $count = 0;

    // -------Build the Images---------------------------------------------------------
    foreach ($pimgs as $titem) {
        $tactive = $count === 0 ? " active" : "";
        $thtml = <<<ITEM
                <div class="item{$tactive}">
                    <img class="img-responsive" src="{$pimgdir}/{$titem->img_href}">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{$titem->title}</h1>
                            <p class="lead">{$titem->lead}</p>
        		        </div>
        			</div>
        	    </div>
        ITEM;
        $tci .= $thtml;
        $count ++;
    }

    // --Build Navigation-------------------------
    $tdot = "";
    $tdotset = "";
    $tarrows = "";

    if ($count > 1) {
        for ($i = 0; $i < count($pimgs); $i ++) {
            if ($i === 0)
                $tdot .= "<li data-target=\"#{$pid}\" data-slide-to=\"$i\" class=\"active\"></li>";
            else
                $tdot .= "<li data-target=\"#{$pid}\" data-slide-to=\"$i\"></li>";
        }
        $tdotset = <<<INDICATOR
                <ol class="carousel-indicators">
                {$tdot}
                </ol>
        INDICATOR;
    }
    if ($count > 1) {
        $tarrows = <<<ARROWS
        		<a class="left carousel-control" href="#{$pid}" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        		<a class="right carousel-control" href="#{$pid}" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
        ARROWS;
    }

    $tcarousel = <<<CAROUSEL
        <div class="carousel slide" id="{$pid}">
                {$tdotset}
    			<div class="carousel-inner">
    				{$tci}
    			</div>
    		    {$tarrows}
        </div>
    CAROUSEL;
    return $tcarousel;
}

function renderUITabs(array $ptabs, $ptabid)
{
    $count = 0;
    $ttabnav = "";
    $ttabcontent = "";

    foreach ($ptabs as $ttab) {
        $tnavactive = "";
        $ttabactive = "";
        if ($count === 0) {
            $tnavactive = " class=\"active\"";
            $ttabactive = " active in";
        }
        $ttabnav .= "<li{$tnavactive}><a href=\"#{$ttab->tabid}\" data-toggle=\"tab\">{$ttab->tabname}</a></li>";
        $ttabcontent .= "<article class=\"tab-pane fade{$ttabactive}\" id=\"{$ttab->tabid}\">{$ttab->content}</article>";
        $count ++;
    }

    $ttabhtml = <<<HTML
            <ul class="nav nav-tabs">
            {$ttabnav}
            </ul>
        	<div class="tab-content" id="{$ptabid}">
    			  {$ttabcontent}
    		</div>
    HTML;
    return $ttabhtml;
}

function renderPagination($ppage, $pno, $pcurr)
{
    if ($pno <= 1)
        return "";

    $titems = "";
    $tld = $pcurr == 1 ? " class=\"disabled\"" : "";
    $trd = $pcurr == $pno ? " class=\"disabled\"" : "";

    $tprev = $pcurr - 1;
    $tnext = $pcurr + 1;

    $titems .= "<li$tld><a href=\"{$ppage}?page={$tprev}\">&laquo;</a></li>";
    for ($i = 1; $i <= $pno; $i ++) {
        $ta = $pcurr == $i ? " class=\"active\"" : "";
        $titems .= "<li$ta><a href=\"{$ppage}?page={$i}\">{$i}</a></li>";
    }
    $titems .= "<li$trd><a href=\"${ppage}?page={$tnext}\">&raquo;</a></li>";

    $tmarkup = <<<NAV
        <ul class="pagination pagination-sm">
            {$titems}
        </ul>
    NAV;
    return $tmarkup;
}

function renderUIGoogleMap($plong, $plat)
{
    $tmaphtml = <<<MAP
        <iframe width="100%" height="100%"
                            frameborder="1" scrolling="no" marginheight="0"
                            marginwidth="0"
                            src="http://maps.google.com/maps?f=q&amp;
                            source=s_q&amp;hl=en&amp;
                            geocode=&amp;q={$plong},{$plat}
                            &amp;output=embed"></iframe>
    MAP;
    return $tmaphtml;
}

?>