$(document).ready(function(){
	$(document).on('click', '.item-views.services-items .menu li span', function(){
		var _this = $(this),
			_thisText = _this.text();
			
		if(!_this.parent().hasClass('selected')){
			var index = _this.parent().index(),
				animationTime = (window.matchMedia('(max-width: 767px)').matches ? 0 : 200);
			
			_this.closest('ul').find('li').removeClass('selected');
			_this.parent().addClass('selected');
			
			_this.closest('.item-views').find('.items .item').fadeOut(animationTime);
			setTimeout(function(){
				_this.closest('.item-views').find('.items .item').eq(index).fadeIn(animationTime);
			}, animationTime);
		}
		
		_this.closest('.left_block').find('.menu_item_selected').text(_thisText);
	});
	
	$(document).on('click', '.item-views.services-items .arrows .arrow', function(){
		var _this = $(this),
			maxElementIndex = _this.closest('.items').find('.item').length - 1,
			activeElementIndex = _this.closest('.item').index();
			
		if(_this.hasClass('next')){
			var newActiveElementIndex = (activeElementIndex + 1 > maxElementIndex ? 0 : activeElementIndex + 1);
			
		}
		else if(_this.hasClass('prev')){
			var newActiveElementIndex = (activeElementIndex - 1 < 0 ? maxElementIndex : activeElementIndex - 1);
		}
		
		_this.closest('.item-views').find('.menu li').eq(newActiveElementIndex).find('span').click();
	});
	
	// $(document).on('click', '.item-views.services-items .menu_item_selected', function(e){
	// 	e.stopPropagation();
	// 	var _this = $(this);
		
	// 	_this.toggleClass('opened');
	// 	_this.closest('.left_block').find('.menu').slideToggle(200);
	// });
	
	$(document).on('click', 'body', function(){
		if(window.matchMedia('(max-width: 767px)').matches){
			$('.item-views.services-items .left_block .menu_item_selected').removeClass('opened');
			$('.item-views.services-items .left_block .menu').slideUp(200);
		}
	});
});