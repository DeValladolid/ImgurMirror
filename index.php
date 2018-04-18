<?php
// imgur.php
// A super minimal caching imgur mirror script
// Add this to your crontab to prevent massive folder issues:
//   */60 * * * * find ~/path/to/imgur/cache -type f -mtime +3 -delete
// Or turn off caching here...

$CACHE_FOLDER = './cache/';

// Don't edit past here
$isbeta = basename(__FILE__) === 'beta.php';
$imgur = $_SERVER['QUERY_STRING'] ;
$con = stream_context_create(array('http'=>array('timeout'=>15)));

if (!$_SERVER['QUERY_STRING']) {
?><!doctype html>
<html>
  <header>
    <title> Imagex Parser </title>
    <link rel="icon" href="imgur.ico" type="image/x-icon"/>
    <meta name="Description" content="Free tool to skip the block that Imgur makes to certain pages.">
    <meta name="Keywords" content="imgur, images, gif, nsfw">
    <meta name="google-site-verification" content="OloRNbLq-PKcfwBWTLkDcWUh1YwrULKfLGxrMMXyiJE" />
    <meta name="propeller" content="2043203e7501797c4277db9e84736c19">
     <script id="navegg" type="text/javascript">
  (function(n,v,g){o="Navegg";if(!n[o]){
    a=v.createElement('script');a.src=g;b=document.getElementsByTagName('script')[0];
    b.parentNode.insertBefore(a,b);n[o]=n[o]||function(parms){
    n[o].q=n[o].q||[];n[o].q.push([this, parms])};}})
  (window, document, 'https://tag.navdmp.com/universal.min.js');
  window.naveggReady = window.naveggReady||[];
  nvg50839 = new Navegg({
    acc: 50839
  });
</script> 
    
    <script async="async" type="text/javascript" src="//go.mobisla.com/notice.php?p=1637851&interactive=1&pushup=1"></script>  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
  !function(name,path,ctx){
    var latest,prev=name!=='Keen'&&window.Keen?window.Keen:false;ctx[name]=ctx[name]||{ready:function(fn){var h=document.getElementsByTagName('head')[0],s=document.createElement('script'),w=window,loaded;s.onload=s.onerror=s.onreadystatechange=function(){if((s.readyState&&!(/^c|loade/.test(s.readyState)))||loaded){return}s.onload=s.onreadystatechange=null;loaded=1;latest=w.Keen;if(prev){w.Keen=prev}else{try{delete w.Keen}catch(e){w.Keen=void 0}}ctx[name]=latest;ctx[name].ready(fn)};s.async=1;s.src=path;h.parentNode.insertBefore(s,h)}}
  }('KeenAsync','https://d26b395fwzu5fz.cloudfront.net/keen-tracking-1.1.3.min.js',this);

  KeenAsync.ready(function(){
    // Configure a client instance
    var client = new KeenAsync({
      projectId: '5acb35d3c9e77c00017c77f5',
      writeKey: '333685F881A0067F21F65A230D4ECC1DDB8A52CF66DE2998C32B13583A83B6F0756F44ED3052D2B50A50DC9870067F760DEB3EB659DCE65B61DF145C91AD45E45219F93A55EC246EA140F9ED63271C70704A0A2F0D226528F46B14C4904512CE'
    });

    // Record an event
    client.recordEvent('pageviews', {
      title: document.title
    });
  });
</script>
    <a href="//www.iubenda.com/privacy-policy/75057470" class="iubenda-black iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
  <body>
    <div>
      <center><h1>Imgur Proxy</h1></center>
<? if ($isbeta) { ?>
      <h2>BETA MODE</h2>
<? } ?>
      <dl>
        <h2>¿Como obtener imágenes?</h2>
        <dd>Para obtener imágenes, solo tienes que reemplazar "<a href="https://imgur.com">i.imgur.com</a>" por "<?=$_SERVER['HTTP_HOST']?>" 
          dejando la extension del archivo. Por Ejemplo <?=$_SERVER['HTTP_HOST']?>/sample.png</dd>
        <h2>¿Como obtener álbumes?</h2>
        <dd>Para obtener álbumes, solo tienes que reemplazar "imgur.com" por "<?=$_SERVER['HTTP_HOST']?>" 
          dejando "a/+ID-del-album". Por ejemplo <?=$_SERVER['HTTP_HOST']?>/a/1234abc .</dd>
        <dd>Tambien funciona con "gallery" en vez de "a". Por ejemplo <?=$_SERVER['HTTP_HOST']?>/gallery/1234abc</dd>
        <h2>¿Como obtener GIF?</h2>
        <dd>Para obtener GIF´s, solo tienes que reemplazar "i.imgur.com" por "<?=$_SERVER['HTTP_HOST']?>" 
          dejando la extension del archivo. Por Ejemplo <?=$_SERVER['HTTP_HOST']?>/sample.gif</dd>
        <h2>¿Hay alguna forma mas sencilla?</h2>
        <dd>Si, hemos creado un <a href="https://imagex-hosting.ml/">formulario</a>, que con poner la extensión del archivo (123abc.gif) crea automaticamente la URL.</dd>
        <h2>Para WebMasters</h2>
        <dd>Si quieres implementar este sistema a tu web, solo tienes que añadir este sencillo codigo PHP</dd>
        <code>

$urls = "http://imgur.com/xDT6lz7.gif"; // No afectara ningun otro enlace excepto Imgur.

$enlace = $filtro_url = str_replace('imgur.com', 'imgur.parse.tk', $urls); 

echo $enlace;
        </code>

      </dl>
    </div>
    <footer>
      Code on <a href="https://github.com/DeValladolid/ImgurMirror/">github.com</a>
    </footer>
  </body>
</html>
<?
  return;
}

