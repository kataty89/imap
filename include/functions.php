<?php
include 'config.php';
error_log(json_encode($_POST)); 
$val = $_POST["param"];
header('Content-Type: application/json; charset=utf-8');



switch($val){
   case 'get_emails': get_emails($imapPath,$username,$password);break;
   case 'delete_email': delete_email($imapPath,$username,$password,$_POST["id"]);break;
}

function delete_email($imapPath,$username,$password,$id){
   $imap = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
   imap_delete($imap, $id);
   imap_expunge($imap);
   imap_close($imap);
   get_emails($imapPath,$username,$password);
}


function get_emails($imapPath,$username,$password){
   // try to connect 
   $inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

   $emails = imap_search($inbox,'ALL');


   $data = array();
   $i = 1;
   foreach($emails as $mail) {
      
      $headerInfo = imap_headerinfo($inbox,$mail);

      
      $emailStructure = imap_fetchstructure($inbox,$mail);
      

         $data[] = array(
            "Id"=>$i,
            "Name"=> $headerInfo->fromaddress,
            "Subject"=> $headerInfo->subject,
            "Time"=> $headerInfo->date,
            "body"=> imap_body($inbox, $mail, FT_PEEK),
            "to"=> $headerInfo->toaddress,
            "reply"=> $headerInfo->reply_toaddress
         );
     
      $i++;
   }

   // colse the connection
   imap_expunge($inbox);
   imap_close($inbox);
   //$data = array("data"=>$data);
   echo json_encode($data);
}
