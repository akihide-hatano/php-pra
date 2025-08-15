<?php

    //配列の設定
    function loadScores(): array{
        $path = __DIR__ . '/data/scores.json';
        if(!is_readable($path)) return[];
        $json = file_get_contents($path);
        $arr = json_decode($json ?: '[]',true);
        return is_array($arr) ? $arr : [];
    }

    //高い順に並び変える
    function sortHigh(array $scores):array{
        usort($scores,fn($a,$b) =>$b['score'] <=> $a['score']);
        return $scores;
    }

    //低い順に並び変える
    function sortLow(array $scores):array{
        usort($scores,fn($a,$b) =>$a['score'] <=> $b['score']);
        return $scores;
    }

?>