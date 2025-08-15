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

    //合計・平均・最大・最小
    function stats(array $scores):array{
        $only = array_column($scores,'score');
        if(!$only){
            return [
                'total'=> 0,
                'avg'=> 0,
                'max'=> null,
                'min'=> null
            ];
        }
        $total = array_sum($only);
        return[
        'total' => $total,
        'avg'   => round($total / count($only), 2),
        'max'   => max($only),
        'min'   => min($only),
        ];
    }

    //最低点の生徒を表示
    function findMin(array $scores): ?array{
        if(!$scores){
            return null;
        }
        $minStudent = $scores[0];

        foreach($scores as $student){
        // 今見ている人の点数が、今の最低点より低ければ更新
        if ($student['score'] < $minStudent['score']) {
            $minStudent = $student;
        }
    }
        //見つけたら最低点の人を返す
        return $minStudent;
    }

    function findMax(array $scores): ?array{
        if( !$scores){
            return null;
        }
        $maxStudent = $scores[0];

        foreach($scores as $student){
            if($student['score'] > $maxStudent['score']){
                $maxStudent = $student;
            }
        }

        //見つけたら最高点の人を返す
        return $maxStudent;
    }
?>