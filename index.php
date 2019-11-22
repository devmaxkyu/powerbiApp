<?php



require __DIR__ . '/vendor/autoload.php';

session_start();

// importing storage class
require_once(__DIR__ . '/storage/index.php');

// check if it has already access token.
// if(Storage::getValue(Storage::$access_token_sesskey)){
//     // Redirect the user to the authorization URL.
//     header('Location: /dashboard.php');
//     exit;
// }


function displayForm(){
        // display form which user input information into
        echo '<h2>Account Setting</h2>'; // HTML Title
        echo '<form action="./" method="post">'; // HTML Form Tag Begin
        echo 'Client ID:<br><input size="100" type="text" name="client_id" value="'.Storage::getValue(Storage::$client_id_sesskey).'" required readonly>'; // HTML Input Tag
        echo '<br><br>Client Secrect:<br><input size="100" type="text" name="secret_key" value="'.Storage::getValue(Storage::$secret_key_sesskey).'" required readonly>'; // HTML Input Tag
        echo '<br><br>Redirect URL:<br><input size="100" type="text" name="redirect_url" value="'.Storage::getValue(Storage::$redirect_url_sesskey).'" required readonly>'; // HTML Input Tag
        echo '<br><br>Authorize URL:<br><input size="100" type="text" name="authority_url" value="'.Storage::getValue(Storage::$authority_url_sesskey).'" required readonly>'; // HTML Input Tag
        echo '<br><br>Resource URL:<br><input size="100" type="text" name="resource_url" value="'.Storage::getValue(Storage::$resource_url_sesskey).'" required readonly>'; // HTML Input Tag
        echo '<br><br>API URL:<br><input size="100" type="text" name="api_url" value="'.Storage::getValue(Storage::$api_url_sesskey).'" required readonly>'; // HTML Input Tag        
        echo '<br><br>Tenant ID:<br><input size="100" type="text" name="tenant_id" value="'.Storage::getValue(Storage::$tenant_id_sesskey).'" required readonly>'; // HTML Input Tag
        echo '<br><br><input type="submit" name="authorize" value="Authorize">';
        echo '</form>'; // HTML Form Tag End
        exit;
}

function getAuthorizeCode(){
    Storage::setValue(Storage::$client_id_sesskey, $_POST['client_id']);
    Storage::setValue(Storage::$redirect_url_sesskey, $_POST['redirect_url']);
    Storage::setValue(Storage::$secret_key_sesskey, $_POST['secret_key']);
    Storage::setValue(Storage::$authority_url_sesskey, $_POST['authority_url']);
    Storage::setValue(Storage::$resource_url_sesskey,  $_POST['resource_url']);
    Storage::setValue(Storage::$api_url_sesskey, $_POST['api_url']); 
    Storage::setValue(Storage::$tenant_id_sesskey, $_POST['tenant_id']); 
   

    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => Storage::getValue(Storage::$client_id_sesskey),    // The client ID assigned to you by the provider
        'clientSecret'            => Storage::getValue(Storage::$secret_key_sesskey),   // The client password assigned to you by the provider
        'redirectUri'             => Storage::getValue(Storage::$redirect_url_sesskey),
        'urlAuthorize'            => Storage::getValue(Storage::$authority_url_sesskey).Storage::getValue(Storage::$tenant_id_sesskey).'/oauth2/v2.0/authorize',
        'urlAccessToken'          => Storage::getValue(Storage::$authority_url_sesskey).Storage::getValue(Storage::$tenant_id_sesskey).'/oauth2/token',
        'urlResourceOwnerDetails' => Storage::getValue(Storage::$resource_url_sesskey),
        'scopes' => 'https://analysis.windows.net/powerbi/api/Workspace.ReadWrite.All https://analysis.windows.net/powerbi/api/Dataset.ReadWrite.All https://analysis.windows.net/powerbi/api/Report.ReadWrite.All',
        'scopeSeparator' => ' '
    ]);
    
    // Fetch the authorization URL from the provider; this returns the
    // urlAuthorize option and generates and applies any necessary parameters
    // (e.g. state).
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    $_SESSION['oauth2state'] = $provider->getState();

    // Redirect the user to the authorization URL.
    header('Location: ' . $authorizationUrl);
    exit;
}

function getAccessToken(){
    try {    
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'                => Storage::getValue(Storage::$client_id_sesskey),    // The client ID assigned to you by the provider
            'clientSecret'            => Storage::getValue(Storage::$secret_key_sesskey),   // The client password assigned to you by the provider
            'redirectUri'             => Storage::getValue(Storage::$redirect_url_sesskey),
            'urlAuthorize'            => Storage::getValue(Storage::$authority_url_sesskey).Storage::getValue(Storage::$tenant_id_sesskey).'/oauth2/v2.0/authorize',
            'urlAccessToken'          => Storage::getValue(Storage::$authority_url_sesskey).Storage::getValue(Storage::$tenant_id_sesskey).'/oauth2/token',
            'urlResourceOwnerDetails' => Storage::getValue(Storage::$resource_url_sesskey),
            'scopes' => 'https://analysis.windows.net/powerbi/api/Workspace.ReadWrite.All https://analysis.windows.net/powerbi/api/Dataset.ReadWrite.All https://analysis.windows.net/powerbi/api/Report.ReadWrite.All',
            'scopeSeparator' => ' '
        ]);
        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', array('code' => $_GET['code']));
        
        if($accessToken->hasExpired()){
            echo "it has been expired";
            exit;
        }

        return $accessToken;

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        echo 'IdentityProviderException';
        // Failed to get the access token or user details.
        exit($e->getMessage());

    }
}


