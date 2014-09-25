<?php

foreach($model as $item){
    echo '<h2>'. $item->title .'</h2>';
    echo '<img src="images/management/'. $item->id .'/'.$item->img.'" width="100px" height="100px" />';
    echo $item->description;
    echo '<a href="mailto:' . $item->email . '">' . $item->email . '</a>';
}