	
function cascadeAction(){
	getPrograms()
	getGroupByLevel();
}
function getPrograms(){
	var id = $("#groupid").val();
	$.ajax({
		type:'get',
		url: "/getPrograms",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#programid" ).empty().append(result);
		}
	});
}
function getGroupByLevel(){
	var id = $("#programLevelid").val();
	$.ajax({
		type:'get',
		url: "/getGroupByLevel",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#groupid" ).empty().append(result);
		}
	});
}


function getCourse(){
	var id = $("#subjectcodeid").val();
	$.ajax({
		type:'get',
		url: "/getCourse",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#subjectcode" ).empty().append(result);
		}
	});
}



function getDistbydivision(){
	var id = $("#divisionid").val();
	$.ajax({
		type:'get',
		url: "/getdistrict",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#districtid" ).empty().append(result);
		}
	});
}
function getThanabydistrict(){
	var id = $("#districtid").val();
	$.ajax({
		type:'get',
		url: "/getthana",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#thanaid" ).empty().append(result);
		}
	});
}
function postofficeAndUnion(argument) {
	getPostOfficebyThana();
	getPostOfficebyUnion();
}
function getPostOfficebyThana(){
	var id = $("#thanaid").val();
	$.ajax({
		type:'get',
		url: "/getpostoffice",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#postofficeid" ).empty().append(result);
		}
	});
}
function getPostOfficebyUnion(){
	var id = $("#thanaid").val();
	$.ajax({
		type:'get',
		url: "/getunion",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#localgovid" ).empty().append(result);
		}
	});
}

function getOwnRole(value){
	var id = value.value;
	console.log(id);
	$.ajax({
		type:'get',
		url: "/getOwnRole",
		dataType: "html",
		data: {'id' : id},
		success: function( result ) {
			$( "#output" ).empty().append(result);
		}
	});
}
function editRolePower(){
	var id = $("#id").val();
	var rolecreatorid = $("#rolecreatorid").val();
	$.ajax({
		type:'get',
		url: "/editRolePower",
		dataType: "html",
		data: {'id' : id,'rolecreatorid':rolecreatorid},
		success: function( result ) {
			$( "#output" ).empty().append(result);
		}
	});
}
function createRolePower(){
	var rolecreatorid = $("#rolecreatorid").val();
	$.ajax({
		type:'get',
		url: "/createRolePower",
		dataType: "html",
		data: {'rolecreatorid':rolecreatorid},
		success: function( result ) {
			$( "#output" ).empty().append(result);
		}
	});
}
function actionForQuota(){
	var rolefrom=$("#rolefrom").val();
	$.ajax({
		type:'get',
		url: "/actionForQuota",
		dataType: "html",
		data: {'rolefrom':rolefrom},
		success: function( result ) {
			$( "#quotaoutput" ).empty().append(result);
		}
	});
}
function actionForParentRole(){
	var rolefrom=$("#rolefrom").val();
	actionForQuota();
	$.ajax({
		type:'get',
		url: "/actionForParentRole",
		dataType: "html",
		data: {'roleid':rolefrom},
		success: function( result ) {
			$( "#roleid" ).empty().append(result);
		}
	});
}
// For Role Quota Edit Page
function quotaActionBetweenRole(rolecreatorid,roleid){
	console.log(rolecreatorid);
	console.log(roleid);
	$.ajax({
		type:'get',
		url: "/quotaActionBetweenRole",
		dataType: "html",
		data: {'rolefrom':rolecreatorid,'roleto':roleid},
		success: function( result ) {
			$( "#quotaoutput" ).empty().append(result);
		}
	});
}
function actionFrom(){
	var roleto;
	var rolefrom=$("#rolefrom").val();
	$.ajax({
		type:'get',
		url: "/actionForParentRole",
		dataType: "html",
		data: {'roleid':rolefrom},
		success: function( result ) {
			$( "#roleid" ).empty().append(result);
			roleto=$("#roleid").val();
			quotaActionBetweenRole(rolefrom,roleto);
		}
	});
}
function actionTo(){
	var rolefrom=$("#rolefrom").val();
	var roleto=$("#roleid").val();
	quotaActionBetweenRole(rolefrom,roleto);
}
function getCommonChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="programgroup"){
		getValue(id,option,"#programid",1);
		getValue(id,option,"#groupid",2);
	}else if(option=="levelprogram"){
		getValue(id,option,"#programid",1);
		getValue(id,option,"#programlevelid",2);
	}else if(option=="programofferview"){
		getValue(id,option,"#sessionid",1);
		getValue(id,option,"#programid",2);
		getValue(id,option,"#groupid",3);
		getValue(id,option,"#mediumid",4);
		getValue(id,option,"#shiftid",5);
	}else if(option=="admissionprogram"){
		getValue(id,option,"#sessionid",1);
		getValue(id,option,"#programid",2);
		getValue(id,option,"#groupid",3);
		getValue(id,option,"#mediumid",4);
		getValue(id,option,"#shiftid",5);
	}else if(option=="programtogroup"){
		getValue(id,option,"#groupid",1);
	}else if(option=="admissionprogramtogroup"){
		console.log(id);
	}
}
function getValue(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	var instituteid=$("#instituteid").val();
	$.ajax({
		type:'get',
		url: "/getValue",
		dataType: "html",
		data: {'instituteid':instituteid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}


