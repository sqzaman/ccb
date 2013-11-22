<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ccbmodulemodel
 *
 * @author Zaman
 */
include_once('ccbmodule.base.model.php');

class CCB_Model extends Base_Model {

//put your code here
    //const MATCH_TYPE = 'First Class'
    public function __construct() {
        
    }

    public function getScrollingNews() {
        $sql = sprintf("SELECT nid, title, vid FROM {node} WHERE type = '%s' AND status = 1 ORDER BY changed DESC LIMIT 0, 5 ", 'ccb_news');
        return $this->executeQuery($sql);
    }

    public function getUpcomingMatches() {
        $sql = sprintf("SELECT nid FROM {content_type_ccb_upcoming_match} WHERE field_date_value >  NOW() ORDER BY field_date_value ASC LIMIT 0, 5 ", 'ccb_news');
        return $this->executeQuery($sql);
    }

    public function getRecentMatchResult() {
        $sql = sprintf("SELECT nid, field_match_team1_nid, field_match_team2_nid, field_match_date_value FROM {content_type_ccb_match} ORDER BY field_match_date_value DESC LIMIT 0, 5 ");
        return $this->executeQuery($sql);
    }

    public function getTeamList() {
        $sql = sprintf("SELECT nid, title, vid FROM {node} WHERE type = '%s' AND status = 1 ORDER BY title ASC", 'ccb_teams');
        return $this->executeQuery($sql);
    }

