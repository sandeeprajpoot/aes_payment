$("#apaction").find("div.radio").addClass("radio-inline");
$("#bilaction").find("div.radio").addClass("radio-inline");
$("#actaction").find("div.radio").addClass("radio-inline");
$("#hdactaction").find("div.radio").addClass("radio-inline");
$("#auditaction").find("div.radio").addClass("radio-inline");
$("#hdauditaction").find("div.radio").addClass("radio-inline");
$("#mmbaction").find("div.radio").addClass("radio-inline");
$("#postatus").find("div.radio").addClass("radio-inline");

postatus
// hide unused raudio buttons
function hideunsed (){
    $($("#auditaction").find("div.radio")[2]).hide();
}
hideunsed ();

$("form").setOnchange(function(field, newVal, oldVal){
    var poa = $('#pono').getText();
    var totalRows = $("#invoicedetail").getNumberRows();
    for (var i = 1; i <= totalRows; i++) {
    var paymode = parseFloat($("#invoicedetail").getValue(i, 9));
    var inviamt1 = parseFloat($("#invoicedetail").getValue(i, 3));
	var invided1 = parseFloat($("#invoicedetail").getValue(i, 5));
	var invitds1 = parseFloat($("#invoicedetail").getValue(i, 6))
    $("#invoicedetail").setValue(poa,   i, 1); 
    var inviamt = roundToFixed(inviamt1, 2);
	var invided = roundToFixed(invided1, 2);
	var invitds = roundToFixed(invitds1, 2);
    $("#invoicedetail").setValue(inviamt,  i, 3);
  	$("#invoicedetail").setValue(invided,   i, 5);
	$("#invoicedetail").setValue(invitds,   i, 6);
    var ab4 = parseFloat($("#invoicedetail").getValue(i, 3));
    var ab5 = parseFloat($("#invoicedetail").getValue(i, 5));
    var ab6 = parseFloat($("#invoicedetail").getValue(i, 6));
    var payamt = roundToFixed((ab4-(ab5+ab6)),2);
	$("#invoicedetail").setValue(payamt, i, 8);
    if (paymode==03){
    $('#invoicedetail').getControl(i,10).attr('required', true);	    
    }
    else {
    $('#invoicedetail').getControl(i,10).attr('required', false);
    }
    }
  });

// Hide Accouting Entries from Bill Verification and AP
function hidactentry() {
         $("#invoicedetail").hideColumn(7); // hide voucher no at AP and BIll verification
         //$("#invoicedetail").hideColumn(10); // hide Payref NO Number at AP 1 and Bill Verification
        $("#invoicedetail").hideColumn(11); // hide POD Number show at dispatch only
}
hidactentry();

// Hide HOD-Accounts and Taxation Review
function HACTvisible() {
	var hactvis1 = $('#hdactaction').getValue();
	var hactvis2 = $('#hdactaction').getValue();
	if (hactvis1 == 01 || hactvis2 == 02) {
		$('#hdactaction').show();
		$('#hdactremarks').show();
		$('#title0000000005').show();
	}
	else {
		$('#hdactaction').hide();
		$('#hdactremarks').hide();
		$('#title0000000005').hide();

	}
}
HACTvisible();

// Hide Audit Review
function AUDvisible() {
	var audtvis1 = $('#auditaction').getValue();
	var audtvis2 = $('#auditaction').getValue();
	var audtvis3 = $('#auditaction').getValue();
	if (audtvis1 == 01 || audtvis2 == 02 || audtvis3 == 03) {
		$('#auditaction').show();
		$('#audtremarks').show();
		$('#title0000000006').show();
	}
	else {
		$('#auditaction').hide();
		$('#audtremarks').hide();
		$('#title0000000006').hide();

	}
}
AUDvisible();

// Hide HOD Audit Review
function HAUDvisible() {
	var haudtvis1 = $('#hdauditaction').getValue();
	var haudtvis2 = $('#hdauditaction').getValue();
	if (haudtvis1 == 01 || haudtvis2 == 02) {
		$('#hdauditaction').show();
		$('#hdauditremarks').show();
		$('#title0000000007').show();
	}
	else {
		$('#hdauditaction').hide();
		$('#hdauditremarks').hide();
		$('#title0000000007').hide();

	}
}
HAUDvisible();

// Hide Management Review
function MMBvisible() {
	var mmbvis1 = $('#mmbaction').getValue();
	var mmbvis2 = $('#mmbaction').getValue();
    var mmbvis3 = $('#mmbaction').getValue();
	if (mmbvis1 == 01 || mmbvis2 == 02 ||  mmbvis3 == 03) {
		$('#mmbaction').show();
		$('#mmbremarks').show();
		$('#title0000000008').show();
	}
	else {
		$('#mmbaction').hide();
		$('#mmbremarks').hide();
		$('#title0000000008').hide();

	}
}
MMBvisible();

// hide accounts (voucher creation)
function hideact(){
    $('#actremarks').hide();
    $('#title0000000004').hide();
}
hideact();

