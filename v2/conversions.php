<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.facebook.com/v17.0/6477425325652713/events?access_token=EAANzrYJeD6wBALpTTu1ejhlZBSJYqdaUIwTsI1H7PuAGWHo3arezlx4ZCwFZBGYdZByPvzP3hGkO6DnzhgQ2wqvT7GqHTrmY6oYNntU9rZA4ApkyYG5T5SmSZB4qNH4mI8U48Sqf4jI7ZBF1buf4TVNFhZAIaPMA3cPw92dRhLSye7QJGynj1R5p',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true, 
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "test_event_code": "TEST99014",
    "data": [
        {
            "event_name": "Purchase",
            "event_time": 1686752873,
            "action_source": "website",
            "user_data": {
                "em": [
                    "7b17fb0bd173f625b58636fb796407c22b3d16fc78302d79f0fd30c2fc2fc068"
                ],
                "ph": [
                    null
                ]
            },
            "custom_data": {
                "currency": "USD",
                "value": "142.52"
            }
        }
    ]
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
