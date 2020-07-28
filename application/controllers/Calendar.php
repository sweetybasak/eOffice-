<?php 

    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Calendar extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->model("Calendar_model");
        }

        public function calendar() {
             $this->load->view("trainings/calendar",array());
        }


        

        public function get_events() {
            $start = $this->input->get("start");
            

            $startdt = new DateTime('now');
            $startdt->setTimestamp($start);
            $start_format = $startdt->format('Y-m-d H:i:s');

            $end = $this->input->get("end");
            

            $enddt = new DateTime('now');
            $enddt->setTimestamp($end);
            $end_format = $enddt->format('Y-m-d H:i:s');

           

            $events = $this->Calendar_model->get_events($start_format,$end_format);

            $data_events = array();

            foreach($events->result() as $r) {
                $data_events[] = array(
                    "id" => $r->id,
                    "title" => $r->title,
                    "start" => $r->starting,
                    "end" => $r->ending

                );
            }
            echo json_encode(array("events" => $data_events));
            exit();
        }

        public function load1() {
            $this->load->view("trainings/calendar1",array());
        }
       public function load(){
           
           $event_data = $this->Calendar_model->fetch_all_event();
           foreach($event_data->result_array() as $row) {
               $data[] = array(
                   'id' => $row['id'],
                   'title' => $row['title'],
                   'starting' => $row['starting'],
                   'ending' => $row['ending']
                  
               );
           }
           echo json_encode(array("event_data" => $data));
          
       }
    }
?>