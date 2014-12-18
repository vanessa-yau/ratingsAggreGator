$sth = mysqli_query("SELECT id, name FROM `players` WHERE `last_known_team`='1'");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);