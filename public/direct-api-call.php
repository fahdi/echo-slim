<?php
$API_Key = '1234578';
$Application_Key = 'abcd1234';
// Edge Contact Array - this will be passed to saveClient method
$EdgeContact = array(
    'firstName' => 'John',
    'lastName' => 'Doe',
    'homePhone' => '123 456-7890',
    'email' => 'jdoe@somedomain.com',
);

$soap_client_uri = 'https://edgedev.mortgagecoach.com/edgeinterface/edgeinterface.asmx?wsdl';
$edge = new SoapClient($soap_client_uri);
// Namespace
$ns = 'http://com.mortgagecoach.edgeinterface';
// Body of the Soap Header.
$headerbody = array('APIKey' => $API_Key, 'applicationKey' => $Application_Key);
// Create Soap Header.
$header = new SOAPHeader($ns, 'AuthHeader', $headerbody);
//set the Headers of Soap Client.
$edge->__setSoapHeaders($header);
// Build the client array

$newClient = array(
    'clientId' => 0,
    'contact' => $EdgeContact
);

// Build the parameter array
$params = array(
    'client' => $newClient,
    'reportType' => 0,
    'userName' => 'login name of user to assign'   
);

// Let's do the saving
$result = $edge->saveEnterpriseClient($params);
if ($result->saveClientResult->hasErr)
    echo "not successful";
else
    echo "success";
