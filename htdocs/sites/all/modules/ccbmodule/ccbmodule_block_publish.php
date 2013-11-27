<?php

# author: zaman
# implement strategy pattern to publish block

include_once('ccbmodule.model.php');

abstract class theme_block_strategy {

    abstract function theme_publish_block();
}

class theme_scrolling_news extends theme_block_strategy {

    function theme_publish_block() {
        $news = new CCB_Model();
        $news_data = $news->getScrollingNews();
        return theme('scrolling_news', null, $news_data);
    }

}

class theme_upcoming_matches extends theme_block_strategy {

    function theme_publish_block() {
        $up_matches = new CCB_Model();
        $up_match_data = $up_matches->getUpcomingMatches();
        $matches = array();
        while ($m = db_fetch_object($up_match_data)) {
            $matches[] = node_load($m->nid);
        }
//print_r($matches); exit;
        return theme('upcoming_matches', null, $matches);
    }

}

class theme_recent_match_result extends theme_block_strategy {

    function theme_publish_block() {
        $rows =array();
        $recent_matches = new CCB_Model();
        $recent_match_data = $recent_matches->getRecentMatchResult();
        while($row = db_fetch_object($recent_match_data)){
           $team_1 = node_load($row->field_match_team1_nid);
     
           $team_2 = node_load($row->field_match_team2_nid);
            $rows[] = array(
                 'nid' => $row->nid,
                'field_match_date_value' => $row->field_match_date_value,
                "field_match_team1" => $team_1->field_short_name[0]['value'],
                "field_match_team2" => $team_2->field_short_name[0]['value'],
            );
        }
        
        return theme('recent_match_result' , NULL, $rows);
    }

}

class theme_top_batsman extends theme_block_strategy {

    function theme_publish_block() {
        $objModel = new CCB_Model();
        $seasonId = $objModel->getLatestTournament();
        $top_batsman = $objModel->allPlayerBattingRecord(T20, $seasonId);
        $top_batsman = null;
        $info = new stdClass();
        $info->seasonId = $seasonId;
        return theme('top_batsman', NULL, $top_batsman, $info);
    }

}

class theme_top_bowler extends theme_block_strategy {

    function theme_publish_block() {
        $objModel = new CCB_Model();
        $seasonId = $objModel->getLatestTournament();
        $top_bowler = $objModel->allPlayerBowlingRecord(T20, $seasonId);
        $top_bowler = null;
        $info = new stdClass();
        $info->seasonId = $seasonId;
        return theme('top_bowler', NULL, $top_bowler, $info);
    }

}

class theme_recent_photo_gallery extends theme_block_strategy {

    function theme_publish_block() {
        $gal = new CCB_Model();
        $gallary = $gal->getLatestImage(5);
        return theme('recent_photo_gallery', null, $gallary);
    }

}

class publish_block {

    private $_strategy;
    static private $_instance;

    private function __construct() {
        $this->_strategy = array(
            "0" => new theme_scrolling_news(),
            "1" => new theme_upcoming_matches(),
            "2" => new theme_recent_match_result(),
            "3" => new theme_top_batsman(),
            "4" => new theme_top_bowler(),
            "5" => new theme_recent_photo_gallery(),
        );
    }

    public static function get_instance() {
        if (!self::$_instance) {
            self::$_instance = new publish_block();
        } return


        self::$_instance;
    }

    public function theme_publish_block($block_id) {
        return $this->_strategy[$block_id]->theme_publish_block();
    }

}

?>
