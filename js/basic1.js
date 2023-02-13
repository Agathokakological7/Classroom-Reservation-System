function updategroupprice(vall,gid){
	 
	var formData = {price:vall};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: base_url + "index.php/user/update_group/"+gid,
		success: function(data){
		$("#message").html(data);
			
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
	
}