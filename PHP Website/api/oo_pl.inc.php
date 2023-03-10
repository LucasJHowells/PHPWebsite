<?php

// ///////////////////
// Class to represent
// a News Item
// ///////////////////
class PLGameItem
{

    // -------CLASS FIELDS------------------
    public $heading;

    public $summary;

    public $link;

    public $linktext;

    // -------CONSTRUCTORS------------------
    public function __construct($pheading = "Default Heading", $psummary = "Default Summary", $plink = "#", $plinktext = "More..")
    {
        $this->heading = $pheading;
        $this->summary = $psummary;
        $this->link = $plink;
        $this->linktext = $plinktext;
    }

    // -------METHODS-----------------------
    public function getHTML()
    {
        $tgameitem = <<<NI
        	    <section class="list-group-item">
        			<h4 class="list-group-item-heading">{$this->heading}</h4>
        			<p class="list-group-item-text">{$this->summary}</p>
        			<a class="btn btn-xs btn-default" href="{$this->link}">{$this->linktext}</a>
                    <br><br>
        		</section>
        NI;
        return $tgameitem;
    }
}

class PLNewsList
{

    public $gameitems = array();

    // Loads only 3 items
    public function __construct()
    {
        for ($i = 1; $i <= 3; $i ++) {
            $tgame = new BLLGame();
            $tgame->gamelist = jsonLoadOneGame($i);
            $this->gameitems[] = new PLGameItem($tgame->gamelist->name, $tgame->gamelist->description, "game.php?id={$tgame->gamelist->id}");
        }
    }
}
?>