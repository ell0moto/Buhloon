<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
//notice that the name of the class will be Migration_add_missions whereas the file name is 001_add_missions
class Migration_add_children extends CI_Migration {
 
    public function up(){
 
        //dbforge is already loaded when extending from CI_Migration
 
        //dbforge will notice you're adding a field called id, it will automatically be assigned as an INT(9) auto_incrementing Primary Key.
        $this->dbforge->add_field('id');
 
        $this->dbforge->add_field(
            array(
                'user_id' => array(
                                    'type' => 'INT',
                                    'auto_increment' => FALSE,
                ),
                'name' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => '40',
                ),
                'total_ribbon' => array(
                                    'type' => 'INT',
                                    'auto_increment' => FALSE,
                ),
                'spent_ribbon' => array(
                                    'type' => 'INT',
                                    'auto_increment' => FALSE,
                ),
                'net_ribbon' => array(
                                    'type' => 'INT',
                                    'auto_increment' => FALSE,
                ),
                'total_plan' => array(
                                    'type' => 'INT',
                                    'auto_increment' => FALSE,
                ),
            )
        );
 
        $this->dbforge->create_table('children');
 
        //you can also use active records and standard queries to insert raw data (though it's inadvisable except for dummy data like the first login account). You may have to autoload the database library to have it ready
 
    }
 
    public function down(){
 
        //when rolling back all we need to is remove the missions table
        $this->dbforge->drop_table('missions');
 
    }
 
}