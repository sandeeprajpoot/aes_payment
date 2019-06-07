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

?>