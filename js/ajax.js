function validateEditCourse(){
	var title = document.getElementById('course_title');
	var credit = document.getElementById('course_credit');
	var cost = document.getElementById('course_exam_cost');
	var desc = document.getElementById('course_desc');
	
	if ((title.value == null) || (title.value == '')) {
		alert('Please Enter Course Title');
		title.focus();
		return false;
	}
	if ((credit.value == null) || (credit.value == '')  || (isNaN(Number(credit.value)))) {
		alert('Please Enter a Valid Course Credit');
		if(credit.value!='') credit.value = '';
		credit.focus();
		return false;
	}
	if ((cost.value == null) || (cost.value == '') || (isNaN(Number(cost.value)))) {
		alert('Please Enter a Valid Exam Cost');
		if(cost.value!='') cost.value = '';
		cost.focus();
		return false;
	}
	
	if ((desc.value == null) || (desc.value == '')) {
		var oEditor = FCKeditorAPI.GetInstance('FCKeditor1');
		var course_desc = oEditor.GetHTML(true);
		if ((course_desc == null) || (course_desc == '')) {
			alert('Please Enter Company Description');
			desc.focus();
			return false;
		}
	}
	
	//check course_number
	try{
		var number = document.getElementById('course_number');
		if ((number.value == null) || (number.value == '')) {
			alert('Please Enter Course Number');
			number.focus();
			return false;
		}
	}catch(e){}
	
	//check categories
	try{
		var ctr_cat = 0;
		var inputs = document.form.getElementsByTagName('input');
		for(var i=0; i<inputs.length; i++){
			if(inputs[i].type=='checkbox' && inputs[i].name=='add[]' && inputs[i].checked){
				ctr_cat++;
			}
		}
		if(ctr_cat==0){
			alert('Please Select a Category');
			return false;
		}
	}catch(e){}
	
	//check categories
	try{
		var ctr_sub = 0;
		var inputs = document.form.getElementsByTagName('input');
		for(var i=0; i<inputs.length; i++){
			if(inputs[i].type=='checkbox' && inputs[i].name=='subjectArea[]' && inputs[i].checked){
				ctr_sub++;
			}
		}
		if(ctr_sub==0){
			alert('Please Select a Subject Area');
			return false;
		}
	}catch(e){}
	
	return true;
}

function state(){
	var name = document.form;
	if ( name.check.checked == true) {name.create.disabled = false; }
	if (name.check.checked == false) {name.create.disabled = true;}
}

function getCoursesReq (){
	var courses_required = document.getElementById("courses_required");
	var arr = new Array();
	for(i = 0; i < courses_required.options.length; i++){
		arr[i] = courses_required.options[i].value;
	}		
	document.getElementById("accumulate_courses_required").value = arr.toString();
}

function removeOption(listbox,i){
	listbox.remove(i);
}
	
function addOption(selectbox,text,value ){
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}

function addOption_list(){
	var credit_limit = document.getElementById("credit_limit").value;
	var flag =1;
	if( (credit_limit==null) || (credit_limit==0) )
		alert("Please enter a credit limit to set the required courses.");
	else {
		var list_of_courses = document.getElementById("list_of_courses");
		var courses_required = document.getElementById("courses_required");
		
		for(i=list_of_courses.options.length-1; i>=0; i--) {
			if(list_of_courses.options[i].selected) {
				var courseID = list_of_courses.options[i].value;
				var arr = new Array();
				for(x = 0; x < courses_required.options.length; x++)  {						
					var courseReqID = courses_required.options[x].value;						
					arr[x] = courseReqID;
					if(courseReqID == courseID){
						alert("Course was already added!");
						flag = 0;
					}				
				}
				
				if(flag){
					var url = "company_add_courses.php?crsid="+ courseID +"&action=add&credit="+credit_limit+"&divCourseReq="+arr.toString();
					break;						
				}
			}
		}
	}
}
	
function removeOption_list(){
	var courses_required = document.getElementById("courses_required");
	var actualCount = 0;
	var arr = new Array();
	for(i = 0; i < courses_required.options.length; i++){
		if(!courses_required.options[i].selected){
			arr[actualCount++] = courses_required.options[i].value;
		}					
	}
	var url = "company_add_courses.php?action=remove&divCourseReq="+arr.toString();
}

function addPosition(clone_area) {
	// alert(clone_area);

	var cl = document.getElementById(clone_area);
	var cdivs = cl.getElementsByTagName('div');
	// alert(cl.innerHTML);
	if (clone_area == 'addcomp_clone_area') {
		var divId = 'addcomp_clone' + (cdivs.length + 1);
		cl.innerHTML += '<div id="'
				+ divId
				+ '" name="'
				+ divId
				+ '">Position: <input name="positions[]" type="text" /><input type="button" value="Remove" onClick="removePosition(\''
				+ clone_area + '\', \'' + divId + '\');" /></div>';
	} else {
		var divId = 'editcomp_clone' + (cdivs.length + 1);
		cl.innerHTML += '<div id="'
				+ divId
				+ '" name="'
				+ divId
				+ '">Position: <input name="positions[]" type="text" /><input type="button" value="Remove" onClick="removePosition(\''
				+ clone_area + '\', \'' + divId + '\');" /></div>';
	}

}

function removePosition(fromArea, divId) {
	var c1 = document.getElementById(fromArea);
	var rem = document.getElementById(divId);
	c1.removeChild(rem);
}

function confirmPositionDelete(pid, cid, divId) {
	var x = confirm("Are you sure you want to delete this position? ");
	if (x)
	{
	   //removePosition('editcomp_clone_area',divId);
	   location.href = "deletePosition.php?pid="+pid+"&cid="+cid+"&divId="+divId;
	}
}

