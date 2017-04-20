jQuery(document).ready(function($){
	if($("#jformparent")){
		$("#jformparent").change(function(){
			$("#jform_parent").val($("#jformparent").val());
		});
	}
	
});