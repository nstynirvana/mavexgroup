$(document).ready(function(){
	if($('.table .row.sid').length)
	{
		$('.table .row.sid').each(function(){
			// $(this).find('.item:visible .image').sliceHeight({lineheight: -3});
			$(this).find('.item:visible .properties').sliceHeight({fixWidth: 2});
			$(this).find('.item:visible .previewtext').sliceHeight({fixWidth: 2});
			$(this).find('.item:visible .text').sliceHeight({fixWidth: 2});
		})
	}
	if($('.table.item-views .tabs a').length)
	{
		$('.table.item-views .tabs a').first().addClass('heightsliced');
		$('.table.item-views .tabs a').on('click', function() {
			if(!$(this).hasClass('heightsliced')){
				$('.table.item-views .tab-pane.active').find('.item .image').sliceHeight({lineheight: -3});
				$('.table.item-views .tab-pane.active').find('.item .properties').sliceHeight();
				$('.table.item-views .tab-pane.active').find('.item .text').sliceHeight();
				$(this).addClass('heightsliced');
			}
		});
	}

	if($('.licenses_block .item .previewtext+.button').length){
		$(document).on('click', '.licenses_block .item .previewtext+.button', function(){
			$(this).prev().css('max-height', 'inherit');
			$(this).remove();
		});

		BX.addCustomEvent('onWindowResize', function(eventdata){
			$('.licenses_block .item .previewtext+.button').each(function(){
				var $this = $(this);
				var $previewtext = $this.prev();
				var previewtextHeight = $previewtext.height();
				var $previewtextParts = $previewtext.find('>div');
				var previewtextPartsHeight = 0;
				if($previewtextParts.length){
					for(var i = 0; i < $previewtextParts.length; ++i){
						previewtextPartsHeight += $previewtextParts.eq(i).outerHeight();
					}
				}

				if(previewtextPartsHeight > previewtextHeight){
					$this.show();
				}
				else{
					$this.hide();
				}
			});
		});
	}
})