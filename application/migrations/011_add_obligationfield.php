<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
//notice that the name of the class will be Migration_add_missions whereas the file name is 001_add_missions
class Migration_add_obligationfield extends CI_Migration {
 
    public function up() {
 
        $this->dbforge->add_field(
            array(
                'active' => array(
                                    'type' => 'INT',
                                    'auto_increment' => FALSE,
                ),
            )
        );
 
        $this->dbforge->add_column('obligation');
 
        //you can also use active records and standard queries to insert raw data (though it's inadvisable except for dummy data like the first login account). You may have to autoload the database library to have it ready
 
    }
 
    public function down(){
 
        //when rolling back all we need to is remove the missions table
        $this->dbforge->drop_table('user');
 
    }
 
}