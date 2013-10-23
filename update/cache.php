<?php

$starttime = microtime(1);
ob_start();

function printPodcastBox($podcast, $count) {
  $found_podcasts = false;
  $file_arr = array();
  $i = 0;
  if ($handle = @scandir('./../podcasts/' . $podcast[1], 1)) {
    foreach($handle as $file) {
      if ($file != "." && $file != "..") {
        $Episode = explode('.', $file);
        if($Episode[2] != '') {
	  $file_arr[$i++] = $Episode;
        }
      }
    }

    if (0 < $i) {
      $found_podcasts = true;
      $Episode = $file_arr[0];
      $linkname = str_replace('_', '.', $Episode[1]);
      $link = 'http://shownot.es/'.$podcast[1].'/'.ltrim($Episode[0], '0 \t\n\r');
      $linkname_title=$linkname;
      $slug_match;
      if( FALSE !== ($slug_match = stripos($linkname, $podcast[0])) ) {
        $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[0]));
      } else if ( FALSE !== ($slug_match = stripos($linkname, $podcast[1])) ) {
        $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[1]));
      }
      $linkname_title_reg_ret = @preg_replace("/-([0-9]+)/"," \\1", $linkname_title);
      if ( NULL !== $linkname_title_reg_ret) {
        $linkname_title = $linkname_title_reg_ret;
      }
      if ( FALSE === stripos($linkname_title, $podcast[1]) &&  FALSE === stripos($linkname_title, $podcast[0])) {
        $linkname_title = $podcast[0] . ': ' . $linkname_title;
      }
      if ( isset($podcast[5])) {
        $linkname_title.="\n";
        $linkname_title.=$podcast[5];
      }
      echo "      <div class=\"thispodcast\">\n";
      echo "        <div class=\"podcastimg\">\n";
      echo '          <a href="' . $link . '" title="' . $linkname_title . '" >';
      echo "\n";
      echo "            <img src=\"http://shownot.es/img/logos/" . $podcast[3] . "\" alt=\"" . $podcast[4] . "\" />\n";
      echo "          </a>\n";
      echo "        </div>\n";
      echo "        <div class=\"baf-group\">\n";
      echo '          <a class="baf bluehover" href="' . $podcast[2] . '">' . htmlentities($podcast[0], ENT_QUOTES, "UTF-8") . '</a>';
      echo "\n";
      echo "          <a class=\"baf bluehover dropdown-toggle\" data-toggle=\"dropdown\" >\n";
      echo "            <span class=\"caret\"></span>\n          </a>\n          <ul class=\"dropdown-menu\">\n";

      echo '            <li><a href="'.$link.'" title="' . $linkname_title . '">'.htmlentities($linkname, ENT_QUOTES, "UTF-8").'</a></li>';
      echo "\n";
      ++$count;

      for($j = 1; $j < $i; $j++) {
        $Episode = $file_arr[$j];
        $linkname = str_replace('_', '.', $Episode[1]);
        $link = 'http://shownot.es/'.$podcast[1].'/'.ltrim($Episode[0], '0 \t\n\r');
        $linkname_title=$linkname;
        $slug_match;
        if( FALSE !== ($slug_match = stripos($linkname, $podcast[0])) ) {
          $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[0]));
        } else if ( FALSE !== ($slug_match = stripos($linkname, $podcast[1])) ) {
          $linkname_title = substr($linkname, 0, $slug_match) . $podcast[0] . substr($linkname, $slug_match + strlen($podcast[1]));
        }
        $linkname_title_reg_ret = @preg_replace("/-([0-9]+)/"," \\1", $linkname_title);
        if ( NULL !== $linkname_title_reg_ret) {
          $linkname_title = $linkname_title_reg_ret;
        }
        if ( FALSE === stripos($linkname_title, $podcast[1]) &&  FALSE === stripos($linkname_title, $podcast[0])) {
          $linkname_title = $podcast[0] . ': ' . $linkname_title;
        }
        echo '            <li><a href="'.$link.'" title="' . $linkname_title . '">'.htmlentities($linkname, ENT_QUOTES, "UTF-8").'</a></li>';
        echo "\n";
        ++$count;
      }
      echo "          </ul>\n        </div>\n      </div>\n";
    }
  }

  if ( false === $found_podcasts) {
    echo "            <li>Verzeichnis leer</li>\n";
  }
  return $count;
}

