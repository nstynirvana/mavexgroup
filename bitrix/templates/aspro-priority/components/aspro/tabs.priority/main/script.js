$(document).ready(function(){
	var tabs = $('.tabs_ajax__top-block .tabs');
	//InitScrollBar(tabs);

	$('.tabs_ajax__head-block').scrollTab({
		tabs_wrapper: '.scroll-tabs-wrapper',
		arrows_css: {
			'top': '-1px',
		},
		width_grow: 3,
		onResize: function(options) {
			var top_wrapper = options.scrollTab.closest('.tabs_ajax__top-block');
			if(top_wrapper.length) {
				var tabs_wrapper = top_wrapper.find('.tabs_ajax__head-block');

				if(window.matchMedia('(max-width: 767px)').matches){
					tabs_wrapper.css({
						'width': '100%',
						'max-width': '',
					});
					return true;
				}

				var title = top_wrapper.find('h2');
				var right_link = top_wrapper.find('a.show_all');
				var all_width = top_wrapper[0].getBoundingClientRect().width;

				if(title.length) {
					all_width -= title.outerWidth(true);
				}

				if(right_link.length) {
					all_width -= right_link.outerWidth(true);
				}

				all_width -= Number.parseInt(tabs_wrapper.css('margin-right'));

				tabs_wrapper.css({
					'max-width': all_width,
					'width': '',
				});
			}
			options.width = all_width;
		}
	});



	/*if(tabs.length) {
		BX.addCustomEvent('onWindowResize', function(eventdata){
			try{
				if(window.matchMedia('(min-width: 768px)').matches) {
					var title_width = $('.tabs_ajax__top-block h2').outerWidth(true);
					var show_all_width = $('.tabs_ajax__top-block .show_all').outerWidth(true);
		
					tabs.css({
						left: title_width,
						right: show_all_width,
					});
					tabs.show();
				}
				
			}
			catch(e){console.log(e);}
		});
	}*/



});