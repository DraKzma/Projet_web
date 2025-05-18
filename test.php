<?php
// questions et options
$questions = [
    [
        "audio" => "question1.wav",
        "text" => "Question 1 : Choissisez votre réponse ?",
        "options" => ["Réponse A", "Réponse B", "Réponse C"]
    ],
    [
        "audio" => "question2.wav",
        "text" => "Question 2 : Choissisez votre réponse.",
        "options" => ["Option 1", "Option 2", "Option 3"]
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Questionnaire Audio</title>
</head>
<body>
    <h1>Lecture de l'audio principal</h1>
    <audio controls>
        <source src="comprehension.wav" type="audio/wav">
        Votre navigateur ne supporte pas la lecture audio.
    </audio>

    <form method="post" action="">
        <h2>Questions :</h2>
        <?php foreach ($questions as $index => $q): ?>
            <div style="margin-bottom: 20px;">
                <p><strong><?= htmlspecialchars($q['text']) ?></strong></p>
                <audio controls>
                    <source src="question1.wav" type="audio/wav">
                    Votre navigateur ne supporte pas la lecture audio.
                </audio><br>

                <?php foreach ($q['options'] as $optIndex => $option): ?>
                    <label>
                        <input type="radio" name="question<?= $index ?>" value="<?= $optIndex ?>">
                        <?= htmlspecialchars($option) ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <input type="submit" value="Soumettre">
    </form>

    <?php
    // Traitement de la soumission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h2>Résultats :</h2>";
        foreach ($questions as $index => $q) {
            $answer = isset($_POST["question$index"]) ? $_POST["question$index"] : "Aucune réponse";
            echo "<p><strong>Question " . ($index + 1) . " :</strong> Réponse sélectionnée : " . htmlspecialchars($answer) . "</p>";
        }
    }
    ?>
</body>
</html>
