<?php
    function buildHalfDiamondArray($characterArray) {
        $wordRightPointer = count($characterArray);
        $wordLeftPointer = 0;
        while($wordRightPointer - $wordLeftPointer >= 1) {
            $numberOfLetters = $wordRightPointer - $wordLeftPointer;
            $str = $numberOfLetters . " ";
            for($i = 0; $i < $wordLeftPointer; $i++) {
                $str .= " ";
            }
            for($i = $wordLeftPointer; $i < $wordRightPointer; $i++) {
                $str .= $characterArray[$i];
            }
            $diamondArray[] = $str;
            $wordLeftPointer++;
            $wordRightPointer--;
        }
        return $diamondArray;
    }

    function buildFullDiamondArray($diamondArray) {
        $shiftedArray = $diamondArray;
        array_shift($shiftedArray);
        return array_merge(array_reverse($shiftedArray), $diamondArray);

    }

    function diamondWord($word) {
        // (//u) split using UTF-8
        $characterArray = preg_split("//u", $word, -1, PREG_SPLIT_NO_EMPTY);
        return buildFullDiamondArray(buildHalfDiamondArray($characterArray));
    }

    function diamondWords($words) {
        $stringDiamonds = "";
        $numOfWords = count($words);
        foreach($words as $word) {
            $diamond = diamondWord($word);
            foreach($diamond as $row) {
                $stringDiamonds .= $row . "\n";
            }
            if(--$numOfWords != 0) {
                $stringDiamonds .= "0\n";
            }
        }
        return $stringDiamonds;
    }

    $args = $argv;
    array_shift($args);
    echo diamondWords($args);
?>