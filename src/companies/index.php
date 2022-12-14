
<?PHP
require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

function listCompanies($link)
{
    $companies = [];
    $sql = 'SELECT * From companies';
    // $sql = 'SELECT name,establishment_date,founder From companies';
    $results = mysqli_query($link, $sql);
    while ($company = mysqli_fetch_assoc($results)) {
        $companies[] = $company;
    }
    return $companies;
}

$link = dbConnect();
$companies = listCompanies($link);

$title = '会社情報の一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';

