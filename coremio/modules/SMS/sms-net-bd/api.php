<?php
class ExampleSMS_API
{
    public $api_token = NULL;
    public $error     = NULL;
    public $rid       = 0;
    private $timeout  = 60;
    public $url      = "http://api.dev.alpha.net.bd";

    public function __construct() {}
    public function set_credentials($api_token = '')
    {
        $this->api_token   = $api_token;
    }
    private function curl_use($site_url, $post_data = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_URL, $site_url);
        if ($post_data) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->api_token . ":");
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $result = curl_exec($ch);
        return $result;
    }

    public function Submit($message = NULL, $number = 0)
    {
        
        $curl = curl_init();

        $postData = http_build_query([
            'api_key' => $this->api_token,
            'msg' => $message,
            'to' => $number,
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . '/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData, // Correctly set POST fields
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl); // For debugging if something goes wrong
        }

        curl_close($curl);

        return $response;
    }


    public function ReportLook($rid)
    {

        $outcome = $this->curl_use($this->url . 'rest/report/' . $rid);
        $solve = Utility::jdecode($outcome, true);
        if ($solve) {

            if (isset($solve["code"]) && isset($solve["message"])) {
                $this->error = "Error: <" . $solve["code"] . "> " . $solve["message"];
                return false;
            }

            if (isset($solve["recipients"])) {

                $result   = [
                    'enroute'     => [
                        'data' => [],
                        'count' => 0,
                    ],
                    'delivered'   => [
                        'data' => [],
                        'count' => 0,
                    ],
                    'undelivered' => [
                        'data' => [],
                        'count' => 0,
                    ],
                ];

                foreach ($solve["recipients"] as $recipient) {
                    $number = $recipient["msisdn"];
                    if ($recipient["dsnstatus"] == "ENROUTE") {
                        $result["enroute"]["data"][] = $number;
                        $result["enroute"]["count"]++;
                    } elseif ($recipient["dsnstatus"] == "DELIVERED") {
                        $result["delivered"]["data"][] = $number;
                        $result["delivered"]["count"]++;
                    } elseif ($recipient["dsnstatus"] == "UNDELIVERABLE") {
                        $result["undelivered"]["data"][] = $number;
                        $result["undelivered"]["count"]++;
                    }
                }

                return $result;
            } else {
                $this->error = "not found recipients";
                return false;
            }
        } else {
            $this->error = "The API response could not be resolved.";
            return false;
        }
    }

    public function get_prices()
    {
        $rows     = array();

        $outcome = $this->curl_use($this->url . 'rest/pricing/');
        $solve = Utility::jdecode($outcome, true);
        if (isset($solve["data"]) && $solve["data"]) {
            foreach ($solve["data"] as $row) {
                $rows[] = [
                    'countryCode' => $row["country"],
                    'prices' => [
                        'DKK' => $row["ddk"],
                        'EUR' => $row["eur"],
                        'USD' => $row["usd"],
                    ],
                ];
            }
        }
        return $rows;
    }

    // All Custom Modified Function.
    public function Balance()
    {
        // Send the request
        $outcome = $this->curl_use($this->url . '/user/balance/?api_key=' . $this->api_token);

        // Decode the response
        $solve = Utility::jdecode($outcome, true);

        // Check if decoding was successful
        if ($solve) {
            // Validate if 'data' and 'balance' exist in the response
            if (isset($solve['data']) && isset($solve['data']['balance'])) {
                // Ensure the balance is a numeric value and greater than or equal to 0
                if (is_numeric($solve['data']['balance']) && $solve['data']['balance'] >= 0) {
                    return [
                        'balance'  => $solve['data']['balance'],
                        'currency' => 'BDT',
                    ];
                } else {
                    $this->error = "Invalid balance value.";
                    return false;
                }
            } else {
                $this->error = "Balance information is missing.";
                return false;
            }
        } else {
            $this->error = "The API response could not be resolved.";
            return false;
        }
    }

    public function url()
    {
        return $this->url;
    }
}
