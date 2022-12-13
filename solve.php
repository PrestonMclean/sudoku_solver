<?php


    $board = [
        [   6,null,null,   4,   1,null,   3,null,8],
        [   8,null,   5,null,   6,   3,   4,null,null],
        [   7,   3,null,null,   2,null,null,null,1],
        [null,null,   6,   1,   5,   7,null,null,2],
        [   5,   7,null,null,null,   4,   1,null,6],
        [   1,   2,null,null,   9,   6,null,   4,null],
        [   3,null,null,null,null,null,null,   8,null],
        [null,   6,   9,null,   3,null,null,   5,null],
        [null,null,   7,null,   4,null,null,   1,null]];
    
    function getrow($row) {
        global $board;
        $posibleNumbers = [1,2,3,4,5,6,7,8,9];
        echo 'row<br>';
        foreach ($board[$row] as $number) {
            if (is_numeric($number)) {
                unset($posibleNumbers[array_search($number, $posibleNumbers)]);
            }
        }
        return $posibleNumbers;
    }

    function getCol($col) {
        global $board;
        echo 'colum<br>';
        foreach (array_column($board, $col) as $number) {
            var_dump($number);
            echo "<br>";
        }
    }

    function getBox($row, $col) {
        global $board;
        $maxBoxRow = ($row<3)*3+(($row>=3)*($row<6))*6+(($row>=6)*($row<9))*9;
        $maxBoxCol = ($col<3)*3+(($col>=3)*($col<6))*6+(($col>=6)*($col<9))*9;

        echo 'box<br>';
        for ($i=($maxBoxRow-3); $i < $maxBoxRow; $i++) { 
            for ($j=($maxBoxCol-3); $j < $maxBoxCol; $j++) {
                var_dump($board[$i][$j]);
                echo " ";
            }
            echo "<br>";
        }
    }

    var_dump(getrow(3));