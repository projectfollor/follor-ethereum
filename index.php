<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Follor Ethereum</title>
  
  
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>

      <style>
	  body{
  padding:20px 20px;
}

.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}




</style>

  
</head>

<body>
<center><h2>Follor Index</h2> <a href=add.php> Submit Movie Torrent</a> <a href=site.php>Browse Index</a></center>



    
    

  <div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="What you looking for?">
</div>
<span class="counter pull-right"></span>
<table class="table table-hover table-bordered results">
  <thead>
    <tr>
    <th class=col-md-5 col-xs-5>Name</th>
    <th class=col-md-3 col-xs-3>Quality</th>
    <th class=col-md-3 col-xs-3>Year</th>
    <th class=col-md-3 col-xs-3>Language</th>
    <th class=col-md-3 col-xs-3>Rating</th>
    <th class=col-md-3 col-xs-3>IMDB Page</th>
    <th class=col-md-3 col-xs-3>Watch Now</th>
    <th class=col-md-3 col-xs-3>Donate Seeder</th>
	  
	  
	  
    </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
  </thead>
  <tbody>



<?php
$i = 0;
$jsondata = file_get_contents("http://idenze.herokuapp.com/api.php");
$obj = json_decode($jsondata);
$size = sizeof($obj);



while($i < $size) {
   $id = $obj[$i][0];
   $q = $obj[$i][1];
   
   
   $id = preg_replace('/[^a-zA-Z0-9]/', '', $id);


   $jsonx = file_get_contents("http://getimdb.herokuapp.com/get/?id=".$id);
   $json = json_decode($jsonx, true);
    
    
$link =  "https://instant.io/#".$obj[$i][3];
$seeder = $obj[$i][4];
$lang = $obj[$i][2];


echo "  <tr>
    <td>$json[title]</td>
    <td>$q</td>
    <td>$json[year]</td>
    <td>$lang</td>
    <td>$json[rating]</td>
    <td><a target=_blank href=https://www.imdb.com/title/$id>IMDB</a></td>
    <td><a target=_blank href=$link>Watch Now</a></td>
    <td><a target=_blank href=https://etherscan.io/address/$seeder> Donate </a></td>
  </tr>
  ";
  
  
if( rand(1, 1000)> 950){

// putting pages in the index 
$template = "


<meta name=description content=watch $json[title] online, stream $json[title] online in full HD, watch $json[title] online for free />
<meta name=keywords content=download $json[title], $json[title], watch $json[title], watch $json[title] online, stream $json[title] online in full HD, watch $json[title] online for free />
<meta name=author content=metatags generator>
<meta name=robots content=index, follow>
<meta name=revisit-after content=6 days>
<title>Download $json[title]</title>


<center>Watch $json[title] [$lang] </center>
<br>
<center>Realeased Year : $json[year] </center>
<br>
<center>Quality : $json[year] </center>
<br>
<center>Rating : $json[rating] </center>
<br><br><br><br><br><br>

<center>
<a href=http://instant.io/$obj[$i][3] >Click TO Watch Online</a>
<br>
<a href=magnet:?xt=urn:btih:$obj[$i][3]&dn=Ready+Player+One+(2018)+%5BBluRay%5D+%5B1080p%5D+%5BYTS.AM%5D&tr=wss%3A%2F%2Ftracker.btorrent.xyz&tr=wss%3A%2F%2Ftracker.fastcast.nz&tr=wss%3A%2F%2Ftracker.openwebtorrent.com > Download Torrent </a>
<br>
</center>


<br><br>

<center> Donate Ethereum To Seeder :  $seeder </center>





";   


// comment to disable 
$myFile = preg_replace('/\s+/', '+', $json[title]) . ".html"; // or .php   
$fh = fopen($myFile, 'w'); // or die("error");  
fwrite($fh, $template);
fclose($fh);
//comment to disbale the index building


}




$i++;
}



?>





	
  </tbody>
</table>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script >
	
	$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
</script>




</body>

</html>
