$('.deposit').click(function(e){
    e.preventDefault();
	var baseUrl = $(this).attr('baseUrl');
    $.get(baseUrl+'/deposit/deposit',function(data){
        $('#deposit').modal('show')
             .find('#depositContent')
             .html(data);
	});
});