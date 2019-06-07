<?php
// Get PO Details
$ponum=@@pono_label;
$query = "SELECT sno as sno, description_label as description, itemdescription as itemdescription, quantity as quantity, unit_label as unit, rate as rate, amount as amount, discamount as discamount, sgstrate as sgstrate, sgstamount as sgstamount, cgstrate as cgstrate, cgstamount as cgstamount, igstrate as igstrate, igstamount as igstamount, itmetotal as itmetotal, hsncode as hsn FROM PO_Items_Details where poNumber = '$ponum'";
$result = executeQuery($query);
if (is_array($result) and count($result) > 0)
@=invoiceGrid = $result;

// Get Previous Payment Details
$ponum=@@pono_label;
$query = "Select  invoiceno as inino, invoiceamt as iniamt, invoidate as inidate, deduction as inidedu, taxes as initaxes,  vouchamt as inivamount, paymod as modpay, payrefno as payrefnu,caseno as precaseno FROM Payment_Details_InvoiceWise where pno = '$ponum'";
$result = executeQuery($query);
if (is_array($result) and count($result) > 0)
@=prepayment = $result;

// Get Terms and Conditions
$ponum=@@pono_label;
$query = "Select  td as tnd  FROM PMT_PO_TANDCONDI where poNumber = '$ponum'";
$result = executeQuery($query);
if (is_array($result) and count($result) > 0)
@=termancondition = $result;

// get old MRN Details to table
$mrn8=@@pono_label;
$mrn2=@@userid;

$query = "SELECT itemname as olditem, quanity as oldqty, receivedqty as oldqtyrcvd, pendingqty as oldpdqty, itemurremarks as oldusrremarks, mrnuser as oldurname, challanno as oldchlnno, challandate as oldchlndate, itemsplremarks as oldsplremarks, spcialistname as oldsplname from MRN_Table where  pono='$mrn8'";

$result = executeQuery($query);
if (is_array($result) and count($result) > 0)
@=oldmrn = $result;

// Save Payment form to database
$pofin4=mysql_real_escape_string(@@venduid_label);
$pofin5=mysql_real_escape_string(@@vname);
$pofin6=mysql_real_escape_string(@@pono_label);
$pofin7=mysql_real_escape_string(@@poamt);
$pofin8=mysql_real_escape_string(@@podate);
$pofin14=mysql_real_escape_string(@@vdremarks);
$pofin21=mysql_real_escape_string(@@invitotal);
$pofin22=mysql_real_escape_string(@@invitotdedu);
$pofin23=mysql_real_escape_string(@@invitottax);
$pofin24=mysql_real_escape_string(@@invitotvouch);
$pofin15=mysql_real_escape_string(@@poamt1);
$pofin16=mysql_real_escape_string(@@totcrinvoice);
$pofin17=mysql_real_escape_string(@@totprinnoice);
$pofin19=mysql_real_escape_string(@@prededu);
$pofin18=mysql_real_escape_string(@@pretds);
$pofin20=mysql_real_escape_string(@@balaftpay);
$pofin28=mysql_real_escape_string(@@billvrremarks);
$pofin40="";
$pofin34=mysql_real_escape_string(@@actremarks);
$pofin35=mysql_real_escape_string(@@hdactremarks);
$pofin30=mysql_real_escape_string(@@audtremarks);
$pofin37=mysql_real_escape_string(@@hdauditremarks);
$pofin32=mysql_real_escape_string(@@mmbremarks);
$pofin33=mysql_real_escape_string(@@mmbaction_label);
$pofin38=mysql_real_escape_string(@@caseno);
$pofin9=mysql_real_escape_string(@@idntnoo);
$pofin10=mysql_real_escape_string(@@idntdatee);
$pofin11=mysql_real_escape_string(@@idntname);
$pofin12=mysql_real_escape_string(@@idntid);
$pofin26=mysql_real_escape_string(@@apremarks);
$pofin39=mysql_real_escape_string(@@billtouid);
$pofin41=mysql_real_escape_string(@@billto);


$query = "INSERT INTO Payment_Invoice_Form
(venduid,vname,pono,poamt,podate,vdremarks,invitotal,invitotdedu,invitottax,invitotvouch,poamt1,totcrinvoice,totprinnoice,prededu,pretds,balamnt,billvrremarks,buremarks,actremarks,hdactremarks,audtremarks,hdauditremarks,mmbremarks,mmbaction,caseno,idntnoo,idntdatee,idntname,idntid,apremarks,billtouid,billto) VALUES
('$pofin4','$pofin5','$pofin6','$pofin7','$pofin8','$pofin14','$pofin21','$pofin22','$pofin23','$pofin24','$pofin15','$pofin16','$pofin17','$pofin19','$pofin18','$pofin20','$pofin28','$pofin40','$pofin34','$pofin35','$pofin30','$pofin37','$pofin32','$pofin33','$pofin38','$pofin9','$pofin10','$pofin11','$pofin12','$pofin26','$pofin39','$pofin41')";
executeQuery($query);

