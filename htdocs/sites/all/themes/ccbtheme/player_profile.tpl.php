<h2><?php echo $data->player_info->title;?></h2>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=59674903355" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
<dl class="player_info">
    <dt><a href="#"><?php print theme('imagecache', "player_profile", $data->player_info->field_players_photo[0]['filepath']);?></a></dt>
    <dd class="details">
        <span class="txt01"><b>Full Name:</b> <?php echo $data->player_info->title;?></span>
        <span class="txt01"><b>Born:</b> <?php echo date('Y-m-d', strtotime($data->player_info->field_dob[0]['value']));?></span>
        <span class="txt01"><b>Current age:</b> <?php echo CCB_Helper::getAge(date('Y-m-d', strtotime($data->player_info->field_dob[0]['value'])), date('Y-m-d'));?></span>
        <span class="txt01"><b>Major teams:</b> <?php echo theme('node_title', $data->player_info->field_players_club[0]['nid'], false);?></span>
        <span class="txt01"><b>Playing role:</b> <?php echo $data->player_info->field_players_role[0]['value'];?></span>
        <span class="txt01"><b>Batting:</b> <?php echo $data->player_info->field_bating_style[0]['value'];?></span>
        <span class="txt01"><b>Bowling:</b> <?php echo $data->player_info->field_bowling_style[0]['value'];?></span>

    </dd>
    <dd class="recent_match">
        <h4 class="h4_01">Recent matches</h4>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th width="76">Bat &amp; Bowl</th>
                <th width="57">Team</th>
                <th width="76">Opposition</th>
                <th width="57">Ground</th>
                <th width="83">Match Date</th>
                <th width="84">Scorecard</th>
            </tr>
            <?php $i = 0; foreach($data->recent_matches_info as $row): ?>

            <tr <?php if($i++%2==0): ?> class="bgclr_01" <?php  endif; ?>>
                        <td><b style="width:76px"><?php echo $row['score']. ', '. $row['bowlling']; ?></b></td>
                        <td><b style="width:57px"><?php echo $row['team']; ?></b></td>
                        <td><b style="width:76px"><?php echo 'v '. $row['opposition']; ?> </b></td>
                        <td><b style="width:57px"><?php echo $row['ground']; ?></b></td>
                        <td><b style="width:83px"><?php echo $row['match_date']; ?></b></td>
                        <td><b style="width:84px"><?php echo $row['match_type']; ?></b></td>
                    </tr>


            <?php endforeach; ?>

           
        </table>
    </dd>
</dl>

<div class="player_ave">
    <div class="batting_bowling">
        <h3>Batting and fielding averages</h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th width="14%">&nbsp;</th>
                <th width="6%">Mat</th>
                <th width="6%">Inns</th>
                <th width="5%">NO</th>
                <th width="6%">Runs</th>
                <th width="6%">HS</th>
                <th width="7%">Avg</th>
                <th width="7%">BF</th>
                <th width="6%">SR</th>

                <th width="4%">50</th>
                <th width="4%">30</th>
                <th width="4%">20</th>

                <th width="5%">4s</th>
                <th width="4%">6s</th>
                <th width="5%">Ct</th>
                <th width="4%">St</th>
            </tr>

            <tr class="bgclr_01">
                <td><b>T20</b></td>
                <td><?php echo $data->bating_statistics_t20['mat'];?></td>
                <td><?php echo $data->bating_statistics_t20['inns'];?></td>
                <td><?php echo $data->bating_statistics_t20['not_out'];?></td>
                <td><?php echo $data->bating_statistics_t20['runs'];?></td>
                <td><?php echo $data->bating_statistics_t20['highest_scores'];?></td>
                <td><?php echo $data->bating_statistics_t20['ave'];?></td>
                <td><?php echo $data->bating_statistics_t20['balls_faced'];?></td>
                <td><?php echo $data->bating_statistics_t20['strike_rate'];?></td>

                <td><?php echo $data->bating_statistics_t20['fifties'];?></td>
                <td><?php echo $data->bating_statistics_t20['thirties'];?></td>
                <td><?php echo $data->bating_statistics_t20['twenties'];?></td>

                <td><?php echo $data->bating_statistics_t20['fours'];?></td>
                <td><?php echo $data->bating_statistics_t20['sixes'];?></td>
                <td><?php echo $data->bating_statistics_t20['caught'];?></td>
                <td><?php echo $data->bating_statistics_t20['stumpings'];?></td>
                
            </tr>

        </table>
    </div>

    <div class="batting_bowling">
        <h3>Bowling averages</h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th width="15%">&nbsp;</th>
                <th width="7%">Mat</th>
                <th width="6%">Inns</th>
                <th width="5%">Balls</th>
                <th width="7%">Runs</th>
                <th width="6%">Wkts</th>
                <th width="8%">No</th>
                <th width="7%">Wide</th>
                <th width="8%">Avg</th>
                <th width="6%">Econ</th>
                <th width="4%">SR</th>
                <th width="6%">4w</th>
                <th width="4%">5w</th>
            </tr>
            <tr class="bgclr_01">
                <td><b>T20</b></td>
                <td><?php echo $data->bowlling_statistics_t20['mat'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['inns'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['overs'] * 6;?></td>
                <td><?php echo $data->bowlling_statistics_t20['runs'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['wkts'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['no'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['wide'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['ave'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['econ'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['sr'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['4w'];?></td>
                <td><?php echo $data->bowlling_statistics_t20['5w'];?></td>
            </tr>
        </table>
    </div>
</div>