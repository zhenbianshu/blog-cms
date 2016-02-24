function logVisitor()
{
	$("#visitor_form").css('display','block');
	$.get(nameAddress,function(data){
		$('#visitor-name').val(data);
	});	
}

function closeLog()
{
	$("#visitor_form").css('display','none');
}

function conSub()
{
	if($("#comment_content").val().trim()=='')
	{
		return false;
	}else{
		document.getElementById('mycomment').submit();
	}
}