<?php
require_once __DIR__ . '/logic.php';

$scores = loadScores();          // ここで必ず配列に
$high   = sortHigh($scores);
$low    = sortLow($scores);
$avgTak = averageScoreByName($scores, '高橋');
$st     = stats($scores);
$min    = findMin($scores);

function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>成績ダッシュボード</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind を使っているならこのCSSを有効化（パスは環境に合わせて）。未使用なら削除してOK -->
  <link rel="stylesheet" href="public/assets/tailwind.css">
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">
  <main class="max-w-3xl mx-auto p-6 space-y-6">
    <h1 class="text-2xl font-bold">成績ダッシュボード</h1>

    <?php if (empty($scores)): ?>
      <section class="bg-white rounded-xl p-5 shadow">
        <p>データがありません。<code>data/scores.json</code> を確認してください。</p>
      </section>
    <?php else: ?>

      <section class="bg-white rounded-xl p-5 shadow">
        <h2 class="font-semibold mb-3">統計</h2>
        <div>合計点: <?= e($st['total']) ?></div>
        <div>平均点: <?= e($st['avg']) ?></div>
        <div>最高点: <?= e($st['max']) ?></div>
        <div>最低点: <?= e($st['min']) ?></div>
      </section>

      <section class="bg-white rounded-xl p-5 shadow">
        <h2 class="font-semibold mb-3">高い順</h2>
        <?php foreach ($high as $s): ?>
          <div>名前: <?= e($s['name']) ?>, 科目: <?= e($s['subject']) ?>, 点数: <?= e($s['score']) ?></div>
        <?php endforeach; ?>
      </section>

      <section class="bg-white rounded-xl p-5 shadow">
        <h2 class="font-semibold mb-3">低い順</h2>
        <?php foreach ($low as $s): ?>
          <div>名前: <?= e($s['name']) ?>, 科目: <?= e($s['subject']) ?>, 点数: <?= e($s['score']) ?></div>
        <?php endforeach; ?>
      </section>

      <section class="bg-white rounded-xl p-5 shadow">
        <h2 class="font-semibold mb-3">平均点（高橋さん）</h2>
        <div><?= $avgTak !== null ? e($avgTak).' 点' : 'データなし' ?></div>
      </section>

      <section class="bg-white rounded-xl p-5 shadow">
        <h2 class="font-semibold mb-3">最低点の生徒</h2>
        <?php if ($min): ?>
          <div>名前: <?= e($min['name']) ?>, 科目: <?= e($min['subject']) ?>, 点数: <?= e($min['score']) ?></div>
        <?php else: ?>
          <div>データが見つかりませんでした。</div>
        <?php endif; ?>
      </section>

    <?php endif; ?>
  </main>
</body>
</html>
