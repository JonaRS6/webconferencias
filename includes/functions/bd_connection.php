<?php
  function proxyRequest() {
    $fixieUrl = getenv("FIXIE_URL");
    $parsedFixieUrl = parse_url($fixieUrl);

    $proxy = $parsedFixieUrl['host'].":".$parsedFixieUrl['port'];
    $proxyAuth = $parsedFixieUrl['user'].":".$parsedFixieUrl['pass'];

    $ch = curl_init('https://gdlwebcamps.herokuapp.com/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyAuth);
    curl_close($ch);
  }

  $response = proxyRequest();
  print_r($response);   
?>
<?php
    $conn = new mysqli('localhost', 'root', '', 'gdlwebcamp', '3306');

    if ($conn->connect_error) {
        echo $error -> $conn->connect_error;
    }
    $conn->set_charset("utf8");
?>