$(document).ready(function(){
	$('.sections.item-views.section-12 .item .opener').on('click', function(){
		openerFunc($(this), $(this).closest('.item').find('.childs'));
	});
});