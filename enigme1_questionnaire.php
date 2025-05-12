<? php
       session_start();
$question=[];
if (isset($_POST['football']){
    $questions = [
        [
            "question" => "Quel pays a gagné la Coupe du Monde 2018 ?",
            "options" => ["Allemagne", "France", "Brésil", "Argentine"],
            "answer" => 1
        ],
        [
            "question" => "Combien de joueurs dans une équipe sur le terrain ?",
            "options" => ["9", "10", "11", "12"],
            "answer" => 2
        ],
        [
            "question" => "Quel joueur est surnommé CR7 ?",
            "options" => ["Messi", "Neymar", "Cristiano Ronaldo", "Mbappé"],
            "answer" => 2
        ],
        [
            "question" => "Quel club est surnommé 'Les Reds' ?",
            "options" => ["Chelsea", "Liverpool", "Arsenal", "Manchester City"],
            "answer" => 1
        ]
    ];
}
    elseif (isset($_POST['histoiregeo'])){
        $questions = [
        [
            "question" => "En quelle année a eu lieu la Révolution française ?",
            "options" => ["1789", "1815", "1914", "1792"],
            "answer" => 0
        ],
        [
            "question" => "Qui était Napoléon Bonaparte ?",
            "options" => ["Un roi", "Un empereur", "Un philosophe", "Un peintre"],
            "answer" => 1
        ],
        [
            "question" => "Quelle est la capitale du Canada ?",
            "options" => ["Toronto", "Ottawa", "Montréal", "Vancouver"],
            "answer" => 1
        ],
        [
            "question" => "Quel fleuve traverse Paris ?",
            "options" => ["La Loire", "Le Rhône", "La Seine", "La Garonne"],
            "answer" => 2
        ]
    ];
} else {
    echo "<p>Vous ne pouvez pas accéder à cette page ! </p>";
    echo "<a href='connexion.php'>voici un lien pour vous connecter</a>"; 
}
        
        
        
          
    

?>




