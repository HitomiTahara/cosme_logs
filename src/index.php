<?PHP

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

function listCosmelog($link)
{
    $cosme = [];

    $sql = 'SELECT id, product_name,product_maker,use_by_date,suggestion,etc From cosmelog';
    $results = mysqli_query($link, $sql);

    while ($cos = mysqli_fetch_assoc($results)) {
        $cosme[] = $cos;
    }
    mysqli_free_result($results);
    return $cosme;
}


$link = dbConnect();
$cosme = listCosmelog($link);

$title = '化粧品ログの一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