// save Payment Details to database
$pofin38=mysql_real_escape_string(@@caseno);
$pofin39=mysql_real_escape_string(@@billtouid);
$pofin41=mysql_real_escape_string(@@billto);
foreach (@=invoicedetail as $row){
$pfgd2=mysql_real_escape_string($row['pno']);
$pfgd3=mysql_real_escape_string($row['invoiceno']);
$pfgd4=mysql_real_escape_string($row['invoiceamt']);
$pfgd5=mysql_real_escape_string($row['invoidate']);
$pfgd6=mysql_real_escape_string($row['deduction']);
$pfgd7=mysql_real_escape_string($row['taxes']);
$pfgd8=mysql_real_escape_string($row['vochno']);
$pfgd9=mysql_real_escape_string($row['vouchamt']);
$pfgd10=mysql_real_escape_string($row['paymod_label']);
$pfgd11=mysql_real_escape_string($row['payrefno']);
$pfgd12=mysql_real_escape_string($row['podno']);

$query = "INSERT INTO Payment_Details_InvoiceWise
(pno,invoiceno,invoiceamt,invoidate,deduction,taxes,vochno,vouchamt,paymod,payrefno,caseno,podno,billtouid,billto) 
VALUES 
('$pfgd2','$pfgd3','$pfgd4','$pfgd5','$pfgd6','$pfgd7','$pfgd8','$pfgd9','$pfgd10','$pfgd11','$pofin38','$pfgd12','$pofin39','$pofin41')";
executeQuery($query);
}

// Update PO status if Balance amount is less then Zero
$poamt=@@balaftpay;
 $ponum=@@pono_label;
if ($poamt<=0) {
$query="UPDATE Purchase_order_Approval_Details SET postatus = 'Closed' where poNumber ='$ponum'";
}
else {
$query="UPDATE Purchase_order_Approval_Details SET postatus = 'Open' where poNumber ='$ponum'";
}
executeQuery($query);

//Update Delivery Details if Balance amount is less then Zero
$poamt=@@balaftpay;
 $ponum=@@pono_label;
if ($poamt<=0) {
$query="UPDATE Delivery_Details SET postatus = 'Closed' where poNumber ='$ponum'";
}
else {
$query="UPDATE Delivery_Details SET postatus = 'Open' where poNumber ='$ponum'";
}
executeQuery($query);

// update payrefrence no
$pofin38=mysql_real_escape_string(@@caseno);
foreach (@=invoicedetail as $row){
$pfgd3=mysql_real_escape_string($row['invoiceno']);
$pfgd11=mysql_real_escape_string($row['payrefno']);
$pfgd10=mysql_real_escape_string($row['paymod']);
$pfgd101=mysql_real_escape_string($row['paymod']);
$pfgd102=mysql_real_escape_string($row['paymod']);

if ($pfgd10==01 || $pfgd101==02 || $pfgd102==05) {
	$paystat='Open';
}
	else {
		$paystat='Closed';
	}

$query = "UPDATE Payment_Details_InvoiceWise set  payrefno =  '$pfgd11',  PaymentStatus = '$paystat' where caseno = '$pofin38' and invoiceno='$pfgd3'";
executeQuery($query);
}

// update POD no
$pofin38=mysql_real_escape_string(@@caseno);
foreach (@=invoicedetail as $row){
$pfgd3=mysql_real_escape_string($row['invoiceno']);
$pfgd12=mysql_real_escape_string($row['podno']);

$query = "UPDATE Payment_Details_InvoiceWise set  podno =  '$pfgd12' where caseno = '$pofin38' and invoiceno='$pfgd3'";
executeQuery($query);
}

// update Voucher Number
$pofin38=mysql_real_escape_string(@@caseno);
foreach (@=invoicedetail as $row){
$pfgd3=mysql_real_escape_string($row['invoiceno']);
$pfgd8=mysql_real_escape_string($row['vochno']);

$query = "UPDATE Payment_Details_InvoiceWise set  vochno =  '$pfgd8' where caseno = '$pofin38' and invoiceno='$pfgd3'";
executeQuery($query);
}

// Upadate accounts remarks
$pofin38=mysql_real_escape_string(@@caseno);
$pofin6=mysql_real_escape_string(@@pono_label);
$pofin34=mysql_real_escape_string(@@actremarks);	

$query = "UPDATE Payment_Invoice_Form set  actremarks =  '$pofin34' where caseno = '$pofin38'";
executeQuery($query);

// Upadate HOD accounts remarks
$pofin38=mysql_real_escape_string(@@caseno);
$pofin6=mysql_real_escape_string(@@pono_label);
$pofin35=mysql_real_escape_string(@@hdactremarks);	

$query = "UPDATE Payment_Invoice_Form set  hdactremarks =  '$pofin35' where caseno = '$pofin38'";
executeQuery($query);


// Upadate Final Audit remarks
$pofin38=mysql_real_escape_string(@@caseno);
$pofin6=mysql_real_escape_string(@@pono_label);
$pofin37=mysql_real_escape_string(@@hdauditremarks);	

$query = "UPDATE Payment_Invoice_Form set  hdauditremarks =  '$pofin37' where caseno = '$pofin38'";
executeQuery($query);

// Update PO status if PO status has been changed by Audit
$poamt=@@balaftpay;
$postat=@@postatus;
$ponum=@@pono_label;
if ($postat==01) {
$query="UPDATE Purchase_order_Approval_Details SET postatus = 'Closed' where poNumber ='$ponum'";
}
else {
$query="UPDATE Purchase_order_Approval_Details SET postatus = 'Open' where poNumber ='$ponum'";
}
executeQuery($query);

// Update   Delivery Details if PO status has been changed by Audit
$poamt=@@balaftpay;
$postat=@@postatus;
 $ponum=@@pono_label;
if ($postat==01) {
$query="UPDATE Delivery_Details SET postatus = 'Closed' where poNumber ='$ponum'";
}
else {
$query="UPDATE Delivery_Details SET postatus = 'Open' where poNumber ='$ponum'";
}
executeQuery($query);

?>