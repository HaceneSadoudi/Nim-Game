<?php

/**
 * Main program
 * Nim is a mathematical game of strategy in which two players take turns removing 
 * (or "nimming") objects from distinct heaps or piles. On each turn, a player must 
 * remove at least one object, and may remove any number of objects provided they 
 * all come from the same heap or pile. 
 * The goal of the game is either to avoid taking the last object or to take the last 
 * object. 
 * 
 * @param  int    $nb_line : number of board lines
 * @param  int    $nb_alu : the maximum number of matches that can be removed 
 * 
 * @author Hacene Sadoudi <sadoudi2019@gmail.com>
 * @return void
 */
function Matchstick($nb_line, $nb_alu) {
    $board = array();
    $board = init($board, $nb_line);
    $user = 1;
    $boardWidth = (2 * $nb_line) + 1;
    $humanTurn = true;
    // Number of matches remaining in the board
    $remainingMatches  = array_reduce($board, function ($previous, $current) {
        return $previous + $current;
    });
    // GAME MOD MENU
    echo "Choose The Game Mode:\n";
    color(190, "(1) Player\n");
    color(193, "(2) IA\n");
    do {
        $mod = readline("Your Choise: ");
    } while ($mod != 1 && $mod != 2);

    while ($remainingMatches > 0) {
        display($board, $boardWidth);
        if ($mod == 1) color(39, "Player $user turn:\n");
        elseif ($humanTurn) echo color(6, "Your turn:\n");
        else echo color(6, "AI's turn...\n");
        if ($mod == 1 || $humanTurn) { // Player turn
            // Ask for line number
            $line = readline("Line: ");
            while (!is_numeric($line) || $line < 1 || $line > $nb_line || $board[$line - 1] == 0) {
                if (!is_numeric($line)) {
                    color(1, "Error: invalid input (positive number expected)\n");
                } else {
                    color(1, "Error: this line is out of range\n");
                }
                $line = readline("Line: ");
            }
            // Ask for matche number
            $matches = readline("Matches: ");
            while (!is_numeric($matches) || $matches > $nb_alu || $matches < 1 || $board[$line - 1] < $matches) {
                if (!is_numeric($matches)) {
                    color(1, "Error: invalid input (positive number expected)\n");
                } elseif ($matches > $nb_alu) {
                    color(1, "Error: you cannot remove more than 5 matches per turn\n");
                } elseif ($matches < 1) {
                    color(1, "Error: you have to remove at least one match\n");
                } else {
                    color(1, "Error: not enough matches on this line\n");
                }
                $matches = readline("Matches: ");
            }
        } else { // IA turn
            // Choose a random line
            do {
                $line = rand(1, sizeof($board));
            } while (($line > $nb_line || $board[$line - 1] == 0));
            // Choose a random number of matches
            do {
                $matches = rand(1, $board[$line - 1]);
            } while ($matches > $nb_alu || $board[$line - 1] < $matches);
        }
        if ($mod == 1) echo "Player $user removed $matches match(es) from line $line.\n";
        elseif ($humanTurn) echo "Player removed $matches match(es) from line $line.\n";
        else {
            print("Line: $line\n");
            print("Matches: $matches\n");
            echo "AI removed $matches match(es) from line $line.\n";
        }
        $board[$line - 1] -= $matches;
        $remainingMatches -= $matches;
        // Switch player turn
        if ($mod == 1) $user = $user == 1 ? 2 : 1;
        else $humanTurn = !$humanTurn;
    }
    display($board, $boardWidth);
    if ($mod == 1) echo  color(2, "Player $user win the game");
    elseif ($humanTurn)
        color(2, "lost... snif... but I'll get you next time!!");
    else
        color(1, "You lost, too bad...");
    echo "\n";
}

/**
 * Initialize the game board
 * 
 * @param  array  $board   : empty game board array
 * @param  int    $nb_line : number of board lines
 * 
 * @author Hacene Sadoudi <sadoudi2019@gmail.com>
 * @return array $board
 */
function init($board, $nb_line) {
    $rows = 1;
    for ($i = 0; $i < $nb_line; $i++) {
        $board[$i] = $rows;
        $rows += 2;
    }
    return $board;
}

/**
 * Display the game board in the console
 * A match is represented by a pipeline |
 * 
 * @param  array  $board  : game board
 * @param  int    $width  : game board width  
 * 
 * @author Hacene Sadoudi <sadoudi2019@gmail.com>
 * @return void
 */
function display($board, $width) {
    for ($j = 0; $j < $width; $j++) color(rand(9, 15), "*");
    echo "\n";
    for ($i = 0; $i < sizeof($board); $i++) {

        $mid = (int)(($width - 2) / 2) - $i;
        color(rand(9, 15), "*");
        for ($j = 0; $j < $width - 2; $j++) {
            if ($j >=  $mid && $j < $mid + $board[$i]) color(rand(9, 15), "|");
            else echo " ";
        }
        color(rand(9, 15), "*");
        echo "\n";
    }
    for ($j = 0; $j < $width; $j++) color(rand(9, 15), "*");
    echo "\n";
}

/**
 * Print a text with a color
 * 
 * @param  int    $nbr  : color number
 * @param  string $txt  : text to color
 * 
 * @author Hacene Sadoudi <sadoudi2019@gmail.com>
 * @return void
 */
function color($nbr, $txt) {
    echo `tput setaf $nbr` . $txt . `tput sgr0`;
}

Matchstick(intval($argv[1]), intval($argv[2]));
