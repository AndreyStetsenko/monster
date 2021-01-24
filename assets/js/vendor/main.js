jQuery(document).ready(function($){
	$('.search-field').keypress(function(eventObject){
		var searchTerm = $(this).val();
		// проверим, если в поле ввода более 2 символов, запускаем ajax
		if(searchTerm.length > 2){
			$.ajax({
				url : '/wp-admin/admin-ajax.php',
				type: 'POST',
				data:{
					'action':'codyshop_ajax_search',
					'term'  :searchTerm
				},
				success:function(result){
					$('.codyshop-ajax-search').fadeIn().html(result);
				}
			});
		}
	});

	// $('.navbar-toggler').on('click', function() {
	// 	$('.navbar-collapse').toggle();
	// 	$('.navbar-collapse.collapse').toggle();
	// });
});
