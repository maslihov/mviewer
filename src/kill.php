<?php
if(!empty($_GET['pid'])){
    $pid = $_GET['pid'];
}
exec("kill {$pid}");