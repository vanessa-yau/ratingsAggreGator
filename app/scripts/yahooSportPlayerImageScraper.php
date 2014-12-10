<?php

// // team names, per league (modular)
// function iterateOverTeamName ($teamNames) {
// 	// array of team ids
// 	$teamIdArray = [];
// 	foreach ($teamNames as $teamName) {
// 		$teamName = getTeamIdsByName($teamName);
// 		array_push($teamIdArray, $teamName);
// 	} // end for each
// 	return $teamIdArray
// }

// function getTeamIdsByName($teamName) {
// 	$tott = Team::whereName('Tottenham Hotspur')->first()->id;
// 	return $tott;
// }

function getPlayersInTeam() {
	foreach (Player::whereLastKnownTeam(6)->get() as $player) {
		echo $player->name . "\n"; 
	}
}

getPlayersInTeam();