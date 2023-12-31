$(document).ready(function(){
	$(document).on('click', '.confirm_region .aprove', function(){
		var _this = $(this);
		$.removeCookie('current_region');

		if(arPriorityOptions['SITE_ADDRESS'].indexOf(',') != '-1'){
			var arDomains = arPriorityOptions['SITE_ADDRESS'].split(',');
			if(arDomains){
				for(var i in arDomains){
					var domain_name = arDomains[i].replace("\n", "");
					domain_name = arDomains[i].replace("'", "");
					$.cookie('current_region', _this.data('id'), {path: '/',domain: domain_name});
				}
			}
		}
		else{
			$.cookie('current_region', _this.data('id'), {path: '/',domain: arPriorityOptions['SITE_ADDRESS']});
		}

		$('.confirm_region').remove();
		if(typeof _this.data('href') !== 'undefined'){
			location.href = _this.data('href');
		}
	});

	$(document).on('click', '.js_city_change', function(){
		var _this = $(this);
		$('.region_wrapper .dropdown').fadeIn(100);
		if(_this.closest('.top_mobile_region').length){
			$('.burger').click();
			$('.mobile_regions > ul > li > a').click()
		}
		$('.confirm_region').remove();
	});

	$(document).on('click', '.js_city_chooser', function(){
		var _this = $(this);
		$('.confirm_region').remove();
		_this.closest('.region_wrapper').find('.dropdown').fadeToggle(100);
	});

	// $(document).on('mousedown', '.region_wrapper *', function(e){
	// 	e.stopPropagation();
	// });

	$(document).on('click', '.region_wrapper .more_item:not(.current) span', function(){
		$.removeCookie('current_region');
		if(arPriorityOptions['SITE_ADDRESS'].indexOf(',') != '-1'){
			var arDomains = arPriorityOptions['SITE_ADDRESS'].split(',');
			if(arDomains){
				for(var i in arDomains){
					var domain_name = arDomains[i].replace("\n", "");
					domain_name = arDomains[i].replace("'", "");
					$.cookie('current_region', $(this).data('region_id'), {path: '/',domain: domain_name});
				}
			}
		}
		else{
			$.cookie('current_region', $(this).data('region_id'), {path: '/',domain: arPriorityOptions['SITE_ADDRESS']});
		}

		location.href = $(this).data('href');
	});

	/* close search block */
	$("html, body").on('mousedown', function(e){
		e.stopPropagation();
		if(!$(e.target).hasClass('dropdown')){
			$('.region_wrapper .dropdown').fadeOut(100);
		}
	});

	$('.region_wrapper').find('*').on('mousedown', function(e){
        e.stopPropagation();
    });

    $(".region_wrapper .dropdown .wrap").mCustomScrollbar({
		mouseWheel: {scrollAmount: 100,},
	});

	$(document).on('click', '.regionConfirmClose', function(){
		var _this = $(this);
		_this.closest('.region_wrapper').find('.confirm_region').remove();
		_this.closest('.top_mobile_region').find('.confirm_wrapper').remove();

		if(arPriorityOptions['SITE_ADDRESS'].indexOf(',') != '-1')
		{
			var arDomains = arPriorityOptions['SITE_ADDRESS'].split(',');
			if(arDomains)
			{
				for(var i in arDomains)
				{
					var domain_name = arDomains[i].replace("\n", "");
					domain_name = arDomains[i].replace("'", "");
					$.cookie('current_region', _this.data('id'), {path: '/',domain: domain_name});
				}
			}
		}
		else
			$.cookie('current_region', _this.data('id'), {path: '/',domain: arPriorityOptions['SITE_ADDRESS']});

	});

});