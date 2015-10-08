<?php
session_start();

		if(!isset($_SESSION['loggedIn']))
		{
				echo "<script>location.href='index.php';</script>";
		}
?>

<style>
.headers{
  background-color: #eee;
font-weight:bold;

	}

	select {
    width: 125px !important;
}
	
.searchDiv {
    margin: 5px;
    padding: 5px;
    height:70px;
}

.searchDiv form {
  float:left;
  width:95%;
}
.ownersData {
	display: inline-block;
}
	.searchDiv .owner {

    font-size: 10px;
    height:95px !important;
	}
	.searchDiv .service {

    font-size: 10px;
    height:95px !important;
	}
	.searchDiv .status {
  font-size: 10px;
  height: 95px !important;
  width: 137px !important;
}
	
		.searchDiv .queue {

    font-size: 10px;
    height:95px !important;
	}
	.searchDiv .firstReviewer {

    font-size: 10px;
    height:95px !important;
	}
	.searchDiv .secondReviewer {

    font-size: 10px;
    height:95px !important;
	}
.searchDiv .reload{

}
.rowsFound {
  display: inline-block;
  padding-bottom: 5px;
  width: 13.4%;
}

.Not-Started{
background-color:#fff !important;
}
.Ready-To-Close
{
background:#00ff00 !important;
}
.SF-Ready-to-Close
{
background:#00ff00 !important;
}

.CMS-COS-Template-Done
{
background-color:#CCFF99 !important;

}
.sortable tr:hover {
          background-color: #E0E0D1;
    }
.Blocked{
background:#ff0000 !important;
}

.Ready-For-Review{
background:#FFFF80 !important;
}

.First-Rev-Issues-Sent{
background:#FF9D5C !important;
}

.First-Review-Done{
background:#8099E6 !important;
}

.Second-Rev-Issues-Sent{
background:#FF8533 !important;
}
.In-Progress{
background:#fff !important;
}
.Cancelled
{
	background-color:#F56467 !important;
}
.Mig-In-Progress
{
background-color:#D3DCE3 !important;
}
.Mig-Rev-Done
{
background-color:#9494FF !important;
}
.Mig-Ready-For-Review
{
background-color:#FFFF67 !important;
}
.Mig-First-Rev-Issue-Sent
{
background-color:#FFAC76 !important;
}

.searchDiv input, select {

    font-size: 10px;
    height: 20px !important;
	}
.ContentData select{
border:none;
}

.firstBackground
{
	background-color:#fff;
}
.secondBackground
{
background-color:#fff;
}
/* Sortable tables */
table.sortable thead {
    background-color:#eee;
    color:#666666;
    font-weight: bold;
    cursor: default;

}
.sortable{
	border-collapse:collapse;
	clear:both;
	}
	

.sortable td{
	padding:3px;
	}
	.Background1
{
	background-color:#dfebc7;
}
.Background2
{
background-color:#fff;
}

@media(min-width:768px) and (max-width:1100px){
.custsubname
{display:none;}

.sortable {
  border-collapse: collapse;
  clear: both;
  table-layout: fixed;
  width: 100%;
}


.sortable td{
  white-space: normal !important;
  word-wrap: break-word !important;
  }

.sortable a {
  white-space: normal !important;
  word-wrap: break-word !important;
}

.sortable select {
	  max-width: 100%;
	  width: 100%;
	}
.elapsed{
	width:3%;
	}
.serial {
width:3%
}
.pages {
width:3%
}
.owner-data
{
width:10%;
}
}
.notes{
	background: none repeat scroll 0 0 #fff;
    border: 1px solid;
    border-radius: 5px;
    box-shadow: 0 0 5px #000;
    display: none;
    padding: 7px;
    position: absolute;
    z-index: 1;
	max-width:290px;
	margin-top:3px;
	}

	</style>
<script>

