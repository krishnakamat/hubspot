


<?php 
date_default_timezone_set('Asia/Kolkata');?>

<script type="text/javascript">

var currenttime = '<?php print date("F d, Y H:i:s", time())?>' //PHP method of getting server date

///////////Stop editting here/////////////////////////////////

var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate=new Date(currenttime)

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
document.getElementById("servertime").innerHTML=datestring+" "+timestring
}

window.onload=function(){

	
setInterval("displaytime()", 1000)
}
</script>

<p><b>India Standard Time</b> <span id="servertime"></span></p>

<?php 
date_default_timezone_set('America/New_York');?>
<script type="text/javascript">

var currenttime1 = '<?php print date("F d, Y H:i:s", time())?>' //PHP method of getting server date

///////////Stop editting here/////////////////////////////////

var montharray1=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate1=new Date(currenttime1)

function padlength1(what1){
var output1=(what1.toString().length==1)? "0"+what1 : what1
return output1
}

function displaytime1(){
serverdate1.setSeconds(serverdate1.getSeconds()+1)
var datestring1=montharray1[serverdate1.getMonth()]+" "+padlength1(serverdate1.getDate())+", "+serverdate1.getFullYear()
var timestring1=padlength1(serverdate1.getHours())+":"+padlength1(serverdate1.getMinutes())+":"+padlength1(serverdate1.getSeconds())
document.getElementById("servertime1").innerHTML=datestring1+" "+timestring1
}

window.onload=function(){
setInterval("displaytime1()", 1000)
	
setInterval("displaytime()", 1000)
}

</script>

<p><b>New YorkTime:</b> <span id="servertime1"></span></p>