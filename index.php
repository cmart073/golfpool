<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Player Information</title></head>
<body>

<?php
// https://statdata.pgatour.com/r/current/message.json //used to retrieve the tournament number 012
$json_url = "https://statdata.pgatour.com/r/041/leaderboard-v2mini.json";
$json = file_get_contents($json_url);
$payload = json_decode($json, TRUE);


$courseName = $payload['leaderboard']['courses'][0]['course_name'];
$coursePar = $payload['leaderboard']['courses'][0]['par_total'];
$parIn = $payload['leaderboard']['courses'][0]['par_in'];
$parOut = $payload['leaderboard']['courses'][0]['par_out'];
$totalPlayersArray = $payload['leaderboard']['players']; 

?>
<center><div class=card text-white bg-info mb-3><div class="card-header"><h1><?php echo $tournament?></h1></div><div class="card-body"><h2 class="card-title"><?php echo $courseName?></h2><h3><p class="card-text">Par In: <?php echo $parIn?> Par Out: <?php echo $parOut?> Par: <?php echo $coursePar?></p></div></h3></div></center>

<table class="table table-bordered table-dark"><thead><tr class="bg-success"><th scope="col">player ID</th><th scope="col">First</th><th scope="col">Last</th><th scope="col">Current Position</th><th scope="col">Projected Score Today</th><th scope="col">thru</th><th scope="col">todayScore</th><th scope="col">round 1</th><th scope="col">round 2</th><th scope="col">round 3</th><th scope="col">round 4</th></tr></thead>

<?php

for ($x = 0; $x <= sizeof($totalPlayersArray) -1; $x++) {

	$firstName = $payload['leaderboard']['players'][$x]['player_bio']['first_name'];
	$playerID = $payload['leaderboard']['players'][$x]['player_id'];
	$lastName = $payload['leaderboard']['players'][$x]['player_bio']['last_name'];
	$currentPosition = $payload['leaderboard']['players'][$x]['current_position'];
	$teeTime = $payload['leaderboard']['players'][$x]['rounds'][0]['tee_time'];
	$thru = $payload['leaderboard']['players'][$x]['thru'];
	$todayScore = $payload['leaderboard']['players'][$x]['today'];
	$round1Strokes = $payload['leaderboard']['players'][$x]['rounds'][0]['strokes'];
	$round2Strokes = $payload['leaderboard']['players'][$x]['rounds'][1]['strokes'];
	$round3Strokes = $payload['leaderboard']['players'][$x]['rounds'][2]['strokes'];
	$round4Strokes = $payload['leaderboard']['players'][$x]['rounds'][3]['strokes'];

	if ($todayScore == 'null'){
?>
		<tbody> <tr class='bg-primary'><th scope='"'row=<?php echo $x ?>'"'><?php echo $playerID ?></th><td><?php echo $firstName ?></td><td><?php echo $lastName ?></td><td><?php echo $currentPosition ?></td><td><?php echo $projectedStrokesToday ?></td><td><?php echo $thru ?></td><td><?php echo $todayScore ?></td><td><?php echo $round1Strokes ?></td><td><?php echo $round2Strokes ?></td><td><?php echo $round3Strokes ?></td><td><?php echo $round4Strokes ?></td></tr></tbody>
<?php

	} else {
		$projectedStrokesToday = $coursePar + $todayScore;
?>
		
		<tbody> <tr class="bg-primary"><th scope='"'row=<?php echo $x ?>'"'><?php echo $playerID ?></th><td><?php echo $firstName ?></td><td><?php echo $lastName ?></td><td><?php echo $currentPosition ?></td><td><?php echo $projectedStrokesToday ?></td><td><?php echo $thru ?></td><td>-<?php echo $teeTime ?></td><td><?php echo $round1Strokes ?></td><td><?php echo $round2Strokes ?></td><td><?php echo $round3Strokes ?></td><td><?php echo $round4Strokes ?></td></tr></tbody>
<?php
	}
	
}
?></table></body></html>

	
