<?php
if (!empty($_GET['img'])){
  $image = getimagesize($_GET['img']);
  $image_size = filesize($_GET['img']);
  
  header('Content-type: ' . $image['mime']);
  header('Content-length: ' . $image_size);
  if(($data = file_get_contents($_GET['img']))){
    echo $data;
  }
}