function getUpdatedData(trackId,update)
{
	var xmlhttp;
	var cann;
	var val;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					comments = xmlhttp.responseText;
					if(comments!=''){
					 cann = confirm(comments);
					}else{
						val = 'Ready To Close';
					}
					if(comments!=''){
						if(cann == true)
						{
								val = 'Ready To Close';
						}
						else
						{
							return false;
						}
					}	
					var xmlhttp1;
					if (window.XMLHttpRequest)
					  {// code for IE7+, Firefox, Chrome, Opera, Safari
					  xmlhttp1=new XMLHttpRequest();
					  }
					else
					  {// code for IE6, IE5
					  xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					xmlhttp1.onreadystatechange=function()
					  {
					  if (xmlhttp1.readyState==4 && xmlhttp1.status==200)
						{
						document.getElementById("myDiv").innerHTML=xmlhttp1.responseText;
						}
					  }
					xmlhttp1.open("GET",'updateOwner.php?value='+val+'&trackId='+trackId+'&toUpdate='+update,true);
					xmlhttp1.send();
				}	
			  }
			xmlhttp.open("GET",'getUpdate.php');
			xmlhttp.send();		
}


	function updateOwner(val,trackId,update)
	{	
		if(val == "Ready To Close")
		{
		var stat='status'+trackId;
		var stats='status'+trackId+trackId+'stat';
		getUpdatedData(trackId,update);
		return false;
		}
		if(val == "Not Started")
		{
		var stat='status'+trackId;
		var stat1='status'+trackId+trackId+'stat';
		//alert(stat);
		//alert(stat1);
			document.getElementById(stat).style.background="#fff";
			document.getElementById(stat1).style.background="#fff";
		}
		if(val == "Blocked")
		{
		var stat='status'+trackId;
		var stat1='status'+trackId+trackId+'stat';
		//alert(stat);
		//alert(stat1);
			document.getElementById(stat).style.background="#ff0000";
			document.getElementById(stat1).style.background="#ff0000";
		}
	
	if(val != '')
		{
			if(val == 'Closed')
			{
					var closed=confirm("Are You Sure To Close This Template");
					if(closed == true)
				{
							val = 'Closed';
				}
				else
				{
							val = val;
							if(val == 'Closed')
								{
											return false;
								}
							
				}
			}
		var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",'updateOwner.php?value='+val+'&trackId='+trackId+'&toUpdate='+update,true);
xmlhttp.send();
		}

	}
	</script>
	<script>
	function updateClosedProject(val,trackId,update)
	{
	//	alert("hello");
	//	alert(val);
	//	alert(trackId);
//		alert(val);
	//	alert(update);
	
	
		if(val == "Ready To Close")
		{
		var stat='status'+trackId;
		var stats='status'+trackId+trackId+'stat';
		//alert(stat);
		//alert(stat1);
			document.getElementById(stat).style.background="#00ff00";
			document.getElementById(stats).style.background="#00ff00";
		}
		if(val == "Not Started")
		{
		var stat='status'+trackId;
		var stat1='status'+trackId+trackId+'stat';
		//alert(stat);
		//alert(stat1);
			document.getElementById(stat).style.background="#fff";
			document.getElementById(stat1).style.background="#fff";
		}
		if(val == "Blocked")
		{
		var stat='status'+trackId;
		var stat1='status'+trackId+trackId+'stat';
		//alert(stat);
		//alert(stat1);
			document.getElementById(stat).style.background="#ff0000";
			document.getElementById(stat1).style.background="#ff0000";
		}
	
	
	if(val != '')
		{
			if(val == 'Closed')
			{
					var closed=confirm("Are You Sure To Close This Template");
					if(closed == true)
				{
							val = 'Closed';
				}
				else
				{
							val = val;
							if(val == 'Closed')
								{
											return false;
								}
							
				}
			}
		var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",'updateClosedProject.php?value='+val+'&trackId='+trackId+'&toUpdate='+update,true);
xmlhttp.send();
		}

	}
	</script>
	<script>
	function mailSentSsb( value,trackID)
		{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","sendBlockedMail.php?trackID="+trackID,true);
xmlhttp.send();
		}
</script>
	<?php 
	function getAllStatusOption()
	{
		$getStatus=mysql_query("select * from status");
		while($statusArr=mysql_fetch_array($getStatus))
		{?>
			<option value="<?php echo $statusArr['status']; ?>"><?php echo $statusArr['status']; ?></option>
		<?php }


	}
	?>
		
	<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Khula:400,300,600,700,800:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
  
    
<script>
function ssbIDChecks(trackID) {
	var track = trackID
	if(document.getElementById('ssbIDChk'+trackID).checked){
			document.getElementById(track).style.backgroundColor = '#BFBF19';
			if (trackID == ""){
				document.getElementById("txtHint").innerHTML = "";
				return;
			}else{
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					}else{
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
				xmlhttp.open("GET","trackIDChecked.php?trackID="+trackID,true);
				xmlhttp.send();
			}
	}else{
			document.getElementById(track).style.backgroundColor = '';
		    if (trackID == ""){
				document.getElementById("txtHint").innerHTML = "";
				return;
			}else{
		
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					}else{
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
					}
			xmlhttp.open("GET","trackIDUnChecked.php?trackID="+trackID,true);
			xmlhttp.send();
			}
	}

}
</script>
<script>
function priorityFunc(target) {
		if (target == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("priority").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getPriorityData.php?target="+target,true);
        xmlhttp.send();
		}
}
</script>