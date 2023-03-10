<?php

class BLLNewsItem
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $heading;

    public $tagline;

    public $thumb_href;

    public $img_href;

    public $item_href;

    public $summary;

    public $content;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLRank
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $gamelist;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLGame
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $name;

    public $description;

    public $creator;

    public $release;

    public $platform;

    public $genre;

    public $ageRating;

    public $score;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLReview
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $game;

    public $score;

    public $userReview;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLConsumer
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $link1;

    public $link2;

    public $link3;

    public $price;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLUserReview
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $game;

    public $score;

    public $userReview;

    public $reviewlist;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLConsole
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $name;

    public $description;

    public $capacity;

    public $imgsrc;

    public $release;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

?>