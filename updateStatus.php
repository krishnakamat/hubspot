<?php
 $status = $_GET['value'];
/*if($status == 'Ready To Close'){
	echo "Ready To Close";
}else{
	echo " ";
}*/
if($status == 'Ready To Close'){
echo '
<select name="status" id="status">
						
						<option value="Started">Started</option>
						<option value="Not Started">Not Started</option>
						<option value="In Progress">In Progress</option>
						<option value="Closed">Closed</option>
						<option value="Ready For Review">Ready For Review</option>
						<option value="First Rev. Issues Sent">First Rev. Issues Sent</option>
						<option value="First Review Done">First Review Done</option>
						<option value="Second Review Done">Second Review Done</option>
						<option value="Second Rev. Issues Sent">Second Rev. Issues Sent</option>						
						<option value="Ready To Close" selected>Ready To Close</option>
						<option value="Blocked" >Blocked</option>		
		</select>';
}else{
	echo "
	<select name='status' id='status'>
						<option value=$status  > $status</option>
						<option value='Started'>Started</option>
						<option value='Not Started'>Not Started</option>
						<option value='In Progress'>In Progress</option>
						<option value='Closed'>Closed</option>
						<option value='Ready For Review'>Ready For Review</option>
						<option value='First Rev. Issues Sent'>First Rev. Issues Sent</option>
						<option value='First Review Done'>First Review Done</option>
						<option value='Second Review Done'>Second Review Done</option>
						<option value='Second Rev. Issues Sent'>Second Rev. Issues Sent</option>						
						<option value='Ready To Close'>Ready To Close</option>
						<option value='Blocked' >Blocked</option>		
		</select>";
	
}
?>