if (preg_match('/^(a|gallery)\/([a-zA-Z0-9]{5,})$/i', $imgur, $matches)) {
  $album_type = $matches[1];
  $album_hash = $matches[2];
  $album_url = 'https://imgur.com/' . $album_type . '/' . $album_hash;
  $cached_filename = $CACHE_FOLDER . $album_hash . '.json';

  if (file_exists($cached_filename)) {
    $fromcache = true;
    $album_data = json_decode(file_get_contents($cached_filename));
  } else { 
    $fromcache = false;
    $album_html = @file_get_contents($album_url, 0, $con) or die('Failed to get imgur album');
    
    if(!preg_match('/^ +image +: (.+), *$/m', $album_html, $album_matches)) 
      die('Failed to locate album data');

    $album_json = $album_matches[1];
    $album_data = json_decode($album_json);

    file_put_contents($cached_filename, $album_json);
  }
  $images = $album_data->album_images->images;
?><!doctype html>
<html>
  <head>
    <style>
      html, body {
        background-color: #111;
        margin: 0;
        padding: 0;
      }
      body a {
        margin: 5px;
        margin-bottom: 10px;
        max-width: 100%;
        display: block;
        text-align: center;
      }
      body a img {
        margin: 0 auto;
        display: block;
        max-width: 100%;
      }
      body a span {
        color: #ccc;
      }
    </style>
  </head>
  <body>
<?php foreach($images as $image) { ?>
    <a href="/<?=$image->hash.$image->ext?>">
      <img src="/<?=$image->hash.'h'.$image->ext?>" >
      <span><?=$image->description?></span>
      <!--<?=json_encode($image)?>-->
    </a>
<?php } ?>
  </body>
</html>
<?php
  return;
} else if (!preg_match('/^([a-zA-Z0-9]{5,})(?:\.(png|jpe?g|gifv?|webm|mp4))?$/i', $imgur, $matches)) {
  die('Not a valid imgur image/gifv video');
}

// gifv/image proxying
if (strtolower($matches[2]) === 'gifv') {
  ?><!doctype html>
<html>
  <body>
    <video preload="auto" autoplay="autoplay" muted="muted" loop="loop" webkit-playsinline controls="controls">
      <source src="/<?=$matches[1]?>.webm" type="video/webm">
      <source src="/<?=$matches[1]?>.mp4" type="video/mp4">
    </video>
    <script>
      var gif = document.location.pathname + "?<?=$matches[1]?>.gif";

      if( document.createElement("video").tagName.toLowerCase() !== 'video' ) {
        var i = document.createElement("img");
        img.src = gif;
        document.body.appendChild(i);
      }
    </script>
    <p>
      If the gifv isn't playing here, try the direct 
      <a href="/<?=$matches[1]?>.mp4">mp4</a>, 
      <a href="/<?=$matches[1]?>.webm">webm</a>, or 
      <a href="/<?=$matches[1]?>.gif">gif</a> links
    </p>
  </body>
</html><?php
} else {
  $cached_filename=$CACHE_FOLDER.$matches[1];

  switch($matches[2]) {
    case 'mp4': 
    case 'webm': 
      $content_type = 'video/'.$matches[2]; 
      $cached_filename=$CACHE_FOLDER.$matches[1].'_'.$matches[2];
      break;
    default: 
      // $content_type = 'image/'.$matches[2]; 
      break;
  }

  if(file_exists($cached_filename)) {
    $image = file_get_contents($cached_filename);
  } else {
    $image = @file_get_contents('http://i.imgur.com/'.$imgur, 0, $con);
    if(!$image) die('Cannot retrieve imgur file');
    file_put_contents($cached_filename, $image);
  }

  $finfo = new finfo(FILEINFO_MIME);
  header('Content-type: ' . $finfo->buffer($image));
  header('Cache-Control: public, max-age=31556926');
  die($image);
}
?>
<?php
  

$urls = "https://imgur.parse.tk/M35yNFb.gif"; // No afectara ningun otro enlace excepto streamcloud.

$enlace = $filtro_url = str_replace('imgur.com', 'imgur.parse.tk', $urls); // Si quieres implementarlo de forma automatica como iframe modificarlo para que quede asi streamcloud.pro/i.

echo $enlace;
?>
