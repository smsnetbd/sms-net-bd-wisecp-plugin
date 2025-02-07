<?php



    class ExampleSMS3
    {
        public $international=true,$lang,$config,$error;
        private $instance,$title,$body,$numbers=[];

        public function __construct($external_config=[])
        {

            $this->lang         = Modules::Lang("SMS",__CLASS__);

            if(!class_exists("ExampleSMS_API")) include __DIR__.DS."api.php";
            
            $config             = Modules::Config("SMS",__CLASS__);

            $this->config       = $config;

            if (!empty($external_config) && is_array($external_config)) {
                $this->config = array_merge($config,$external_config);
            }
            
            $this->title        = $config["origin"];

            $this->instance     = new ExampleSMS_API();

            $this->instance->set_credentials($config["api-token"]);

           //$this->instance->submit("title","AlphNet","8801775051601");

        }

        public function title($arg=''){
            $this->title = $arg;
            return $this;
        }

        public function body($text='',$template=false,$variables=[],$lang='',$user=0){
            $this->numbers_reset();
            if($template) {
                $look = View::notifications("sms",$template,$text,$variables,$lang,$user);
                if($look!==false && isset($look["content"])){
                    if(isset($look["title"]))
                        $this->title($look["title"]);
                    $text = $look["content"];
                }
            }

            if(!class_exists("Money")) Helper::Load("Money");
            $currencies = Money::getCurrencies();

            foreach($currencies AS $row){
                if(($row["prefix"] && substr($row["prefix"],-1,1) == ' ') || ($row["suffix"] && substr($row["suffix"],0,1) == ' '))
                    $code = $row["code"];
                else
                    $code = $row["prefix"] ? $row["code"].' ' : ' '.$row["code"];

                $row["prefix"] = Utility::text_replace($row["prefix"],[' ' => '']);
                $row["suffix"] = Utility::text_replace($row["suffix"],[' ' => '']);
                if(!Validation::isEmpty($row["prefix"]) && $row["prefix"])
                    $text = Utility::text_replace($text,[$row["prefix"] => $code]);
                elseif(!Validation::isEmpty($row["suffix"]) && $row["suffix"])
                    $text = Utility::text_replace($text,[$row["suffix"] => $row["code"]]);
            }
            $text       = Filter::transliterate($text);

            $this->body = $text;
            return $this;
        }

        public function AddNumber($arg=0,$cc=NULL){
            if(!is_array($arg)){
                if($cc != NULL) $arg = [$cc."|".$arg];
                else $arg = [$arg];
            }
            foreach($arg AS $num){
                if(strstr($num,"|")){
                    $split  = explode("|",$num);
                    $cc     = $split[0];
                    $no     = $split[1];
                    $num    = $cc.$no;
                }
                if(!array_search($num,$this->numbers)) $this->numbers[] = $num;
            }
            return $this;
        }


        public function getReportID(){
            return $this->instance->rid;
        }

        public function getReport($id=0){
            $id     = ($id == 0) ? $this->getReportID() : $id;
            $content = $this->instance->ReportLook($id);
            if(!$content){
                $this->error = $this->instance->error;
                return false;
            }

            $waiting		    = $content["enroute"];
            $conducted		    = $content["delivered"];
            $erroneous	        = $content["undelivered"];
            $waiting_arr	    = $waiting["data"];
            $conducted_arr      = $conducted["data"];
            $erroneous_arr	    = $erroneous["data"];
            $waiting_count	    = $waiting["count"];
            $conducted_count	= $conducted["count"];
            $erroneous_count	= $erroneous["count"];
            return [
                'waiting'       => ['data' => $waiting_arr, 'count' => $waiting_count],
                'conducted'     => ['data' => $conducted_arr, 'count' => $conducted_count],
                'erroneous'     => ['data' => $erroneous_arr, 'count' => $erroneous_count],
            ];
        }

        public function getBalance(){
            return $this->instance->Balance();
        }

        public function get_prices(){
            $prices = $this->instance->get_prices();
            $result = [];
            if($prices)
                foreach($prices AS $row) $result[$row["countryCode"]] = $row["prices"];
            else{
                $this->error = $this->instance->error;
                return false;
            }
            return $result;
        }

        public function getNumbers(){
            return $this->numbers;
        }

        public function getTitle(){
            return $this->title;
        }

        public function getBody(){
            return $this->body;
        }

        public function getError(){
            return $this->error;
        }

        public function numbers_reset(){
            return $this->numbers = array();
        }

        public function ClientCreated($params=[]){
            $ExampleSMS = new ExampleSMS();
            $message = "ClientCreated";
            $ExampleSMS->submit("title", $message ,"8801775051601");
        }


    }


    // // Hook to send SMS on client creation
    // Hook::add("ClientCreated", 1, function($params = []) {

    //     // SMS message content
    //     $message = "ClientCreated";
    //     // Initialize the ExampleSMS plugin
    //     $smsPlugin = new ExampleSMS();
    //     $smsPlugin->submit('title', $message, '8801775051601');

    // });


    // Hook::add("ClientDeleted", 1, function($params = []) {
    //     // SMS message content
    //     $message = "ClientDeleted";
    //     // Initialize the ExampleSMS plugin
    //     $smsPlugin = new ExampleSMS();
    //     $smsPlugin->submit('title', $message, '8801775051601');
        
    // });

     
         