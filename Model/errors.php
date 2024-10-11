<?php
declare(strict_types=1);

function checkIndexInArray(int $index, array $array){
    $length = count($array);
    
    if(($index < 0) || ($index >= $length )){
        throw new ErrorException(
            "array error: index must be between 0 and $length, index is $index"
        );
    }
}
?>