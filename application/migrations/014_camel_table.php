<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_camel_table extends CI_Migration {

    public function up(){
    
        $tables = $this->db->list_tables();
        
        foreach($tables as $table){
            
            $field_data = $this->db->field_data($table);
            
            $changes = '';
            
            foreach($field_data as $field){
            
                //change the field name, and keep the field type
                $changes[$field->name] = array(
                    'name'  => strtolower($field->name[0]).substr(str_replace(' ', '', ucwords(preg_replace('/[\s_]+/', ' ', $field->name))), 1),
                    'type'  => $field->type,
                );
                
                //add in a constraint if it exists
                if($field->max_length !== null){
                    $changes[$field->name] += array(
                        'constraint'    => $field->max_length,
                    );
                }
                
                //if the field is not id, and the field's default is not null, we want to keep it
                if($field->name !== 'id' AND $field->default !== null){
                    if($field->type !== 'timestamp'){
                        $changes[$field->name] += array(
                            'default'   => $field->default,
                        );
                    }
                }
                
                //make sure ids are auto incremented and not null
                if($field->name === 'id'){
                    $changes[$field->name] += array(
                        'auto_increment'    => true,
                        'null'              => false,
                    );
                }
                
            }
            
            $this->dbforge->modify_column($table, $changes);
            
        }

    }

    public function down(){
    
        $tables = $this->db->list_tables();
        
        foreach($tables as $table){
            
            $field_data = $this->db->field_data($table);
            
            $changes = '';
            
            foreach($field_data as $field){
            
                //change the field name to snake case, and keep the field type
                $changes[$field->name] = array(
                    'name'  => strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $field->name)),
                    'type'  => $field->type,
                );
                
                //add in a constraint if it exists
                if($field->max_length !== null){
                    $changes[$field->name] += array(
                        'constraint'    => $field->max_length,
                    );
                }
                
                //if the field is not id, and the field's default is not null, we want to keep it
                if($field->name !== 'id' AND $field->default !== null){
                    if($field->type !== 'timestamp'){
                        $changes[$field->name] += array(
                            'default'   => $field->default,
                        );
                    }
                }
                
                //make sure ids are auto incremented and not null
                if($field->name === 'id'){
                    $changes[$field->name] += array(
                        'auto_increment'    => true,
                        'null'              => false,
                    );
                }
                
            }
            
            $this->dbforge->modify_column($table, $changes);
            
        }
    
    }
}