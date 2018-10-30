	
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