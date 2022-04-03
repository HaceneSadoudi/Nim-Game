function init($board, $nb_line) {
    $rows = 1;
    for ($i = 0; $i < $nb_line; $i++) {
        $board[$i] = $rows;
        $rows += 2;
    }
    return $board;
}

