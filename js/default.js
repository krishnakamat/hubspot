function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function setLocation(url){
    window.location.href = url;
}
/**
function detectPopupBlocker() {
  var popupBlockerTest = window.open("about:blank","","directories=no,height=100,width=100,menubar=no,resizable=no,scrollbars=no,status=no,titlebar=no,top=0,location=no");
  if (!popupBlockerTest) {
    if (confirm("A popup blocker was detected.  Please turn off or disable your popup blocker, or add our site to the allowed sites lists, to use our online services.  Instructions for turning off your popup blocker can be found at http://www.rcmexaminations.org/Disable_Pop-up_Blocking_Software.htm. Would you like to open up the instruction page now?")) {
      window.location = "index1.html";
    }
  } else {
    popupBlockerTest.close();
    //No popup blocker was detected
  }
}
window.onload = detectPopupBlocker;

**/

function openLocation(url){
    window.open(url);
}

function submitform()
{
  document.pager.submit();
}