    public function getyPlayerList($team_id) {
        $sql = sprintf("SELECT n.nid FROM {node} n INNER JOIN content_type_ccb_players p ON (n.nid = p.nid) 
            WHERE n.type = '%s' AND status = 1 AND p.field_players_club_nid =%d
            ORDER BY p.field_team_role_value DESC, field_players_nick_value ASC", 'ccb_players', $team_id);
        return $this->executeQuery($sql);
    }

    public function getPlayerCount($uid) {
        $sql = sprintf("SELECT COUNT(p.nid) FROM content_type_ccb_players p INNER JOIN content_type_ccb_teams t
            ON (p.field_players_club_nid = t.nid)
            WHERE t.field_login_name_uid =%d", $uid);
        return db_result($this->executeQuery($sql));
    }

    public function getTeamManagerId($nid) {
        $sql = sprintf("SELECT field_login_name_uid FROM content_type_ccb_players p LEFT JOIN content_type_ccb_teams t
            ON (p.field_players_club_nid = t.nid)
            WHERE p.nid =%d", $nid);
        return db_result($this->executeQuery($sql));
    }

    public function getTeamRole($nid, $rid) {
        $sql = sprintf("SELECT nid FROM content_type_ccb_players p WHERE p.field_players_club_nid =%d AND field_team_role_value=%d", $nid, $rid);
        return db_result($this->executeQuery($sql));
    }

    public function getTeamId($uid) {
        $sql = sprintf("SELECT t.nid FROM {content_type_ccb_teams} t WHERE t.field_login_name_uid = %d ", $uid);
        return db_result($this->executeQuery($sql));
    }

    public function getLatestImage($number = 5) {
        $sql = "SELECT nid FROM {node} WHERE type ='ccb_image_gallery' ORDER BY changed DESC LIMIT 0, $number ";
        $data = $this->executeQuery($sql);
        $nodes = array();
        while ($dat = db_fetch_object($data)) {
            $nodes[] = node_load($dat->nid);
        }
        return $nodes;
    }

    # get all player bowling statistics

    public function allPlayerBattingRecord($match_type) {
        $statistics = array();
        $sql = sprintf("SELECT n.nid, title, sn.field_short_name_value, p.field_players_nick_value 
            FROM node n 
            LEFT JOIN content_type_ccb_players p ON(p.nid=n.nid) 
            LEFT JOIN content_type_ccb_teams t ON(p.field_players_club_nid = t.nid)
            LEFT JOIN  content_field_short_name sn ON(t.nid = sn.nid)
            
            where type = '%s'", 'ccb_players');
        $result = $this->executeQuery($sql);

        while ($row = db_fetch_object($result)) {
            $array = $this->singlePlayerBattingRecord($row->nid, $match_type);
            if (isset($array)) {
                $array['nid'] = $row->nid;
                $array['name'] = $row->title;
                $array['nick_name'] = $row->field_players_nick_value;
                $array['team_name'] = $row->field_short_name_value;
                $statistics[$row->nid] = $array;
            }
        }

        $objSortArray = new Sort_Array();
        $objSortArray->setOrder("DESC");
        $objSortArray->setsortColumn("runs");
        usort($statistics, array($objSortArray, 'compare'));

        return $statistics;
    }

    # get all player bowling statistics

    public function allPlayerBowlingRecord($match_type) {
        $statistics = array();
        $sql = sprintf("SELECT n.nid, title, sn.field_short_name_value 
            FROM node n LEFT JOIN content_type_ccb_players p ON(p.nid=n.nid)
            LEFT JOIN content_type_ccb_teams t ON(p.field_players_club_nid = t.nid)
            LEFT JOIN  content_field_short_name sn ON(t.nid = sn.nid)
            where n.type = '%s'", 'ccb_players');
        $result = $this->executeQuery($sql);

        while ($row = db_fetch_object($result)) {
            $array = $this->singlePlayerBowlingRecord($row->nid, $match_type);
            if (isset($array)) {
                $array['nid'] = $row->nid;
                $array['name'] = $row->title;
                $array['team_name'] = $row->field_short_name_value;
                $statistics[$row->nid] = $array;
            }
        }

        $objSortArray = new Sort_Array();
        $objSortArray->setOrder("DESC");
        $objSortArray->setsortColumn("wkts");
        usort($statistics, array($objSortArray, 'compare'));

        //print_r($statistics); exit;
        return $statistics;
    }

    public function singlePlayerBowlingRecord($nid, $match_type) {

        $field = '';
        for ($i = 1; $i <= 11; $i++) {
            $field .= sprintf(" field_bowling_player%d_nid" . " = '%s' OR ", $i, $nid);
        }
        $field = substr($field, 0, strlen($field) - 3);

        $sql = sprintf("SELECT * FROM `content_type_ccb_bowling_card` bowls LEFT JOIN `content_type_ccb_match` cm ON(bowls.field_bowling_match_nid = cm.nid) WHERE cm.field_match_type_value = '%s' AND ($field)", $match_type);

        $bc = $this->executeQuery($sql);

        $player_id = $nid;
        $matches = $this->getTotalNumberMatchPlayed($nid, $match_type);
        $innings = 0;
        $overs = 0;
        $runs = 0;
        $wickets = 0;
        $no_balls = 0;
        $wide_balls = 0;
        $average = 0.0;
        $economy = 0.0;
        $strike_rate = 0.0;
        $four_wickets = 0;
        $five_wickets = 0;
        //echo $matches;
        $matched_player_info = array();


        while ($row = db_fetch_object($bc)) {
            $index = 0;
            //print_r($row);
            for ($i = 1; $i <= 11; $i++) {
                $field = sprintf("field_bowling_player%d_nid", $i);
                if ($row->$field == $nid) {
                    $index = $i;
                    break;
                }
            }
            $index_over = sprintf("field_bowling_over%d_value", $index);
            $index_run = sprintf("field_bowling_run%d_value", $index);
            $index_wicket = sprintf("field_bowling_wkts%d_value", $index);
            $index_no_balls = sprintf("field_bowling_no%d_value", $index);
            $index_wide = sprintf("field_bowling_wide%d_value", $index);

            $innings++;
            $overs += $row->$index_over;
            $runs += $row->$index_run;
            $wickets += $row->$index_wicket;
            $no_balls += $row->$index_no_balls;
            $wide_balls += $row->$index_wide;


            if ($row->$index_wicket == 4)
                $four_wickets++;

            if ($row->$index_wicket >= 5)
                $five_wickets++;
        }

        if ($wickets > 0) {
            $average = $runs / $wickets;
            $strike_rate = ($overs * 6) / $wickets;
        }

        if ($overs > 0)
            $economy = $runs / $overs;

        return array(
            'mat' => $matches,
            'inns' => $innings,
            'overs' => $overs,
            'runs' => $runs,
            'wkts' => $wickets,
            'no' => $no_balls,
            'wide' => $wide_balls,
            'ave' => number_format($average, 2),
            'econ' => number_format($economy, 2),
            'sr' => number_format($strike_rate, 2),
            '4w' => $four_wickets,
            '5w' => $five_wickets
        );
    }

    public function singlePlayerBattingRecord($nid, $match_type = FIRST_CLASS_MATCH) {
        // $stat = FALSE;
        $current_score = 0;
        $field = '';
        for ($i = 1; $i <= 11; $i++) {
            $field .= sprintf("field_bating_player%d_nid" . " = '%s' OR ", $i, $nid);
        }
        $field = substr($field, 0, strlen($field) - 3);

        $sql = sprintf("SELECT * FROM `content_type_bating_score` bats LEFT JOIN `content_type_ccb_match` cm ON(bats.field_bating_match_nid = cm.nid) WHERE cm.field_match_type_value = '%s' AND($field) ORDER BY cm.`field_match_date_value`", $match_type);
//echo $sql."<br />";exit;
        $bc = $this->executeQuery($sql);

        $player_id = $nid;
        $matches = $this->getTotalNumberMatchPlayed($nid, $match_type);
        $innings = 0;
        $not_out = 0;
        $runs = 0;
        $highest_scores = 0;
        $average = 0.0;
        $balls_faced = 0;
        $strike_rate = 0.0;
        $hundreads = 0;
        $fifties = 0;
        $thirties = 0;
        $twenties = 0;
        $ducks = 0;
        $fours = 0;
        $sixes = 0;
        $caught = 0;
        $stumpings = 0;


        while ($row = db_fetch_object($bc)) {
            $current_inings_stat = false;
            $index = 0;
            //print_r($row);
            for ($i = 1; $i <= 11; $i++) {
                $field = sprintf("field_bating_player%d_nid", $i);
                if ($row->$field == $nid) {
                    $index = $i;
                    break;
                }
            }

            $index_run = sprintf("field_bating_run%d_value", $index);
            $index_balls_faced = sprintf("field_bating_balls%d_value", $index);
            $index_fours = sprintf("field_bating_4s%d_value", $index);
            $index_sixes = sprintf("field_bating_6s%d_value", $index);
            $index_dismissed = sprintf("field_bating_dismissed%d_nid", $index);
            $index_dismissed_by = sprintf("field_bating_dismissed_by%d_nid", $index);

            if (NOT_BATTED != $row->$index_dismissed) {
                ++$innings;
            }

            if (NOT_OUT == $row->$index_dismissed) { # have to find out a good way
                ++$not_out;
            }

            $runs += $row->$index_run;



            $current_score = $row->$index_run;

            if ($current_score > $highest_scores)
                $highest_scores = $current_score;

            $balls_faced += $row->$index_balls_faced;

            if ($current_score >= 100)
                $hundreads++;
            elseif ($current_score >= 50 && $current_score < 100)
                $fifties++;
            elseif ($current_score >= 30 && $current_score < 50)
                $thirties++;
            elseif ($current_score >= 20 && $current_score < 30)
                $twenties++;
            elseif ($current_score >= 20 && $current_score < 30)
                $twenties++;
            elseif ($current_score < 1)
                $ducks++;


            $fours += $row->$index_fours;
            $sixes += $row->$index_sixes;


            if ($nid == $row->$index_dismissed_by) {
                $caught++;
            } else if (STUMPPED == $row->$index_dismissed_by) {
                $stumpings++;
            }
        }

        if ($runs > 0 && ($innings - $not_out) > 0) {
            $average = number_format(($runs / ($innings - $not_out)), 2);
        } else {
            $average = '-';
        }

        if ($runs > 0 && $balls_faced > 0) {
            $strike_rate = number_format((($runs / $balls_faced) * 100), 2);
        }

        return array(
            'mat' => $matches,
            'inns' => $innings,
            'not_out' => $not_out,
            'runs' => $runs,
            'highest_scores' => $highest_scores,
            'ave' => $average,
            'balls_faced' => $balls_faced,
            'strike_rate' => $strike_rate,
            'hundreads' => $hundreads,
            'fifties' => $fifties,
            'thirties' => $thirties,
            'twenties' => $twenties,
            'ducks' => $ducks,
            'fours' => $fours,
            'sixes' => $sixes,
            'caught' => $caught,
            'stumpings' => $stumpings
        );
    }

    private function getTotalNumberMatchPlayed($nid, $match_type) {
        $sql = sprintf("SELECT count(cm.nid) FROM content_type_ccb_match cm INNER JOIN content_type_ccb_teams ct
            ON(cm.field_match_team1_nid = ct.nid OR cm.field_match_team2_nid = ct.nid) INNER JOIN content_type_ccb_players players
            ON(ct.nid = players.field_players_club_nid) WHERE players.nid=%d AND cm.field_match_status_value='%s' AND cm.field_match_type_value = '%s'", $nid, 'Complete', $match_type);
        // echo $sql;
        return db_result($this->executeQuery($sql));
    }

    private function getTeamInfo($team1_nid, $team2_nid, $player_nid) {
  $team_info = array(); //$player_nid
        $player_node = node_load($player_nid);
       // print_r($player_node);
        $player_team_id = $player_node->field_players_club[0]['nid'];


        if ($player_team_id != $team1_nid)
            $away_team_id = $team1_nid;

        if ($player_team_id != $team2_nid)
            $away_team_id = $team2_nid;
        
        $player_team_node = node_load($player_team_id);
        $away_team_node = node_load($away_team_id);
        
        $team_info['home_team'] = $player_team_node->field_short_name[0]['value'];
        $team_info['away_team'] =  $away_team_node->field_short_name[0]['value'];

      


        return $team_info;
    }

    public function getRecentMacthesInfo($player_nid) {

        $field = '';
        for ($i = 1; $i <= 11; $i++) {
            $field .= sprintf("field_bating_player%d_nid" . " = '%s' OR ", $i, $player_nid);
        }
        $field = substr($field, 0, strlen($field) - 3);

        $sql = sprintf("SELECT * FROM `content_type_bating_score` bats LEFT JOIN `content_type_ccb_match` cm ON(bats.field_bating_match_nid = cm.nid) WHERE ($field) ORDER BY cm.`field_match_date_value` DESC LIMIT 0, 5");

        $bc = $this->executeQuery($sql);

        $recent_matches = array();
        $counter = 0;


        $not_out = FALSE;


        while ($row = db_fetch_object($bc)) {
            $recent_match_info = array();
            $not_out = FALSE;
            $index = 0;

            for ($i = 1; $i <= 11; $i++) {
                $field = sprintf("field_bating_player%d_nid", $i);
                if ($row->$field == $player_nid) {
                    $index = $i;
                    break;
                }
            }

            $index_run = sprintf("field_bating_run%d_value", $index);
            $index_balls_faced = sprintf("field_bating_balls%d_value", $index);

            $index_dismissed = sprintf("field_bating_dismissed%d_nid", $index);

            if (NOT_OUT == $row->$index_dismissed) { # have to find out a good way
                $not_out = TRUE;
            }

            $team = $this->getTeamInfo($row->field_match_team1_nid, $row->field_match_team2_nid, $player_nid);

            $played_team = $team['home_team'];

            $away_team = $team['away_team'];

            //print_r($row);


            $runs = $row->$index_run;
            $recent_match_info['match_id'] = $row->field_bating_match_nid;
            $recent_match_info['score'] = ($runs) . (($not_out) ? '*' : '') . '(' . $row->$index_balls_faced . ')';
            $recent_match_info['team'] = $played_team;
            $recent_match_info['opposition'] = $away_team;
            
            $ground = node_load($row->field_match_venue_nid);

            
            $recent_match_info['ground'] = $ground->field_short_name[0]['value'];
            $recent_match_info['match_date'] = date('d M Y', strtotime($row->field_match_date_value));
            $recent_match_info['match_type'] = $row->field_match_type_value;
            $recent_matches[] = $recent_match_info;
        }


        foreach ($recent_matches as &$match) {
            $field = '';
            for ($i = 1; $i <= 11; $i++) {
                $field .= sprintf(" field_bowling_player%d_nid" . " = '%s' OR ", $i, $player_nid);
            }
            $field = substr($field, 0, strlen($field) - 3);

            $sql = sprintf("SELECT * FROM `content_type_ccb_bowling_card` bowls WHERE field_bowling_match_nid = %d AND ($field)", $match['match_id']);

            $bc = $this->executeQuery($sql);

            while ($row = db_fetch_object($bc)) {
                $index = 0;
                //print_r($row);
                for ($i = 1; $i <= 11; $i++) {
                    $field = sprintf("field_bowling_player%d_nid", $i);
                    if ($row->$field == $player_nid) {
                        $index = $i;
                        break;
                    }
                }


                $index_run = sprintf("field_bowling_run%d_value", $index);
                $index_wicket = sprintf("field_bowling_wkts%d_value", $index);
                $index_over = sprintf("field_bowling_over%d_value", $index);

                $runs = $row->$index_run;
                $wickets = $row->$index_wicket;
                $bowlling = $runs . '/' . $wickets . '(' . $row->$index_over . ')';
            }
            $match['bowlling'] = $bowlling;
        }
        return $recent_matches;
    }

    private function executeQuery($sql) {
        return db_query($sql);
    }

}

class Dismissal_type {
    CONST DISMISSTAL_TYPE_RUN_OUT = 1;
    CONST DISMISSTAL_TYPE_CAUGHT = 2;
    CONST DISMISSTAL_TYPE_STUMPED = 3;
    CONST DISMISSTAL_TYPE_HIT_WICKET = 4;
    CONST DISMISSTAL_TYPE_BOWLED = 5;
    CONST DISMISSTAL_TYPE_NOT_OUT = 6;
    CONST DISMISSTAL_TYPE_DID_NOT_BAT = 7;
    CONST DISMISSTAL_TYPE_CAUGHT_AND_BOWLED = 8;
    CONST DISMISSTAL_TYPE_LBW = 9;
    CONST DISMISSTAL_TYPE_RETIRED = 10;

    public static function getConst($type) {
        switch ($type) {
            case 'Run Out':
                return self::DISMISSTAL_TYPE_RUN_OUT;
            case 'Caught':
                return self::DISMISSTAL_TYPE_CAUGHT;
            case 'Stumpped':
                return self::DISMISSTAL_TYPE_STUMPED;
            case 'Hit wicket':
                return self::DISMISSTAL_TYPE_HIT_WICKET;
            case 'Bowled by':
                return self::DISMISSTAL_TYPE_BOWLED;
            case 'Not Out':
                return self::DISMISSTAL_TYPE_NOT_OUT;
            case 'Not Batted':
                return self::DISMISSTAL_TYPE_DID_NOT_BAT;
            case 'Caught & Bowled':
                return self::DISMISSTAL_TYPE_CAUGHT_AND_BOWLED;
            case 'LBW':
                return self::DISMISSTAL_TYPE_LBW;
            case 'Retired':
                return self::DISMISSTAL_TYPE_RETIRED;
        }
    }

}

class Sort_Array {

    private $_order = 'ASC';
    private $_column = '';

    public function compare($a, $b) {
        $al = $a[$this->_column];
        $bl = $b[$this->_column];
        if ($al == $bl) {
            return 0;
        }
        switch ($this->_order) {
            case 'ASC':
                return ($al > $bl) ? +1 : -1;
            case 'DESC':
                return ($al > $bl) ? -1 : +1;
        }
    }

    public function setOrder($order) {
        $this->_order = $order;
    }

    public function setSortColumn($column) {
        $this->_column = $column;
    }

}