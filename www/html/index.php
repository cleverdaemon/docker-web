<?php

$server_dir = "./";

//chemin jusqu'aux fichiers alias
$aliasDir = $server_dir.'alias/';

//Fonctionne à condition d'avoir ServerSignature On et ServerTokens Full dans httpd.conf
$server_software = $_SERVER['SERVER_SOFTWARE'];
$error_content = '';

// on récupère les versions des applis
$phpVersion = $wampConf['phpVersion'];
$apacheVersion = $wampConf['apacheVersion'];
$doca_version = 'doca'.substr($apacheVersion,0,3);
$mysqlVersion = $wampConf['mysqlVersion'];

//On récupère la valeur de VirtualHostMenu
$VirtualHostMenu = $wampConf['VirtualHostSubMenu'];

//on récupère la valeur de apachePortUsed
$port = $wampConf['apachePortUsed'];
$UrlPort = $port !== "80" ? ":".$port : '';
//On récupère le ou les valeurs des ports en écoute dans Apache
// $ListenPorts = implode(' - ',listen_ports());
//on récupère la valeur de mysqlPortUsed
$Mysqlport = $wampConf['mysqlPortUsed'];


// répertoires à ignorer dans les projets
$projectsListIgnore = array ('.','..','wampthemes','wamplangues');
include('wamplangues/index_english.php');

//Fin Récupération ServerName

// récupération des projets
$handle=opendir(".");
$projectContents = '';
$directoryFiles = array();
while (($file = readdir($handle))!==false)
{
  if (is_dir($file) && !in_array($file,$projectsListIgnore))
  {
    $artisanFlag = false;
    $folderCheck = opendir("./".$file);
    while (($testfile = readdir($folderCheck)) !== false) {
      if ($testfile == 'artisan') {
        $artisanFlag = true;
        break;
      }
    }
    if ($artisanFlag == true) {
      $directoryFiles[$file] = $file . " [Laravel]";
    }
    else {
      $directoryFiles[$file] = $file;
    }
  }
}
natcasesort($directoryFiles);

foreach ($directoryFiles as $file => $alias) {
  $projectContents .= '<li><a href="';
  if (stripos($alias, "[Laravel]") !== false) {
    $projectContents .= 'http://localhost'.$UrlPort.'/'.$file.'/public/"';
  }
  else {
    $projectContents .= 'http://localhost'.$UrlPort.'/'.$file.'/"';
  }
  $projectContents .= '>';
  $projectContents .= $alias;

  $projectContents .= '</a></li>';
}

closedir($handle);
if (empty($projectContents))
  $projectContents = "<li>".$langues['txtNoProjet']."</li>\n";

$pageContents = <<< EOPAGE
<!DOCTYPE html>
<html>
<head>
  <title>Projects Home</title>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
  <link id="stylecall" rel="stylesheet" href="wampthemes/classic/style.css" />
  <link rel="shortcut icon" href="favicon.ico" type="image/ico" />
</head>

<body>
  </div>

  <div class="config">
      <div class="innerconfig">

    <div class="alltools ${allToolsClass}">
      <div class="inneralltools">
 
              <div class="column">
              <h2>{$langues['txtProjet']}</h2>
              <ul class="projects">
                  ${projectContents}
              </ul>
          </div>
EOPAGE;
$pageContents .= <<< EOPAGEC
        </div>
    </div>

  <div class="divider2">&nbsp;</div>
</body>
</html>
EOPAGEC;

echo $pageContents;

?>
