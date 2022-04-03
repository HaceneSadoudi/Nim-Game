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

function color($nbr, $txt) {
    echo `tput setaf $nbr` . $txt . `tput sgr0`;
}
