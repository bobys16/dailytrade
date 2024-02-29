///////////////////////////////////////////////////////////////
//                                                           //
//              JQUERY NATIVE FRAMEWORK                      //
//                  Author: Elzgar                           //
//           Version 2.0.1 LTS (27-06-2021)                  //
//                                                           //
///////////////////////////////////////////////////////////////

    /// Local Storage define token and frontend authentication
    var local = localStorage;
    bind_form();
    
    /// Quick Item Binding ///
    var click_path;
    var path;
    var main_content = $('div[content-loader="true"]');
    const base_url = '/admin/router';
    $('[view="true"]').on('click',function() {
        $('.mm-active').removeClass('mm-active');
        $(this).parent().addClass('mm-active');
        click_path = "path="+$(this).attr('path');
        sender(base_url, "method=view&"+click_path, 'post', 'HTML',function(res) {
            main_content.slideUp('slow');
            setTimeout(function() {
                main_content.html(res).fadeIn('slow');
            },1000);
            bind_form();
            $('.toggled').toggleClass('toggled');
        });
    });
    function bind_form() {
        $('[callrouter="true"]').on('submit',function(e) {
            e.preventDefault();
            path = $(this).attr('action');
            var post_data = $(this).serialize()+"&method=control&path="+path;
            sender(base_url, post_data, 'post', 'JSON', function(res){
                if(res.success == 'true') {
                    if(res.next_action !== null) {
                        location.replace(res.next_action);
                    }
                    if(res.modal) {
                        $('[view="true"][path="buypos"]').click();
                    }
                    
                	Lobibox.notify('success', {
                		pauseDelayOnHover: true,
                		size: 'mini',
                		rounded: true,
                		icon: 'bx bx-check-circle',
                		delayIndicator: false,
                		continueDelayOnInactiveTab: false,
                		position: 'top right',
                		msg: res.msg
                	});
                } else {
                	Lobibox.notify('error', {
                		pauseDelayOnHover: true,
                		size: 'mini',
                		rounded: true,
                		delayIndicator: false,
                		icon: 'bx bx-x-circle',
                		continueDelayOnInactiveTab: false,
                		position: 'top right',
                		msg: res.msg
                	});
                }
            });
        })
        return;
    }
    
    function sender(url, data, type, dataType, callback) {
        $.ajax({
            url: url,
            data: data,
            type: type,
            headers: {
                'Elzgar': 'Its Lord'
            },
            success: function(r, textStatus, request) {
                
                if(dataType == "JSON") {
                    callback(JSON.parse(r));
                } else {
                    callback(r);
                }
                if(request.getResponseHeader('ELZ-CODE') == "ERROR") {
                    r = JSON.parse(r);
                    switch(r.action) {
                        case "login":
                            location.replace('login');
                            break;
                            
                        case "refresh":
                            location.replace('');
                            break;
                        default: 
                            alert(r.msg);
                    }
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
    }