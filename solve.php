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

        $posible_numbers = [1,2,3,4,5,6,7,8,9];

    function get_row($row) {
        global $board;
        global $posible_numbers;
        foreach ($board[$row] as $number) {
            if (in_array($number, $posible_numbers)) {
                unset($posible_numbers[array_search($number, $posible_numbers)]);
            }
        }
    }

    function get_col($col) {
        global $board;
        global $posible_numbers;
        foreach (array_column($board, $col) as $number) {
            if (in_array($number, $posible_numbers)) {
                unset($posible_numbers[array_search($number, $posible_numbers)]);
            }
        }
    }

    function get_box($row, $col) {
        global $board;
        global $posible_numbers;
        $maxBoxRow = ($row<3)*3+(($row>=3)*($row<6))*6+(($row>=6)*($row<9))*9;
        $maxBoxCol = ($col<3)*3+(($col>=3)*($col<6))*6+(($col>=6)*($col<9))*9;

        for ($i=($maxBoxRow-3); $i < $maxBoxRow; $i++) { 
            for ($j=($maxBoxCol-3); $j < $maxBoxCol; $j++) {
                $number = $board[$i][$j];
                if (in_array($number, $posible_numbers)) {
                    unset($posible_numbers[array_search($number, $posible_numbers)]);
                }
            }
        }
    }

    function get_posible($row, $col) {
        get_row($row);
        get_col($col);
        get_box($row, $col);
    }

    $finished = false;
    while (!$finished) {
        $finished = true;
        for ($i=0; $i < count($board[0]); $i++) { 
            for ($j=0; $j < count($board); $j++) { 
                if($board[$i][$j] == null) {
                    $finished = false;
                    $posible_numbers = [1,2,3,4,5,6,7,8,9];
                    get_posible($i, $j);
                    if(count($posible_numbers) == 1) {
                        $board[$i][$j] = $posible_numbers[array_keys($posible_numbers)[0]];
                    }
                }
            }
        }
    }

    for ($i=0; $i < count($board[0]); $i++) { 
        for ($j=0; $j < count($board); $j++) { 
            echo $board[$i][$j];
        }
        echo '<br>';
    }