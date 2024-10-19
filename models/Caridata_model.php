<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Caridata_model extends CI_Model
{     
      function make_query($fieldcari = "",$namatable = "",$sort = "",$where = "")  
      {  
        $count = count ($fieldcari);
        $select = "";
        $order_column = "";
        $i=1;
        if ($where != "") {
          $this->db->where($where,true);
          // $this->db->Start();
          }    
          foreach($fieldcari as $key => $value){
               
               if ($i < $count){
               $select .= $value.",";
               $order_column = $value;
               }
               else{
               $select .= $value;
               }
               
               if (isset($_POST["search"]["value"])) {
                    if ($i == 1) {
                         $this->db->like("lower(" . $value . ")", strtolower($_POST["search"]["value"]));
                    } else {
                         $this->db->or_like("lower(" . $value . ")", strtolower($_POST["search"]["value"]));
                    }
               }  
          $i++; 
          }
               // $this->db->End();
               $this->db->select($select);
               $this->db->from($namatable);  
               
            if(isset($_POST["order"]))  
            {  
                    // $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
                    $this->db->order_by($order_column,$_POST['order']['0']['dir']);  
                    // $this->db->order_by($order_column);  
                    // $this->db->order_by($sort, 'DESC');  
            }  
            else  
            {  
                    $this->db->order_by($sort, 'desc');  
            }  
      }  
      function make_datatables($fieldcari = "",$namatable = "",$sort = "",$where = ""){  
           $this->make_query($fieldcari,$namatable,$sort,$where);  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data($fieldcari = "",$namatable = "",$sort = "",$where = ""){  
           $this->make_query($fieldcari,$namatable,$sort,$where);  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data($namatable = "")  
      {  
           $this->db->select("*");  
           $this->db->from($namatable);  
           return $this->db->count_all_results();  
      }  
}
