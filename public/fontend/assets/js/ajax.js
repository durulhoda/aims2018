function getCommonChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="admissionsessiontoall"){
		getValue(id,option,"#programid",1);
		getValue(id,option,"#groupid",2);
		getValue(id,option,"#mediumid",3);
		getValue(id,option,"#shiftid",4);
	}
}
function getCommonChangeWithSession(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="programofferviewtogroup"){
		getValueWithSession(id,option,"#groupid",1);
	}
}
function getValue(id,option,output,methodid){
	var instituteid=$("#instituteid").val();
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "/getValue",
		dataType: "html",
		data: {'instituteid':instituteid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
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
		url: "/getValueWithSession",
		dataType: "html",
		data: {'instituteid':instituteid,'sessionid':sessionid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
			$(output).empty().append(result);
		}
	});
}