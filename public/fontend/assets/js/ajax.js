function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="divisionToDistrict"){
		getValue(id,option,"#districtid",1);
		getValue(0,option,"#thanaid",2);
		getValue(0,option,"#postofficeid",3);
		getValue(0,option,"#localgovid",4);
	}else if(option=="districtToThana"){
		getValue(id,option,"#thanaid",1);
		getValue(0,option,"#postofficeid",2);
		getValue(0,option,"#localgovid",3);
	}else if(option=="thanaToPostoffice"){
		getValue(id,option,"#postofficeid",1);
		getValue(id,option,"#localgovid",2);
	}else if(option=="divisionToDistrict2"){
		// For Permanent Address
		getValue(id,option,"#districtid2",1);
		getValue(0,option,"#thanaid2",2);
		getValue(0,option,"#postofficeid2",3);
		getValue(0,option,"#localgovid2",4);
	}else if(option=="districtToThana2"){
		getValue(id,option,"#thanaid2",1);
		getValue(0,option,"#postofficeid2",2);
		getValue(0,option,"#localgovid2",3);
	}else if(option=="thanaToPostoffice2"){
		getValue(id,option,"#postofficeid2",1);
		getValue(id,option,"#localgovid2",2);
	}else if(option=="admissionsessiontoall"){
		getValueWithIstitute(id,option,"#programid",1);
		getValueWithIstitute(id,option,"#groupid",2);
		getValueWithIstitute(id,option,"#mediumid",3);
		getValueWithIstitute(id,option,"#shiftid",4);
	}else if(option=="programofferviewtogroup"){
		getValueWithSession(id,option,"#groupid",1);
	}
}
// For School Admission Form
function getValue(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "/getValue2",
		dataType: "html",
		data: {'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getValueWithIstitute(id,option,output,methodid){
	var instituteid=$("#instituteid").val();
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "/getValueWithIstitute",
		dataType: "html",
		data: {'instituteid':instituteid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getValueWithSession(id,option,output,methodid){
	var instituteid=$("#instituteid").val();
	var sessionid=$("#sessionid").val();
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "/getValueWithSession2",
		dataType: "html",
		data: {'instituteid':instituteid,'sessionid':sessionid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
/////////////////////////////

