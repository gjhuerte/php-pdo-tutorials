<?php

require('functions.php');

$query = DB::table('users')->select()->get();
// json_encode(var_dump($query));

while ($row = $query->fetch())
{
    echo $row['username'] . "\n";
}