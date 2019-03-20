<?php
    function ft_is_sort($arr)
    {
        $sorted = $arr;
        $rsorted = $arr;
        sort($sorted);
        rsort($rsorted);
        if ($arr == $sorted || $arr == $rsorted)
            return true;
        else
        	return false;
    }
?>