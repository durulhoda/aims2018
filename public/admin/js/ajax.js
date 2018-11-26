	
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
	console.log(rolecreatorid);
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