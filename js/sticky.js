$(document).ready(function(){
	if ($('table').length > 0){
			$('table').find('tr').append($('<label class="alignleft"><input type="checkbox" name="sticky" value="sticky"> <span class="checkbox-title">置顶</span></label>'));
			$('input[name="sticky"]').on('click',function(){
				var sticky = $(this).is(':checked') ? 'sticky':false;
					pid = $(this).parent().parent().find('td:first').text();
				$.post(StickyAjax.ajaxurl,{"action":"my_action","security":StickyAjax.security,"sticky":sticky,"post_ID":pid},function(data){
					console.log(data);
				});
			});
		}
    	}
    );
});