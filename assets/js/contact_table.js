function contact_process($contact_type, $accountid1, $accountid2) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {//Call a function when the state changes.
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           document.location.reload();
           alert(xmlhttp.responseText);

       }
  }
  var contact_type = $contact_type; //must predefine variable to be used in $_POST in contact_process.php
  var accountid1 = $accountid1;
  var accountid2 = $accountid2;
  xmlhttp.open("GET","add_contact.php?contact_type="+$contact_type
              +"&accountid1="+$accountid1+"&accountid2="+accountid2,true);
  xmlhttp.send();

}


function block_user($accountid1, $accountid2) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.location.reload();
          alert(xmlhttp.responseText);
      }
  }
  var accountid1 = $accountid1;
  var accountid2 = $accountid2;
  xmlhttp.open("GET", "add_block.php?accountid1="+$accountid1+"&accountid2="+accountid2, true);
  xmlhttp.send();
}


function contact_remove($contact_type,$accountid1,$accountid2) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.location.reload();
          alert(xmlhttp.responseText);
      }
  }
  var contact_type = $contact_type;
  var accountid1 = $accountid1;
  var accountid2 = $accountid2;
  xmlhttp.open("GET", "remove_contact.php?contact_type="+$contact_type+"&accountid1="+$accountid1+"&accountid2="+accountid2, true);
  xmlhttp.send();
}




function unblock_user($accountid1,$accountid2) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.location.reload();
          alert(xmlhttp.responseText);
      }
  }
  var accountid1 = $accountid1;
  var accountid2 = $accountid2;
  xmlhttp.open("GET", "unblock.php?accountid1="+$accountid1+"&accountid2="+accountid2, true);
  xmlhttp.send();
}
