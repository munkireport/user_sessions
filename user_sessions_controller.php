<?php 

/**
 * user_sessions module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class User_sessions_controller extends Module_controller
{
	
	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
    }

	/**
	 * Default method
	 * @author tuxudo
	 *
	 **/
	function index()
	{
		echo "You've loaded the user_sessions module!";
	}
    
	/**
    * Retrieve the count of different events for serial number in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_action_count($serial_number = '')
    {
        $obj = new View();
        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }
  
        $queryobj = new User_sessions_model();
        
        if ($serial_number == ''){
            $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `event` = 'shutdown' THEN 1 END) AS 'shutdown',
                        COUNT(CASE WHEN `event` = 'reboot' THEN 1 END) AS 'reboot',
                        COUNT(CASE WHEN `event` = 'logout' THEN 1 END) AS 'logout',
                        COUNT(CASE WHEN `event` = 'sshlogin' THEN 1 END) AS 'sshlogin',
                        COUNT(CASE WHEN `event` = 'login' THEN 1 END) AS 'login'
                        FROM user_sessions
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE ".get_machine_group_filter('');
        } else {
            
            $current_time = time();
            $past_month = $current_time - 2592000;
            $past_year = $current_time - 31536000;
            
            $sql = "SELECT COUNT(1) as total,
                        COUNT(CASE WHEN `event` = 'shutdown' THEN 1 END) AS 'shutdown',
                        COUNT(CASE WHEN `event` = 'reboot' THEN 1 END) AS 'reboot',
                        COUNT(CASE WHEN `event` = 'logout' THEN 1 END) AS 'logout',
                        COUNT(CASE WHEN `event` = 'sshlogin' THEN 1 END) AS 'sshlogin',
                        COUNT(CASE WHEN `event` = 'login' THEN 1 END) AS 'login',
                        
                        COUNT(CASE WHEN `event` = 'shutdown' AND `time` > ".$past_month." THEN 1 END) AS 'shutdown_month',
                        COUNT(CASE WHEN `event` = 'reboot' AND `time` > ".$past_month." THEN 1 END) AS 'reboot_month',
                        COUNT(CASE WHEN `event` = 'logout' AND `time` > ".$past_month." THEN 1 END) AS 'logout_month',
                        COUNT(CASE WHEN `event` = 'sshlogin' AND `time` > ".$past_month." THEN 1 END) AS 'sshlogin_month',
                        COUNT(CASE WHEN `event` = 'login' AND `time` > ".$past_month." THEN 1 END) AS 'login_month',
                        
                        COUNT(CASE WHEN `event` = 'shutdown' AND `time` > ".$past_year." THEN 1 END) AS 'shutdown_year',
                        COUNT(CASE WHEN `event` = 'reboot' AND `time` > ".$past_year." THEN 1 END) AS 'reboot_year',
                        COUNT(CASE WHEN `event` = 'logout' AND `time` > ".$past_year." THEN 1 END) AS 'logout_year',
                        COUNT(CASE WHEN `event` = 'sshlogin' AND `time` > ".$past_year." THEN 1 END) AS 'sshlogin_year',
                        COUNT(CASE WHEN `event` = 'login' AND `time` > ".$past_year." THEN 1 END) AS 'login_year'
                        
                        FROM user_sessions
                        LEFT JOIN reportdata USING (serial_number)
                        WHERE serial_number = '$serial_number'
                        ".get_machine_group_filter('AND');
        }

        $obj->view('json', array('msg' => current($queryobj->query($sql))));
    }
    
	/**
     * Retrieve data in json format
     *
     **/
     public function get_data($serial_number = '')
     {
        $obj = new View();

        if (! $this->authorized()) {
            $obj->view('json', array('msg' => 'Not authorized'));
            return;
        }

        $queryobj = new User_sessions_model;
         
        if ($serial_number == ''){
         
            $current_time = time();
            $past_year = $current_time - 31536000;
            
            $sql = "SELECT m.computer_name, u.serial_number,
                        COUNT(CASE WHEN u.event = 'shutdown' THEN 1 END) AS 'shutdown',
                        COUNT(CASE WHEN u.event = 'reboot' THEN 1 END) AS 'reboot',
                        COUNT(CASE WHEN u.event = 'logout' THEN 1 END) AS 'logout',
                        COUNT(CASE WHEN u.event = 'sshlogin' THEN 1 END) AS 'sshlogin',
                        COUNT(CASE WHEN u.event = 'login' THEN 1 END) AS 'login'
                        FROM user_sessions u                        
                        LEFT JOIN machine m ON (u.serial_number = m.serial_number)
                        LEFT JOIN reportdata r ON (u.serial_number = r.serial_number)
                        
                        WHERE u.time > ".$past_year."
                        ".get_machine_group_filter('AND')."
                        GROUP BY serial_number";
            
            // Fix the machine group filter
            $sql = str_replace("AND reportdata.machine_group IN ","AND r.machine_group IN ",$sql);
            
            $obj->view('json', array('msg' => $queryobj->query($sql)));

        } else {
            
            $user_sessions_tab = array();
            foreach($queryobj->retrieve_records($serial_number) as $shareEntry) {
                $user_sessions_tab[] = $shareEntry->rs;
            }
            
            $obj->view('json', array('msg' => $user_sessions_tab));
        }
     }
		
} // END class User_sessions_controller
