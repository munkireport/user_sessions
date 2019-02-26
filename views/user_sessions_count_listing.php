<?php $this->view('partials/head'); ?>
<!--


To those of you using this module as a template:
Do NOT use this listing as a template unless you
know what you are doing. This listing is for
advanced listings only.


-->

<div class="container">
  <div class="row">
    <div class="col-lg-12">

		  <h3><span data-i18n="user_sessions.event_count_report"></span> <span id="total-count" class='label label-primary'>…</span></h3>

		  <table class="table table-striped table-condensed table-bordered" id="user_sessions-count-table">
		    <thead>
		      <tr>
		      	<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
		      	<th data-i18n="serial" data-colname='reportdata.serial_number'></th>	      	
		      	<th data-i18n="user_sessions.logins" data-colname='user_sessions.login'></th>
		      	<th data-i18n="user_sessions.logouts" data-colname='user_sessions.logout'></th>
		      	<th data-i18n="user_sessions.shutdowns" data-colname='user_sessions.shutdown'></th>
		      	<th data-i18n="user_sessions.reboots" data-colname='user_sessions.reboot'></th>
		      	<th data-i18n="user_sessions.sshlogins" data-colname='user_sessions.sshlogin'></th>
		      </tr>
		    </thead>
		    <tbody>
		    	<tr>
					<td data-i18n="listing.loading" colspan="7" class="dataTables_empty"></td>
				</tr>
		    </tbody>
		  </table>
    </div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">
    
	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

        $.getJSON( appUrl + '/module/user_sessions/get_data/' , function( data ) {
            $('#user_sessions-count-table').DataTable( {

                data: data,
                order: [[4,'asc']],
                autoWidth: false,
                serverSide: false,
                columns: [
                        { data: 'computer_name' },
                        { data: 'serial_number' },
                        { data: 'login' },
                        { data: 'logout' },
                        { data: 'shutdown' },
                        { data: 'reboot' },
                        { data: 'sshlogin' }
                    ],
                dom: mr.dt.buttonDom,
                buttons: mr.dt.buttons,
                order: mySort,
                columnDefs: columnDefs,
                createdRow: function( nRow, aData, iDataIndex ) {
                    // Update name in first column to link
                    var name=$('td:eq(0)', nRow).html();
                    if(name == ''){name = "No Name"};
                    var sn=$('td:eq(1)', nRow).html();
                    var link = mr.getClientDetailLink(name, sn, '#tab_user_sessions-tab');
                    $('td:eq(0)', nRow).html(link);
                }
            } );
        } );
	} );
</script>

<?php $this->view('partials/foot'); ?>
