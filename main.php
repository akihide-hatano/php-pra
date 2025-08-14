<?php

/**
 * 渡されたJSON形式の成績データを点数が高い順に並べ替えて出力する関数
 *
 * @param string $jsonString 成績データが格納されたJSON文字列
 * @return void
 */

function sortScore(string $jsonString):void
{
    $scores = json_decode($jsonString,true);

    //jsonがerrorで取れない場合
    if(json_last_error() !== JSON_ERROR_NONE){
        echo "JSONデータのデコードに失敗しました。\n";
        return;
    }

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

    // 結果を出力
    echo "--- 成績ランキング（高い順）---\n";
    foreach ($scores as $student) {
        echo "名前: " . $student['name'] . ", ";
        echo "科目: " . $student['subject'] . ", ";
        echo "点数: " . $student['score'] . "\n";
    }
}
    // JSON形式の成績データ（ここでは文字列として定義）
    $jsonScores = '[
        { "name": "佐藤", "subject": "数学", "score": 85 },
        { "name": "鈴木", "subject": "国語", "score": 92 },
        { "name": "高橋", "subject": "理科", "score": 78 },
        { "name": "田中", "subject": "社会", "score": 92 }
    ]';

    // 関数を実行
    sortScore($jsonScores);


?>