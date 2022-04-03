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
