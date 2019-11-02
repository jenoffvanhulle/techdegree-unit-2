<?php
// Generate random questions
$randomQuestions = [];

// Loop for required number of questions
define('START', 0);
define('END', 10);
for($i = START; $i < END; $i++){

// Get random numbers to add
$leftAdder = rand(1, 99);
$rightAdder = rand(1, 99);

// Calculate correct answer
$correctAnswer = $leftAdder + $rightAdder;

// Get incorrect answers within 10 numbers either way of correct answer
// Make sure it is a unique answer
do {
  $firstIncorrectAnswer = abs($correctAnswer + rand(-10,10));
} while ($firstIncorrectAnswer == $correctAnswer);

do {
  $secondIncorrectAnswer = abs($correctAnswer + rand(-10,10));
} while ($firstIncorrectAnswer == $secondIncorrectAnswer || $correctAnswer == $secondIncorrectAnswer);

// Add question and answer to questions array
$randomQuestions[] = [
	"leftAdder" => $leftAdder,
	"rightAdder" => $rightAdder,
	"correctAnswer" => $correctAnswer,
	"firstIncorrectAnswer" => $firstIncorrectAnswer,
	"secondIncorrectAnswer" => $secondIncorrectAnswer
];
}