/*function confirmPositionDelete(cid, divId) {
	var x = confirm("Are you sure you want to delete this position? " + cid);
	  if (x){
	   removePosition('editcomp_clone_area',divId);
	  }
}*/

function removePosition(fromArea, divId) {
	var c1 = document.getElementById(fromArea);
	var rem = document.getElementById(divId);
	c1.removeChild(rem);
}

function validateCoupon() {
	var code = document.getElementById('CouponCode');
	var discountType = document.getElementById('DiscountType');
	var amount = document.getElementById('CouponAmount');
	var expdate = document.getElementById('CouponDate');
	//var day = document.getElementById('CouponDay');
	//var year = document.getElementById('CouponYear');
	var couponlist = document.getElementById('CouponList');

	if ((code.value == null) || (code.value == '')) {
		alert('Please Enter Coupon Code.');
		code.focus();
		return false;
	}
	if (discountType.value == 0){ 
		alert('Please Select Discount Type.');
		discountType.focus();
		return false;
	}
	/*else if (discountType.value != '' ){
		if(amount.value == '') {
				alert('Please Enter amount.');
			amount.focus();
			return false;
			}
		else if(couponlist.value == 0) {
				alert('Please select.');
			couponlist.focus();
			return false;
			}
	}*/
	if ((expdate.value == null) || (expdate.value == '')) {
		alert('Please Select Date.');
		expdate.focus();
		return false;
	}
}

function validateCredit() {
	var id = document.getElementById('CID');
	var stud = document.getElementById('SNum');
	var credit = document.getElementById('CNum');

	if ((id.value == null) || (id.value == '')) {
		alert('Please Select Exam ID.');
		id.focus();
		return false;
	}
	if ((stud.value == null) || (stud.value == '')) {
		alert('Please Enter Student Number.');
		stud.focus();
		return false;
	}
	if ((credit.value == null) || (credit.value == '')) {
		alert('Please Enter Number of Credits.');
		credit.focus();
		return false;
	}
}

function validateSeminar(){
	var oEditor = FCKeditorAPI.GetInstance('FCKeditor1');
	var desc = oEditor.GetHTML(true);

	var date = document.getElementById('Seminar_Date');
	var place = document.getElementById('Seminar_Place');
	var address = document.getElementById('Seminar_Address');
	
	if ((date.value == null) || (date.value == '')) {
		alert('Please Enter Seminar Date');
		date.focus();
		return false;
	}
	if ((place.value == null) || (place.value == '')) {
		alert('Please Enter Seminar Location');
		place.focus();
		return false;
	}
	if ((address.value == null) || (address.value == '')) {
		alert('Please Enter Seminar Address');
		address.focus();
		return false;
	}
	
	if ((desc == null) || (desc == '')) {
		alert('Please Enter Seminar Description');
		return false;
	}
	return true;
}

function addNewCompanyKC() {

	var name = document.getElementById('name');
	var address = document.getElementById('address');
	var city = document.getElementById('city');
	var state = document.getElementById('state');
	var agency_name = document.getElementById('agency_name');

	if (name.value == null || name.value == '') {
		alert('Please Enter Company Name');
		name.focus();
		return false;
	}

	if (address.value == null || address.value == '') {
		alert('Please Enter Address');
		address.focus();
		return false;
	}

	if (city.value == null || city.value == '') {
		alert('Please Enter City');
		city.focus();
		return false;
	}

	if (state.value == null || state.value == '') {
		alert('Please Enter State');
		state.focus();
		return false;
	}

	if (agency_name.value == null || agency_name.value == '') {
		alert('Please Enter Agency Name');
		agency_name.focus();
		return false;
	}

	return true;
}

function addNewCourseKC() {
	var company_kc_id = document.getElementById('company_kc_id');
	var course_title = document.getElementById('course_title');

	var oEditor = FCKeditorAPI.GetInstance('FCKeditor1');
	var text = oEditor.GetHTML(true);

	var course_credit = document.getElementById('course_credit');
	var exam_cost = document.getElementById('exam_cost');

	if (company_kc_id.value == null || company_kc_id.value == '') {
		alert('Please select Company');
		company_kc_id.focus();
		return false;
	}

	if (course_title.value == null || course_title.value == '') {
		alert('Please Enter Course Title');
		course_title.focus();
		return false;
	}

	if ((text==null)||(text=='')) {
		alert('Please Enter Description');
		city.focus();
		return false;
	}

	if (course_credit.value == null || course_credit.value == '') {
		alert('Please Enter course Credits');
		course_credit.focus();
		return false;
	}

	if (exam_cost.value == null || exam_cost.value == '') {
		alert('Please Enter Exam Cost');
		exam_cost.focus();
		return false;
	}
	return true;
}

function promptKeycodeType(sel) {
	if (sel.value == 1) {
		document.getElementById('trainingsked_row').style.display = 'inline';
	} else {
		document.getElementById('trainingsked_row').style.display = 'none';
	}
}

function promptTrainingDates(sel) {
	if (sel == 1) {
		document.getElementById('oneDayTraining').style.display = 'inline';
		document.getElementById('twoOrMoreDaysTraining').style.display = 'none';
		document.getElementById('consecutiveDaysTraining').style.display = 'none';
	} else if (sel == 2)
	{
		document.getElementById('oneDayTraining').style.display = 'none';
		document.getElementById('twoOrMoreDaysTraining').style.display = 'inline';
		document.getElementById('consecutiveDaysTraining').style.display = 'none';
	} else{
		document.getElementById('oneDayTraining').style.display = 'none';
		document.getElementById('twoOrMoreDaysTraining').style.display = 'none';
		document.getElementById('consecutiveDaysTraining').style.display = 'inline';
	}
}