?><!DOCTYPE html>
<html lang="de"> 
<head>
  <meta charset="utf-8" />
  <title>Die Shownotes</title>
  <meta name="viewport" content="width=715" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <link rel="icon" type="image/x-icon" href="./favicon.ico" />
  <link rel="stylesheet" href="http://shownot.es/baf/css/baf.min.css?v=006" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownot.es/css/style.min.css?v=006" type="text/css" />
  <link rel="stylesheet" href="http://shownot.es/css/anycast.min.css?v=006" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownot.es/css/startseite.min.css?v=004" type="text/css"  media="screen" />
  <link rel="apple-touch-startup-image" href="http://shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://shownot.es/img/iPadPortait.png" />
  <style>
    .flattrbtn {
      float: left;
    }
    .flattrbtn iframe {
      height: 20px;
      width: 150px;
      visibility: visible;
      position: relative;
      margin-right: 5px;
    }
  </style>
</head>
<body onload="baf_listenerInit();">
<div class="content">
  <div class="box" id="main">
    <div class="header">
      <div class="title"><a href="/"><img src="http://shownot.es/img/logo_app.png" alt="Shownot.es Logo">Die Shownotes</a></div>
    </div>
    <p style="margin-top: 1em;">
      Wir sind eine Community, die Shownotes f&uuml;r verschiedene Podcast- und Radioformate live mitnotiert. Unsere Plattform findet ihr auf <a href="http://pad.shownot.es/"><strong>pad.shownot.es</strong></a>.
    </p><hr><br>
    <div id="podcasts">
      <p style="margin-top: 1em;">
        Wir schreiben aktuell f&uuml;r folgende Podcasts mehr oder weniger regelm&auml;ßig die Shownotes:
      </p>
      <br/><br/>
<?php
/* An array to contain all the podcasts we link to on the front page.
 * a podcast is entered as an array, that array has up to 6 parameters, of which the last is optional:
 *   0: Name of the podcast
 *   1: slug (folder where the podcast is located at)
 *   2: the general web address under which the podcast resides
 *   3: name of the logo file
 *   4: alternate text of the logo file
 *   5: Optional. Additional title text for the logo file
 */
$podcast_arr = array(
  array('WRINT','wrint','http://www.wrint.de/','wr_logo.png','WRINT Logo'),
  array('Blue Moon','bm','http://www.fritz.de/media/podcasts/sendungen/blue_moon.html','bmll_logo.png','BlueMoon / Lateline Logo', 'Blue Moon Foto von Ainhoa Pcb l, CC: BY'),
  array('Chaosradio','cr','http://chaosradio.ccc.de/chaosradio.html','cr_logo.png','Chaosradio Logo'),
  array('Not Safe for Work','nsfw','http://not-safe-for-work.de/','nsfw_logo.png','NSFW Logo'),
  array('Einschlafen','ep','http://einschlafen-podcast.de/','ep_logo.png','EinschlafenPodcast Logo'),
  array('Freak Show','mm','http://freakshow.fm/','fs_logo.png','Freak Show Logo'),
  array('Wikigeeks','wg','http://wikigeeks.de/','wg_logo.png','Wikigeeks Logo'),
  array('Psychotalk','psyt','http://www.psycho-talk.de/','psyt_logo.png','Psychotalk Logo'),
  array('Pubkameraden','pp','http://www.pubkameraden.de/','pp_logo.png','Pubkameraden Podcast Logo'),
  array('Jobscast','jc','http://www.jobscast.de/','jc_logo.png','Jobscast Logo'),
  array('Sondersendung','dss','http://die-sondersendung.de/','dss_logo.png','Sondersendung Logo'),
  array('ABSradio','abs','http://absradio.de/','abs_logo.png','ABSradio Logo'),
  array('Netzgespräche','ng','http://www.xn--netzgesprche-ocb.de/','ng_logo.png','Netzgespräche Logo'),
  array('Quasselstrippen','qs','http://die-quasselstrippen.de/','qs_logo.png','Quasselstrippen Logo'),
  array('Robotiklabor','rl','http://www.robotiklabor.de/','rl_logo.png','Robotiklabor Logo'),
  array('Wir. Müssen Reden','wmr','http://wir.muessenreden.de/','wmr_logo.png','Wir. Müssen Reden Logo'),
  array('Radio OSM','osm','http://blog.openstreetmap.de/','osm_logo.png','Radio OSM Logo'),
  array('SozioPod','sozio','http://soziopod.de/','sozio_logo.png','SozioPod Logo')
);
/* optional ToDo: Use last modification as a parameter to shuffling
 * function name is filemtime see http://www.php.net/manual/en/function.filemtime.php
 * it takes only one parameter the file's name,
 * and returns a timestamp
 * probably a good method would be, to sort the array at first
 * using the sorting mechanism usort, which uses a user defined
 * function as comparator for sorting http://www.php.net/manual/en/function.usort.php
 * then, after the array was sorted, some elements could be randomly exchanged
 */
