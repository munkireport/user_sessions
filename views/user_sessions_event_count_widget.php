<div class="col-lg-4 col-md-6">
    <div class="panel panel-default" id="user_sessions_event_count-widget">
        <div id="user_sessions_event_count-widget" class="panel-heading" data-container="body">
            <h3 class="panel-title"><i class="fa fa-industry"></i> 
                <span data-i18n="user_sessions.event_count"></span>
                <list-link data-url="/show/listing/user_sessions/user_sessions"></list-link>
            </h3>
        </div>
        <div class="panel-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/user_sessions/get_action_count', function( data ) {
        if(data.error){
//            alert(data.error);
            return;
        }
        
        var panel = $('#user_sessions_event_count-widget div.panel-body'),
        baseUrl = appUrl + '/show/listing/user_sessions/user_sessions/';
        panel.empty();
        // Set blocks, disable if zero
        if(data.sshlogin != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.sshlogin+'</span><br>'+i18n.t('user_sessions.sshlogin')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-danger disabled"><span class="bigger-150">'+data.sshlogin+'</span><br>'+i18n.t('user_sessions.sshlogin')+'</a>');
        }
        if(data.reboot != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.reboot+'</span><br>'+i18n.t('user_sessions.reboot')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-warning disabled"><span class="bigger-150">'+data.reboot+'</span><br>'+i18n.t('user_sessions.reboot')+'</a>');
        }
        if(data.login != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.login+'</span><br>'+i18n.t('user_sessions.login')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-success disabled"><span class="bigger-150">'+data.login+'</span><br>'+i18n.t('user_sessions.login')+'</a>');
        }
        if(data.logout != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-info"><span class="bigger-150">'+data.logout+'</span><br>'+i18n.t('user_sessions.logout')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-info disabled"><span class="bigger-150">'+data.logout+'</span><br>'+i18n.t('user_sessions.logout')+'</a>');
        }
        if(data.shutdown != "0"){
            panel.append(' <a href="'+baseUrl+'" class="btn btn-primary"><span class="bigger-150">'+data.shutdown+'</span><br>'+i18n.t('user_sessions.shutdown')+'</a>');
        } else {
            panel.append(' <a href="'+baseUrl+'" class="btn btn-primary disabled"><span class="bigger-150">'+data.shutdown+'</span><br>'+i18n.t('user_sessions.shutdown')+'</a>');
        }
    });
});

</script>
