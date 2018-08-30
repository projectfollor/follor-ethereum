<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Follor Ethereum</title>
  
  
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
	
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.6/css/all.css'>


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



.telegram-popup{
  height: 130px;
  min-width: 15%;
  width: 200px;
  background-color: #FFFFFF;
   
  position: fixed;
  bottom: 0px;
  right: 50%; 
  
  /*round corners*/
  border-radius: 10px;
  /*cool option borders.*/ 
  

}

/*text stuff*/
.telegram-popup p{
  color: #000000;
  padding: 4px;
}

.telegram-button{
  background-color: #1682FB;
  width: 80%;
  border-radius: 25px;
}

.telegram-button:hover{
  background-color: #1080F5;
}

.telegram-button p{
  color: #FFFFFF;
  font-size: 15px;
  /*padding makes the link like a bubble*/
  padding: 10px;
}

.telegram-button-link:link{
  text-decoration: none;
}

</style>

  
</head>

<body>
<center><h2>Follor Index</h2> <a href=add.php> Submit Movie Torrent</a> ||| <a href=https://bit.ly/2oklfiB>Run Your Own Site</a></center>



    
    

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
    <th class=col-md-3 col-xs-3>Download</th>
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
	$magnet =  "magnet:?xt=urn:btih:".$obj[$i][3];
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
     <td><a target=_blank href=$magnet>Download</a></td>
    <td><a target=_blank href=https://etherscan.io/address/$seeder> Donate </a></td>
  </tr>
  ";
 
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

  <div class="telegram-popup" align="center">
  
  <a target=_blank href="https://t.me/projectfollor" class="telegram-button-link"><div class="telegram-button">
    <p>
      <i class="fab fa-telegram-plane"></i>
       Join our Telegram.
    </p>
    
    </div></a>
</div>



</body>

</html>