shuffle($podcast_arr);
$ele_count=count($podcast_arr);
$i=0;
$j=0;
for(; $i < $ele_count; $i++) {
  $j = printPodcastBox($podcast_arr[$i], $j);
}

?>

<!-- re:publica 2013
      <div class="thispodcast">
        <div class="podcastimg">
        <a href="http://shownot.es/rp13/"><img src="http://shownot.es/img/logos/rp_logo.png" alt="re-publica Logo" /></a>
          
        </div>
        <div class="baf-group">
          <a class="baf bluehover" id="newPodcast" href="http://shownot.es/rp13/">re:publica</a>
        </div>
      </div>
-->      

      <div class="thispodcast">
        <div class="podcastimg">
        <a href="http://shownot.es/anmelden/"><img src="http://shownot.es/img/logos/shownotes_logo.png" alt="Shownotes Logo" /></a>
          
        </div>
        <div class="baf-group">
          <a class="baf bluehover" id="newPodcast" href="http://shownot.es/anmelden/">Podcast anmelden</a>
        </div>
      </div>
      
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
      
      <!--
        <div style="margin-top: 1em;">
        
        <!--<p>Zu diesen Podcasts gibt es bei uns insgesamt <?php echo $i; ?> Shownote Eintr&auml;ge. <br>Die gesamte Liste der Shownotes ist im <a href="https://shownotes.piratenpad.de/ep/padlist/all-pads">Etherpad</a> zu finden.</p><br>
      </div>-->
    </div>
    <hr />
    <div style="margin: 0px;">
      <p class="clause flattrimg">Um unsere Vorhabungen zu finanzieren, sind wir nach wie vor auf eure Spenden angewiesen. Daher w&uuml;rde es uns freuen, wenn ihr uns ab und zu <a href="https://flattr.com/profile/shownotes">flattern</a> k&ouml;nntet.
      </p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause twitterimg">Zus&auml;tzliche Informationen sind &uuml;ber unsere Twitter Accounts zu erhalten: <a href="http://twitter.com/dieshownotes">@DieShownotes</a>, <a href="http://twitter.com/evitabley">@EvitaBley</a>, <a href="http://twitter.com/luutoo">@luutoo</a>, <a href="http://twitter.com/quimoniz">@Quimoniz</a>, <a href="http://twitter.com/kaikubasta">@KaiKubasta</a>, <a href="http://twitter.com/kaeffchen_heinz">@kaeffchen_heinz</a>, <a href="http://twitter.com/dr4k3_LE">@Dr4k3_LE</a> und <a href="http://twitter.com/simonwaldherr">@SimonWaldherr</a>.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause adnimg">Neben Twitter könnt ihr uns auch auf <a href="http://app.net/">App.net</a> erreichen: <a href="https://alpha.app.net/shownotes" rel="me">@Shownotes</a>, <a href="http://alpha.app.net/evita">@Evita</a>, <a href="http://alpha.app.net/luto">@luto</a>, <a href="http://alpha.app.net/quimoniz">@Quimoniz</a>, <a href="https://alpha.app.net/dr4k3">@dr4k3</a> und <a href="http://alpha.app.net/simonwaldherr">@SimonWaldherr</a>.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause ircimg">Ausserdem k&ouml;nnt ihr uns auch im IRC auf <a href="irc://irc.freenode.net/shownotes">freenode</a> (<a href="http://webchat.freenode.net/?channels=%23shownotes">Webchat</a>) oder &uuml;ber unser <a href="http://shownot.es/contact/">Kontaktformular</a> erreichen. 
      </p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <div style="margin-top: 1em;">
      <p class="clause gitimg">Der Großteil der Entwicklung erfolgt auf GitHub. Jeder der mithelfen will, kann gerne Pull-Requests an <a href="https://github.com/shownotes">unsere Repositorys</a> schicken.</p>
      <div style="clear: both; width: 0px; height: 0px; margin: 0px;">&nbsp;
      </div>
    </div>
    <hr />
    <p>Wer Podcasts mag, sollte die <a href="http://hoersuppe.de/">H&ouml;rsuppe</a> kennen. Des weiteren ist <a href="http://podpott.de/">Podpott</a> immer einen Besuch wert. Transkriptionen findet man auf <a href="http://podcascription.de/">Podcascription</a>.</p>
    <p>Informationen f&uuml;r Podcaster gibt es hier: <a href="http://shownot.es/faq/">shownot.es/faq/</a></p>
    <br/>
    <br/><div class="flattrbtn"><a class="FlattrButton" href="http://shownot.es/" title="Die Shownot.es" lang="de_DE">
      [description]
    </a></div><iframe style="visibility: visible; height: 23px; width: 200px;" src="http://platform.twitter.com/widgets/tweet_button.html?url=http%3A%2F%2Fshownot.es%2F&amp;text=Die%20Shownot.es" style="width:110px; height:20px;" allowtransparency="true" frameborder="0" scrolling="no"></iframe>
  </div>
  <div class="footer"><span style="text-align: right;">Alle Sendungsnotizen unterliegen der <a href="http://creativecommons.org/publicdomain/zero/1.0/">CC0-Lizenz</a> (Public Domain).</span></div>
