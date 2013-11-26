<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ccbmodulehelper
 *
 * @author Zaman
 */
class CCB_Helper {
    //put your code here

    public static function getAge($startDate, $endDate) {
        
        $date1 = new DateTime($endDate);
        $date2 = new DateTime($startDate);
        $interval = $date1->diff($date2);


        if($interval->y) {
            if($interval->y > 1) {
                $years =  $interval->y . ' years ';
            } else {
                $years =  $interval->y . ' year ';
            }
        }

        if($interval->m) {
            if($interval->m > 1) {
                $months =  $interval->m . ' months ';
            } else {
                $months =  $interval->m . ' month ';
            }
        }


        if($interval->d) {
            if($interval->d > 1) {
                $days =  $interval->d . ' days ';
            } else {
                $days =  $interval->d . ' day ';
            }
        }


        return $years.$months.$days;
    }



    public static function getPlayerUrl($nid) {
        return base_path(). drupal_get_path_alias( 'node/' . $nid). '/statistics';
    }

}
?>