// Hide Bill Verificaiton
function bilvefvisible() {
	var bilvefvis1 = $('#bilaction').getValue();
	var bilvefvis2 = $('#bilaction').getValue();
  	var bilvefvis3 = $('#bilaction').getValue();
    	if (bilvefvis1 == 01 || bilvefvis2 == 02 || bilvefvis3==03) {
		$('#bilaction').show();
		$('#billvrremarks').show();
		$('#title0000000009').show();
        $('#billsupport').show();
	}
	else {
		$('#bilaction').hide();
		$('#billvrremarks').hide();
		$('#title0000000009').hide();
        $('#billsupport').hide();

	}
}
bilvefvisible();

function roundToFixed(_float, _digits){
  var rounder = Math.pow(10, _digits);
  return (Math.round(_float * rounder) / rounder).toFixed(_digits);
}


// calculate Balance Amount of PO (to be used at accounts payable Step)
function checkpayment() {
    var inviamt = parseFloat($("#invoicedetail").getSummary("invoiceamt"));
    var prvchamt = parseFloat($("#prepayment").getSummary("inivamount"));
    var prdid = parseFloat($("#prepayment").getSummary("inidedu"));
    var prtds = parseFloat($("#prepayment").getSummary("initaxes"));
    var amtpo = parseFloat($("#invoiceGrid").getSummary("itmetotal"));
    if(isNaN(inviamt)) {
		document.getElementById('form[totcrinvoice]').value=0;
	}
	else {  
	  document.getElementById('form[totcrinvoice]').value=roundToFixed(inviamt, 2);
	}
    if(isNaN(prvchamt)) {
		document.getElementById('form[totprinnoice]').value=0;
	}
	else {  
	  document.getElementById('form[totprinnoice]').value=roundToFixed(prvchamt, 2);
	}
     if(isNaN(prdid)) {
		document.getElementById('form[prededu]').value=0;
	}
	else {  
	  document.getElementById('form[prededu]').value=roundToFixed(prdid, 2);
	}
     if(isNaN(prtds)) {
		document.getElementById('form[pretds]').value=0;
	}
	else {  
	  document.getElementById('form[pretds]').value=roundToFixed(prtds, 2);
	}
     if(isNaN(amtpo)) {
		document.getElementById('form[poamt1]').value=0;
	}
	else {  
		document.getElementById('form[poamt1]').value=roundToFixed(amtpo, 2);
	}
  // if value of previous payment is more than PO amount close the case
    var prepayment = (prvchamt+prtds);
	if (prepayment >= amtpo) {
      	$($("#apaction").find("div.radio")[0]).hide();
      	alert (" Total Payment amount exceeds PO amount");
	}
    else {
      	$($("#apaction").find("div.radio")[0]).show();
      	}
  
  	var balance =roundToFixed((amtpo)-(prvchamt+prtds),2);
  	$('#balamnt').setValue(balance);
	//document.getElementById('form[balamnt]').value=((amtpo)-(prvchamt+prtds));	
  	
 }
checkpayment();


// hide few Details
function hidfew(){
    $('#totcrinvoice').hide();
    $('#idntid').hide();
    $('#billtouid').hide();
}
hidfew();

// calucation for total amounts (to be used at accounts step)
$("#8024795395c3b3335ae4e94003124890").mouseover(function(field, newValue, oldValue) {
    var inviamt = parseFloat($("#invoicedetail").getSummary("invoiceamt"));
    var indid = parseFloat($("#invoicedetail").getSummary("deduction"));
    var intds = parseFloat($("#invoicedetail").getSummary("taxes"));
    var invoamt = parseFloat($("#invoicedetail").getSummary("vouchamt"));
    var amtpo = parseFloat($("#invoiceGrid").getSummary("itmetotal"));
    var prvchamt = parseFloat($("#prepayment").getSummary("inivamount"));
    var prtds = parseFloat($("#prepayment").getSummary("initaxes"));
    if(isNaN(inviamt)) {
		document.getElementById('form[invitotal]').value=0;
	}
	else {  
		document.getElementById('form[invitotal]').value=roundToFixed(inviamt, 2);
	}
    if(isNaN(indid)) {
		document.getElementById('form[invitotdedu]').value=0;
	}
	else {  
		document.getElementById('form[invitotdedu]').value=roundToFixed(indid, 2);
	}
        if(isNaN(intds)) {
		document.getElementById('form[invitottax]').value=0;
	}
	else {  
		document.getElementById('form[invitottax]').value=roundToFixed(intds, 2);
	}
    if(isNaN(invoamt)) {
		document.getElementById('form[invitotvouch]').value=0;
	}
	else {  
		document.getElementById('form[invitotvouch]').value=roundToFixed(invoamt, 2);
	}
    var balance =roundToFixed((amtpo)-(prvchamt+prtds+invoamt+intds),2);
  	$('#balaftpay').setValue(balance);
  	//document.getElementById('form[balaftpay]').value=((amtpo)-(prvchamt+prtds+invoamt+intds));	
});

totcrinvoice

getFormById("8024795395c3b3335ae4e94003124890").el.onsubmit = function() {
	var invoice = parseFloat($("#invoicedetail").getSummary("invoiceamt"));
	var voucher = parseFloat($("#invoicedetail").getSummary("vouchamt"));
    var total = parseFloat($("#balaftpay").getValue());
	if (voucher > invoice || total <0 ) {
		alert (" Payment Amount Cannot be more than Invoice Amount/ Balance amount is negative");
	return false; //stop submit
	}
	return true;  //allow submit
}