</div>
<script src="http://selfcss.org/baf/js/baf.min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34667234-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = 'http://statistik.simon.waldherr.eu/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

/* <![CDATA[ */
    (function() {
        var s = document.createElement('script');
        var t = document.getElementsByTagName('script')[0];

        s.type = 'text/javascript';
        s.async = true;
        s.src = '//api.flattr.com/js/0.6/load.js?'+
                'mode=auto&uid=shownotes&language=de_DE&category=text&button=compact&popout=0';
        s.button = 'compact';
        s.popout = false;

        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */

</script>
</body>
</html><?php

$inhalt = ob_get_contents();
ob_end_clean();


if (!empty($file_contents))
{
  $tweetbackup = './../tweets/index.html';
  if (!$handle = fopen($tweetbackup, 'w'))
    {
      echo 'Cannot open file '.$tweetbackup;
    }
  $file_contents = '<!DOCTYPE html>
<html lang="de"> 

<head>
  <meta charset="utf-8" />
  <title>Die Shownotes Tweets</title>
  <meta name="viewport" content="width=980" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="./../favicon.ico" />
  <link rel="icon" type="image/x-icon" href="./../favicon.ico" />
  <link rel="stylesheet" href="http://cdn.shownot.es/css/style.min.css?v=006" type="text/css" />
  <link rel="author" href="./../humans.txt" />
  <link rel="apple-touch-startup-image" href="http://cdn.shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://cdn.shownot.es/img/iPadPortait.png" />
  <style>
    .itemlist{
      height: auto;
      overflow: auto;
    }
  </style>
  <script type="text/javascript">
  
    var _gaq = _gaq || [];
    _gaq.push(["_setAccount", "UA-34667234-1"]);
    _gaq.push(["_trackPageview"]);
  
    (function() {
      var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
      ga.src = "http://statistik.simon.waldherr.eu/ga.js";
      var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
    })();
  
  </script>
</head>

<body>
<div class="content">
  <div class="header">
    <div class="title"><a href="http://shownot.es/"><img src="http://cdn.shownot.es/img/logo.png">Die Shownotes</a></div>
  </div>
  <div class="box" id="main">'.$file_contents.'</div>
  <div class="footer"><span style="text-align: right;">Alle Sendungsnotizen unterliegen der <a href="http://creativecommons.org/publicdomain/zero/1.0/">CC0-Lizenz</a> (Public Domain).</span></div>

</div>
</body>

</html>';
  if (fwrite($handle, $file_contents) === FALSE) {
    echo 'Cannot write to file '.$tweetbackup;
    exit;
  }
  fclose($handle);
}

  $generatetime = microtime(1) - $starttime;
  $cache_refresh = 86400;
  $code = '<?php if('.(time() + $cache_refresh).' < time()){'."\n".'echo "<iframe src=\"http://shownot.es/update/\"></iframe>";} ?>';
  
  $filename = './../index.php';
  $inhalt = explode('<body onload="loadShownotes();">', $inhalt);
  $inhalt = $inhalt[0].'<body onload="loadShownotes();"><!-- '."\n".'zuletzt aktualisiert um: '.time().' ('.date("H:i:s d.m.Y").")\n".'Generierungsdauer: '.$generatetime.' sec'."\n".'-->'.$code.$inhalt[1];
?>