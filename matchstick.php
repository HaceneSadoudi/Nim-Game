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
