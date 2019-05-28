<?php
require_once('controler.php');

if(empty($_GET['path'])){
    $path = './';
} else {
    $path = $_GET['path'];
}

$pid = getmypid();
$content = new controler($path);

if(!empty($images['content'] = $content->getImg())){
    $image['col-md'] = 10;
    $container = '-fluid';
} else {
    $image['col-md'] = 0;
    $dirs['col-md'] = 12;
}
if(!empty($dirs['content'] = $content->getDirs())){
    if($dirs['col-md'] != 12) $dirs['col-md'] = 2;
} else {
    $dirs['col-md'] = 0;
    $image['col-md'] = 12;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$path?></title>
            
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
<div class="exit" pid="<?=$pid?>">
    <span class="glyphicon glyphicon glyphicon-off"></span>
</div>

<ol class="breadcrumb navbar-fixed-top">
    <li>mviewer</li>
    <li>[ <a href="/?path=/home/mov"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/?path=/media"><span class="glyphicon glyphicon-hdd"></span></a> ]</li>
<?php foreach(controler::gen_nav($path) as $row): ?>
    <li><a href="/?path=<?=$row['pwd']?>"><?=$row['name']?></a></li>
<?php endforeach?>
</ol>

<div class="container<?=$container?>">
    <div class="row">
<?php if($image['col-md']):?>
        <div class="col-md-<?=$image['col-md']?> image-bar text-center">
        <div class="row"><h5><?=count($images['content'])?>  изображений</h5></div>
<?php foreach($images['content'] as $in => $row): ?>
            <img src="/imglo.php?img=<?=$row['pwd']?>" alt="<?=$row['name']?>" id="<?=$in?>" class="img-thumbnail"> 
<?php endforeach; ?>
        </div>
<?php endif; ?>
<?php if($dirs['col-md']):?>     
        <div class="col-md-<?=$dirs['col-md']?> folder-bar">
            <div class="table-responsive">
                <table class="table-folder table table-hover">   
<?php foreach($dirs['content'] as $row): ?>
                    <tr>
                        <td class="icon-folder"><span class="glyphicon glyphicon-folder-open"></span></td>
                        <td><a href="/?path=<?=$row['pwd']?>"><?=$row['name']?></a></td>
                        <td style="text-align: right"><?=$row['col_ob']?></td>  
                    </tr>
<?php endforeach; ?>
                </table>
            </div>
        </div>
<?php endif; ?>
    </div>
</div>

<div class="clock">
    <ul>
        <li id="hours"></li>
        <li id="point">:</li>
        <li id="min"></li>
        <li id="point">:</li>
        <li id="sec"></li>
    </ul>
</div>

<div class="modal" id="modal-imgs" tabindex="-1" role="dialog" aria-labelledby="modal-imgs" aria-hidden="true">
        <img src="" alt="" class="img-responsive center-block">
</div>
</body>
</html>
