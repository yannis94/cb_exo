<?php 

function generator($limit) {
    $cb_array = [];
    for ($i=0; $i < $limit + 1; $i++) { 
        $new_cb = "";
        for ($j=0; $j < 17; $j++) {
            if ($j === 0) {
                $num = strval(random_int(1, 9));
            }
            else {
                $num = strval(random_int(0, 9));
            }
            $new_cb .= $num;
        }
        array_push($cb_array, $new_cb);
    }
    return $cb_array;
}
