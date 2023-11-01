$(document).ready(function(){
	$('.sections.item-views.list-4 .item .opener').on('click', function(){
		openerFunc($(this), $(this).closest('.item').find('.childs'));
	});
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		$('.sections.item-views.list-4 .item .opener').on('click', function(){
			openerFunc($(this), $(this).closest('.item').find('.childs'));
		});
	});	
});