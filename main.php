<?php

/**
 * 渡されたJSON形式の成績データを点数が高い順に並べ替えて出力する関数
 *
 * @param string $jsonString 成績データが格納されたJSON文字列
 * @return void
 */

// JSONファイルを読み込む関数
function loadScores(): array {
    $path = __DIR__ . '/data/scores.json';
    if (!file_exists($path)) {
        return []; // ファイルがない場合は空配列
    }
    $json = file_get_contents($path);
    $scores = json_decode($json, true);

    // JSONデコード失敗時は空配列
    if (json_last_error() !== JSON_ERROR_NONE) {
        return [];
    }

    return $scores;
}

    function sortHighScore(array $scores):void
    {

        // //jsonがerrorで取れない場合
        // if(json_last_error() !== JSON_ERROR_NONE){
        //     echo "JSONデータのデコードに失敗しました。\n";
        //     return;
        // }

        // 点数（score）を基準に降順（高い順）で並べ替え
        // usortはユーザー定義の比較関数を使って配列をソートする
        usort($scores, function($a, $b) {
            if ($b['score'] > $a['score']) {
                return 1; // bの点数がaより高ければ、bを前にする
            } elseif ($b['score'] < $a['score']) {
                return -1; // bの点数がaより低ければ、bを後ろにする
            } else {
                return 0; // 点数が同じなら、順序は変えない
            }
        });
        // return $scores;
    }

     function sortLowScore(array $scores) : void {
            //jsonがerrorで取れない場合
            if(json_last_error() !== JSON_ERROR_NONE){
                echo "JSONデータのデコードに失敗しました。\n";
                return;
            }

            // 点数（score）を基準に降順（高い順）で並べ替え
            // usortはユーザー定義の比較関数を使って配列をソートする
            usort($scores, function($a, $b) {
                if ($a['score'] > $b['score']) {
                    return 1; // aの点数がbより高ければ、aを後にする
                } elseif ($a['score'] < $b['score']) {
                    return -1; // aの点数がbより低ければ、aを前にする
                } else {
                    return 0; // 点数が同じなら、順序は変えない
                }
            });

    }

    function averageScoreByname(array $scores,string $targetName){
        //変数の指定と初期化
        $totalScore = 0;
        $count = 0;

        foreach( $scores as $student){
            //名前の一致を確認
            if($student['name'] === $targetName){
                $totalScore += $student['score'];
                $count++;
            }

        }
    }

    function allStats(array $scores){
        //点数だけを抜き出し配列に格納
        $scoreOnly = array_column($scores,'score');

        //合計点と平均点を計算
        $totalScore = array_sum($scoreOnly);
        $averageScore = $totalScore / count($scoreOnly);

        // 最高点と最低点を取得
        $maxScore = max($scoreOnly);
        $minScore = min($scoreOnly);
    }

    function fingMinScore(array $scores){
        //最低点を見つけるための初期値として、高すぎる数値を設定
        $minScore = 101;
        $minScoreStudent = null; //最低点の生徒情報を格納する変数を初期化

        foreach( $scores as $student){
        if ($student['score'] < $minScore) {
            // 最低点を更新
            $minScore = $student['score'];
            // 最低点を取った生徒の情報を記録
            $minScoreStudent = $student;
        }
    }

    }

    // ここを追加
    $scores = loadScores() ?? [];


    // 関数を実行
    sortHighScore($scores);
    sortLowScore($scores);
    averageScoreByname($scores,'高橋');
    allStats($scores);
    fingMinScore($scores);
?>