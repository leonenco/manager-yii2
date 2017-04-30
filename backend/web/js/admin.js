// Settings for JS
$(document).ready(function(){
    var xurl = 'index.php?id=19';
    $('label.insured').click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('btn-success').addClass('btn-warning');
            $('span.insured-lable').text("Insured?");
            $('input#insured').attr('checked', false);
        } else {
            $(this).removeClass('btn-warning').addClass('btn-success');
            $('span.insured-lable').text("We are insured!");
            $('input#insured').attr('checked', true);
        }
    });
    $('.btn-group label.btn').bind('click', function(){
        var childinput = $(this).children('input');
        if($(this).hasClass('active')){
            lablecheckbox(this,false,childinput);
            if($(this).hasClass('category')){
                $(this).remove();
            }
        } else {
            lablecheckbox(this,true,childinput);
        }
    });
    function lablecheckbox(lable,state,b){
        if(state !== true){
            console.log('ne active');
            $(lable).removeClass('btn-success').addClass('btn-default');
            b.attr('checked', false);
        } else {
            console.log('active');
            $(lable).removeClass('btn-default').addClass('btn-success');
            b.attr('checked', true);
        }
    }
    function responseHandler(data){
        var trHTML = '';
        $.each(data, function (i, item) {
            trHTML += 
            '<tr class="item'+ item.id +'"><td>' + item.checkbox +
            '</td><td>' + item.title +
            '</td><td>' + item.address +
            '</td><td>' + item.type +
            '</td><td>' + item.status +
            '</td><td>' + item.estVal +
            '</td><td>' + DropDownMenu(item.links) +
            '</td></tr>';                            
        });
        return trHTML;
    }
    function TableUpdate(){
        //console.log('Prisutsvuet tablita');
        var data = $('.ajax-table').data();
        var target = $('.ajax-table').data('target');
        //console.log('Prisutsvuet tablitas vivodom v ' + target);
        $.ajax({
            type:"POST",
            url: xurl,
            data: data,
            dataType: 'json',
            success:function(data){
                // Success message
                if(typeof data['status'] != 'undefined'){
                    $('#success').html("<div class='alert alert-success alert-dismissible fade in'>");
                    $('#success > .alert-success').append(data.status);
                    $('#success > .alert-success').append('</div>');
                } else if(typeof data['error'] != 'undefined'){
                    $('#error').html("<div class='alert alert-danger alert-dismissible fade in'>");
                    $('#error > .alert-danger').append('<h3>Error</h3>: ');
                    $('#error > .alert-danger').append(data.error);
                    $('#error > .alert-danger').append('</div>');
                }
                $('.ajax-table tbody').html('');
                $('.ajax-table tbody').append(responseHandler(data.data));
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                    $('#success').html('');
                    $('#error').html('');
                }, 1000);
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
                $('#error').html("<div class='alert alert-warning alert-dismissible fade in'>");
                $('#error > .alert-warning').append('Important message: ');
                $('#error > .alert-warning').append(msg);
                $('#error > .alert-warning').append('</div>');
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                    $('#error').html('');
                }, 1000);
            }
        });            
    }
    function DropDownMenu(array){
        var initial = '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu">';
        var list = '';
        $.each(array, function (i, item) {
            if (item.name == 'Edit'){
                 list += '<li class="link"><a href="'+item.url+'&obj='+item.obj+'">' + item.name + '</a></li>';
            } else {
                list += '<li class="link"><a href="#" class="xlink" data-action="' + item.type + '" data-' + item.action + '="' + item.obj + '" data-obj="' + item.obj + '">' + item.name + '</a></li>';                         
            }
            
        });
        initial += list + '</ul></div>';
        return initial;
    }

    function AjaxLink(data){
        $('#success').html('');
        $('#error').html('');
        $.ajax({
            type:"POST",
            url: xurl,
            data: data,
            dataType: 'json',
            success:function(response){
                // Success message
                $('#success').html("<div class='alert alert-success alert-dismissible fade in'>");
                $('#success > .alert-success').append(response.status);
                $('#success > .alert-success').append('</div>');
                if(response.status == 'Removed'){
                    $('.ajax-table tr.item'+data['obj']).addClass('hidden');
                    console.log('tr.item'+data['obj']+' Removed from table');
                } else if(response.status == 'Updated'){
                    TableUpdate();
                }
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                }, 1000);
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
                $('#error').html("<div class='alert alert-warning alert-dismissible fade in'>");
                $('#error > .alert-warning').append('Important message: ');
                $('#error > .alert-warning').append(msg);
                $('#error > .alert-warning').append('</div>');
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                    $('#error').html('');
                }, 1000);
            }
        });
    }
    $('#home').tab('show');
    $('.table').on('click','input#checkall', function () {
        var table = $(this).parent('.table');
        if ($(this).is(':checked')) {
            table.find('input.checkthis').each(function () {
                console.log('Find checkbox');
                $(this).prop("checked", true);
            });
        } else {
            table.find('input.checkthis').each(function () {
                console.log('Find checkbox');
                $(this).prop("checked", false);
            });
        }
    });
    
    //datetime modal
    $('#datetime').on('show.bs.modal', function (event) {
		//var button = $(event.relatedTarget) // Button that triggered the modal
		//var linkfrom = button.data('from') // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		//var modal = $(this);
		var datenow = new Date();
		//modal.find('#callbackForm #linkfrom').val(linkfrom);
		$('#time').datetimepicker({
            controlType: 'select',
            timeFormat: 'hh:mm tt',
            stepMinute: 30,
            altField: '#selected',
            altFieldTimeOnly: false,
	    });
		$('#show').click(function(){
		   $('#time').datetimepicker("show");
		});
	});
    
    $("[data-toggle=tooltip]").tooltip();
    
    //Формы
    $('form.ajax').on('submit', function(e) {
        e.preventDefault();
        $('#success').html('');
        $('#error').html('');
        var data = $(this).serialize();
        $.ajax({
            type:"POST",
            url: xurl,
            data: data,
            dataType: 'json',
            success:function(data){
                // Success message
                if(typeof data['status'] != 'undefined'){
                    $('#success').html("<div class='alert alert-success alert-dismissible fade in'>");
                    $('#success > .alert-success').append(data.status);
                    $('#success > .alert-success').append('</div>');
                } else if(typeof data['error'] != 'undefined'){
                    $('#error').html("<div class='alert alert-danger alert-dismissible fade in'>");
                    $('#error > .alert-danger').append('<h3>Error</h3>: ');
                    $('#error > .alert-danger').append(data.error);
                    $('#error > .alert-danger').append('</div>');
                }
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                    $('#success').html('');
                    $('#error').html('');
                }, 1000);
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
                $('#error').html("<div class='alert alert-danger alert-dismissible fade in'>");
                $('#error > .alert-danger').append('Important message: ');
                $('#error > .alert-danger').append(msg);
                $('#error > .alert-danger').append('</div>');
                setTimeout(function() {
                    $('.alert').fadeOut('slow');
                    $('#error').html('');
                }, 1000);
            }});
        return false;
    });
    /*Charts*/
    $(function () {
        $('.graf-container').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'Historic and Estimated Worldwide Population Growth by Region'
            },
            subtitle: {
                text: 'Source: Wikipedia.org'
            },
            xAxis: {
                categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Billions'
                },
                labels: {
                    formatter: function () {
                        return this.value / 1000;
                    }
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' millions'
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            series: [{
                name: 'Asia',
                data: [502, 635, 809, 947, 1402, 3634, 5268]
            }, {
                name: 'Africa',
                data: [106, 107, 111, 133, 221, 767, 1766]
            }, {
                name: 'Europe',
                data: [163, 203, 276, 408, 547, 729, 628]
            }, {
                name: 'America',
                data: [18, 31, 54, 156, 339, 818, 1201]
            }, {
                name: 'Oceania',
                data: [2, 2, 2, 6, 13, 30, 46]
            }]
        });
    });
    /*End chart*/
    $(function () {
        $('.work-done-graf-container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Average fruit consumption during one week'
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
                categories: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ],
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]
            },
            yAxis: {
                title: {
                    text: 'Fruit units'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ' units'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
                name: 'John',
                data: [3, 4, 3, 5, 4, 10, 12]
            }, {
                name: 'Jane',
                data: [1, 3, 4, 3, 3, 5, 4]
            }]
        });
    });
    /*Ajax*/
    $('.ajax-table').on('click','.xlink', function(e) {
        e.preventDefault();
        console.log('Ajax link submited');
        AjaxLink($(this).data());
        return false;
    });
    if($('.ajax-table').length){
        TableUpdate();           
    }
    $('#modal-dialog').on('hide.bs.modal', function(e){
        if($('.ajax-table').length){
            TableUpdate();           
        }
    });

});