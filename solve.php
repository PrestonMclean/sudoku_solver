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

        

    function possible_numbers_row($row, &$posible_numbers) {
        global $board;
        foreach ($board[$row] as $number) {
            if (in_array($number, $posible_numbers)) {
                unset($posible_numbers[array_search($number, $posible_numbers)]);
            }
        }
    }

    function possible_numbers_column($col, &$posible_numbers) {
        global $board;
        foreach (array_column($board, $col) as $number) {
            if (in_array($number, $posible_numbers)) {
                unset($posible_numbers[array_search($number, $posible_numbers)]);
            }
        }
    }

    function possible_numbers_box($row, $col, &$posible_numbers) {
        global $board;
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

    function  possible_numbers_tried($numbers_tried, &$posible_numbers)
    {
        foreach ($numbers_tried as $number) {
            if (in_array($number, $posible_numbers)) {
                unset($posible_numbers[array_search($number, $posible_numbers)]);
            }
        }
    }

    function posible_numbers($row, $col, &$posible_numbers) {
        possible_numbers_row($row, $posible_numbers);
        possible_numbers_column($col, $posible_numbers);
        possible_numbers_box($row, $col, $posible_numbers);
    }

    function solve () {
        global $board;
        $not_finished = true;
        $previous = [];
        $numbers_tried = [];
        $temp = null;

        while ($not_finished) {
            $not_finished = false;
            for ($i=0; $i < count($board[0]); $i++) {
                for ($j=0; $j < count($board); $j++) {
                    if ($temp != null) {
                        $i = $temp[1];
                        $j = $temp[2];
                        $board[$i][$j] = null;
                        $temp = null;
                    }
                    if($board[$i][$j] == null) {
                        $posible_numbers = [1,2,3,4,5,6,7,8,9];
                        posible_numbers($i, $j, $posible_numbers);
                        if ($numbers_tried != null) {
                            possible_numbers_tried($numbers_tried, $posible_numbers);
                        }

                        $size_of_possible_numbers = count($posible_numbers);
                        if($size_of_possible_numbers > 0) {
                            $random_index = array_keys($posible_numbers)[rand(0, $size_of_possible_numbers-1)];
                            $board[$i][$j] = $posible_numbers[$random_index];

                            if ($numbers_tried != null) {
                                array_push($numbers_tried, $board[$i][$j]);
                            } else {
                                $numbers_tried = array($board[$i][$j]);
                            }
                            $current = [$numbers_tried, $i, $j];
                            $numbers_tried = null;
                            array_push($previous, $current);

                        } else {
                            $not_finished = true;
                            $temp = array_pop($previous);
                            $numbers_tried = $temp[0];
                        }
                    }
                }
            }
        }
    }

    function display () {
        global $board;
        for ($i=0; $i < count($board[0]); $i++) { 
            for ($j=0; $j < count($board); $j++) { 
                echo $board[$i][$j];
            }
            echo '<br>';
        }
    }

    solve();
    display();