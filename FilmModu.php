Link Kullanımı	: http://SUNUCU ADRESİNİZ/HDFilmCehennemi.php?ID=https://www.filmmodu.us/final-recovery-film-izle


<?php
$Live = $_GET['ID'];
$ch = curl_init($Live);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Connection: keep-alive',
    'User-Agent: iPlayTV',
    'Accept: */*',
    'Referer: ' . $Live,
));
$site = curl_exec($ch);
curl_close($ch);
preg_match('#videoId = \'(.*?)\'#', $site, $icerik);
$Data = $icerik[1];
preg_match('#videoUrl = \'(.*?)\'#', $site, $icerik);
$Url = $icerik[1];

$ch1 = curl_init($Url . '/get-source?movie_id=' . urlencode($Data) . '&type=tr');
curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
    'Connection: keep-alive',
    'X-Requested-With: XMLHttpRequest',
    'User-Agent: iPlayTV',
    'Accept: application/json, text/javascript, */*; q=0.01',
    'Referer: ' . $Live,
));
$site1 = curl_exec($ch1);
curl_close($ch1);
$site1 = stripcslashes($site1);
preg_match_all('/"src":\s*"([^"]+\.m3u8)".*?"res":\s*"(\d+)"/s', $site1, $icerik);

$maxRes = 0;
$maxUrl = '';

foreach ($icerik[2] as $i => $res) {
    if ((int)$res > $maxRes) {
        $maxRes = (int)$res;
        $maxUrl = $icerik[1][$i];
    }
}

if ($maxUrl) {
    header("Location: $maxUrl");
}
?>