/** ===== START ===== */

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {

    // check if POST Data
    if(isset($_POST['authorize'])){ getAuthorizeCode(); }
    else{ displayForm(); } 
    
// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {
    // get access token
    $accessToken = getAccessToken();        

    $token = $accessToken->getToken();
 
    // creating PBI Client
    $client = new \Tngnt\PBI\Client($token);
    // existing workspace id "Testing777"
    // create new workspace

    # Create Workspace
    $workspace = $client->getGroup();
    $response = $workspace->createGroup('TW_'.uniqid());

    
    $body = $response->getBody();

    $array_body = json_decode($body);
    $workspace_id = $array_body->id;

    ### Create dataset
    $dataset = new \Tngnt\PBI\Model\Dataset('testing9938');


    # create Date_Info table
    $table = new \Tngnt\PBI\Model\Table('Date_Info');
    
    $table->addColumn(new \Tngnt\PBI\Model\Column('Business Date', \Tngnt\PBI\Model\Column::DATETIME));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Day of Week', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Day of Week Number', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Month', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Year', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Period', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Week In Period', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Week of Year', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Period Week', \Tngnt\PBI\Model\Column::STRING));

    
    $dataset->addTable($table);

    

    # create Daypart_Info table
    $table = new \Tngnt\PBI\Model\Table('Daypart_Info');

    $table->addColumn(new \Tngnt\PBI\Model\Column('Hour of Day', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Day Part Name', \Tngnt\PBI\Model\Column::STRING));

    $dataset->addTable($table);

    # create Product_Info table

    $table = new \Tngnt\PBI\Model\Table('Product_Info');

    $table->addColumn(new \Tngnt\PBI\Model\Column('Product ID', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Product Name', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Major Category', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Sub Category', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Exclude Flag', \Tngnt\PBI\Model\Column::STRING));

    $dataset->addTable($table);
    

    # create Store_Info table
    $table = new \Tngnt\PBI\Model\Table('Store_Info');
    
    $table->addColumn(new \Tngnt\PBI\Model\Column('Store ID', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('State', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('District', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Address', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('City', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Zip', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Latitude', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Longitude', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Store Name', \Tngnt\PBI\Model\Column::STRING));

    $dataset->addTable($table);

    # create Transaction_Detail table
    $table = new \Tngnt\PBI\Model\Table('Transaction_Detail');

    
    $table->addColumn(new \Tngnt\PBI\Model\Column('Record Type', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Revenue Center', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Order Type', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Check Number', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Business Date', \Tngnt\PBI\Model\Column::DATETIME));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Transaction Time', \Tngnt\PBI\Model\Column::DATETIME));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Detail Type', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Price Level', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Product ID', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Void Flag', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Return Flag', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Quantity', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Sales', \Tngnt\PBI\Model\Column::STRING));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Employee ID', \Tngnt\PBI\Model\Column::INT64));
    $table->addColumn(new \Tngnt\PBI\Model\Column('Store ID', \Tngnt\PBI\Model\Column::STRING));

    $dataset->addTable($table);

 
    $response = $client->getDataset()->createDataset($dataset, $workspace_id);
        
    $body = $response->getBody();

    $array_body = json_decode($body);
    $dataset_id = $array_body->id;




    // import pbix file
    $import = new \Tngnt\PBI\API\Import($client);
    $response = $import->ImportFile(__DIR__ . '/datasource/cafe.pbix', 'cafe.pbix', $workspace_id);
    $body = $response->getBody();
    // echo '<br>Import ID</br>';
    // echo '<textarea style="width:600px;height:300px">'.$body.'</textarea>';
    $array_body = json_decode($body);
    $import_id = $array_body->id;
    sleep(5);
    // get Import 
    $response = $import->getImport($import_id);
    $body = $response->getBody();
    $array_body = json_decode($body);

    // echo '<br>Created Import Information</br>';
    // echo '<textarea style="width:600px;height:300px">'.$body.'</textarea>';
    
    if($array_body->importState == 'Publishing'){
        echo 'Publishing State';
        exit;
    }

    $old_dataset_id = $array_body->datasets[0]->id;
    $report_id = $array_body->reports[0]->id;

    // creating new dataset

    // existing dataset id "old_cafe"
    //$dataset_id = 'ad8130f1-ea96-4031-b9aa-e37b2e01a161';

    // rebind a imported report to "old_cafe" dataset
    $report = $client->getReport();

    $report->RebindReport($report_id, $dataset_id, $workspace_id);


    // delete old dataset
    $dataset = $client->getDataset();
    $dataset->deleteDataset($old_dataset_id, $workspace_id);

    // get reports informations

    $response = $report->getReports($workspace_id);
    $body = $response->getBody();
    echo '<br>Reports List</br>';
    echo '<textarea style="width:600px;height:300px">'.$body.'</textarea>';


    echo '<p style="color:green">Finished Successfully</p>';
}