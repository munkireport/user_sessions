
<h2 data-i18n="user_sessions.clienttab"></h2>

<div id="user_sessions-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

<div id="user_sessions-count-view" class="row hide">
    <div class="col-md-2">
        <h4 data-i18n="user_sessions.event_count_all"></h4>
        <table class="table table-striped" style="max-width: 200px;">
            <tr>
                <th data-i18n="user_sessions.reboots"></th>
                <td id="user_sessions-reboot"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.shutdowns"></th>
                <td id="user_sessions-shutdown"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.sshlogins"></th>
                <td id="user_sessions-sshlogin"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.logins"></th>
                <td id="user_sessions-login"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.logouts"></th>
                <td id="user_sessions-logout"></td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-2">
        <h4 data-i18n="user_sessions.events_last_month"></h4>
        <table class="table table-striped" style="max-width: 200px;">
            <tr>
                <th data-i18n="user_sessions.reboots"></th>
                <td id="user_sessions-reboot-month"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.shutdowns"></th>
                <td id="user_sessions-shutdown-month"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.sshlogins"></th>
                <td id="user_sessions-sshlogin-month"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.logins"></th>
                <td id="user_sessions-login-month"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.logouts"></th>
                <td id="user_sessions-logout-month"></td>
            </tr>
        </table>
    </div>
        
    <div class="col-md-2">
        <h4 data-i18n="user_sessions.events_last_year"></h4>
        <table class="table table-striped" style="max-width: 200px;">
            <tr>
                <th data-i18n="user_sessions.reboots"></th>
                <td id="user_sessions-reboot-year"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.shutdowns"></th>
                <td id="user_sessions-shutdown-year"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.sshlogins"></th>
                <td id="user_sessions-sshlogin-year"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.logins"></th>
                <td id="user_sessions-login-year"></td>
            </tr>
            <tr>
                <th data-i18n="user_sessions.logouts"></th>
                <td id="user_sessions-logout-year"></td>
            </tr>
        </table>
    </div>
</div>

<div id="user_sessions-history-table-view" class="row hide" style="padding-left: 15px; padding-right: 15px;">
    <h3><span data-i18n="user_sessions.event_history"></span></h3>
      <table class="table table-striped table-condensed table-bordered" id="user_sessions-history-table">
        <thead>
          <tr>
            <th data-i18n="event" data-colname='user_sessions.event'></th>
            <th data-i18n="username" data-colname='user_sessions.user'></th>
            <th data-i18n="user_sessions.uid" data-colname='user_sessions.uid'></th>		      	
            <th data-i18n="user_sessions.ipaddress" data-colname='user_sessions.remote_ssh'></th>
            <th data-i18n="user_sessions.time" data-colname='user_sessions.time'></th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td data-i18n="listing.loading" colspan="5" class="dataTables_empty"></td>
            </tr>
        </tbody>
      </table>
</div>


<script>
    $(document).on('appReady', function(e, lang) {

        // Get event data
        $.getJSON( appUrl + '/module/user_sessions/get_action_count/' + serialNumber, function( data ) {
            if( ! data ){
                $('#user_sessions-msg').text(i18n.t('no_data'));
            } else {

                // Hide
                $('#user_sessions-msg').text('');
                $('#user_sessions-count-view').removeClass('hide');

                // Add strings
                $('#user_sessions-logout').text(data.logout);
                $('#user_sessions-login').text(data.login);
                $('#user_sessions-sshlogin').text(data.sshlogin);
                $('#user_sessions-shutdown').text(data.shutdown);
                $('#user_sessions-reboot').text(data.reboot);
                
                $('#user_sessions-logout-month').text(data.logout_month);
                $('#user_sessions-login-month').text(data.login_month);
                $('#user_sessions-sshlogin-month').text(data.sshlogin_month);
                $('#user_sessions-shutdown-month').text(data.shutdown_month);
                $('#user_sessions-reboot-month').text(data.reboot_month);
                
                $('#user_sessions-logout-year').text(data.logout_year);
                $('#user_sessions-login-year').text(data.login_year);
                $('#user_sessions-sshlogin-year').text(data.sshlogin_year);
                $('#user_sessions-shutdown-year').text(data.shutdown_year);
                $('#user_sessions-reboot-year').text(data.reboot_year);
                
            }
        });
        
        // Get event history data
        $.getJSON( appUrl + '/module/user_sessions/get_data/' + serialNumber, function( data ) {
            if( ! data ){
                $('#user_sessions-msg').text(i18n.t('no_data'));
            } else {

                // Hide
                $('#user_sessions-msg').text('');
                $('#user_sessions-history-table-view').removeClass('hide');
                
                $('#user_sessions-history-table').DataTable({
                    data: data,
                    order: [[4,'asc']],
                    autoWidth: false,
                    columns: [
                        { data: 'event' },
                        { data: 'user' },
                        { data: 'uid' },
                        { data: 'remote_ssh' },
                        { data: 'time' }
                    ],
                    createdRow: function( nRow, aData, iDataIndex ) {
                        // Event type
                        var eventlocal=$('td:eq(0)', nRow).html();
                        eventlocal = eventlocal == 'login' ? i18n.t('user_sessions.login') :
                        eventlocal = eventlocal == 'sshlogin' ? i18n.t('user_sessions.sshlogin') :
                        eventlocal = eventlocal == 'reboot' ? i18n.t('user_sessions.reboot') :
                        eventlocal = eventlocal == 'shutdown' ? i18n.t('user_sessions.shutdown') :
                        (eventlocal === 'logout' ? i18n.t('user_sessions.logout') : eventlocal)
                        $('td:eq(0)', nRow).html(eventlocal)

                        // Format date
                        var event = parseInt($('td:eq(4)', nRow).html());
                        var date = new Date(event * 1000);
                        $('td:eq(4)', nRow).html('<span title="' + moment(date).fromNow() + '">'+moment(date).format('llll')+'</span>');
                    }
                });
            }
        });
    });
</script>
