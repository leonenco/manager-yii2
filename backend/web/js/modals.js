//надо создать функцию по обновлению контента
//
//Подгружаем контент в модальное окно
$(document).ready(function(){
	var xurl = 'index.php?id=19';
	//Перезватываем событие при открытии окна
	$('#modal-dialog').on('shown.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var modal = $(this);
        $('#modal-xcontent').html("<div class='col-md-12 text-center'>Loading...</div>");
        $('#modal-dialog form input[name="action"]').val(button.data('name'));
        var data = button.data();
        $('h4.modal-title').html(button.data('modal-title'));
        $('#modal-xcontent').html(modalAjax(data));

        /*submiting*/
        $('#submit').bind('click', function (e) {
            e.preventDefault();
            data = $('.modal form').serialize();
            form = modalRequest(data);
        })
    });
    //функции обработки
	function modalAjax(a){
	    $.ajax({
	        type:"POST",
	        url: xurl,
	        data: a,
	        success:function(data){
	            // Success message
	            $('#modal-xcontent').html(data);
	        },
	        error: function(jqXHR, exception) {
	            var msg = '';
	            if (jqXHR.status === 0) {
	                msg = 'Not connect.\n Verify Network.';
	            } else if (jqXHR.status == 404) {
	                msg = 'Requested page not found. [404]';
	            } else if (jqXHR.status == 500) {
	                msg = 'Internal Server Error [500].';
	            } else if (exception === 'parsererror') {
	                msg = 'Requested JSON parse failed.';
	            } else if (exception === 'timeout') {
	                msg = 'Time out error.';
	            } else if (exception === 'abort') {
	                msg = 'Ajax request aborted.';
	            } else {
	                msg = 'Uncaught Error.\n' + jqXHR.responseText;
	            }
	            $('.modal#addnew #error').html("<div class='alert alert-warning alert-dismissible fade in'>");
	            $('.modal#addnew #error > .alert-warning').append('Important message: ');
	            $('.modal#addnew #error > .alert-warning').append(msg);
	            $('.modal#addnew #error > .alert-warning').append('</div>');
	            setTimeout(function() {
	                $('.alert').fadeOut('slow');
	                $('#error').html('');
	            }, 1000);
	        }
	    });
	}
	//Сабмитим данные из модального окна
	function modalRequest(a){
	    $.ajax({
	        type:"POST",
	        url: xurl,
	        data: a,
	        dataType: 'json',
	        success:function(data){
	            // Success message
	            if(typeof data['status'] != 'undefined'){
	                $('.modal #success').html("<div class='alert alert-success alert-dismissible fade in'>");
	                $('.modal #success > .alert-success').append(data.status);
	                $('.modal #success > .alert-success').append(data.obj);
	                $('.modal #success > .alert-success').append('</div>');
	            } else if(typeof data['error'] != 'undefined'){
	                $('.modal #error').html("<div class='alert alert-danger alert-dismissible fade in'>");
	                $('.modal #error > .alert-danger').append('<h3>Error</h3>: ');
	                $('.modal #error > .alert-danger').append(data.error);
	                $('.modal #error > .alert-danger').append('</div>');
	            }
	            setTimeout(function() {
	                $('.alert').fadeOut('slow');
	                $('#success').html('');
	                $('#error').html('');
	            }, 1000);
	            setTimeout(function() {
	                $('.modal').modal('toggle');
	            }, 3000);

	        },
	        error: function(jqXHR, exception) {
	            var msg = '';
	            if (jqXHR.status === 0) {
	                msg = 'Not connect.\n Verify Network.';
	            } else if (jqXHR.status == 404) {
	                msg = 'Requested page not found. [404]';
	            } else if (jqXHR.status == 500) {
	                msg = 'Internal Server Error [500].';
	            } else if (exception === 'parsererror') {
	                msg = 'Requested JSON parse failed.';
	            } else if (exception === 'timeout') {
	                msg = 'Time out error.';
	            } else if (exception === 'abort') {
	                msg = 'Ajax request aborted.';
	            } else {
	                msg = 'Uncaught Error.\n' + jqXHR.responseText;
	            }
	            $('.modal #error').html("<div class='alert alert-danger alert-dismissible fade in'>");
	            $('.modal #error > .alert-danger').append('Important message: ');
	            $('.modal #error > .alert-danger').append(msg);
	            $('.modal #error > .alert-danger').append('</div>');
	            setTimeout(function() {
	                $('.alert').fadeOut('slow');
	                $('#error').html('');
	            }, 1000);
	        }
	    });
	}
});