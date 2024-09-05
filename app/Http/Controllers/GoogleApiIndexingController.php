<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;

class GoogleApiIndexingController extends Controller
{
    public function create(){
        return view('backend_extra_path.pages.googleindexing.create');
    }
    
    public function store(Request $request){
        
        $this->validate($request,[
            'url' => ['required'] 
        ]);
        $client = new Google_Client();

        // service_account_file.json is the private key that you created for your service account.
        $client->setAuthConfig(resource_path('js/it-way-bd-afd872527761.json'));
        $client->addScope('https://www.googleapis.com/auth/indexing');
    
        // Get a Guzzle HTTP Client
        $httpClient = $client->authorize();
        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
    
        // Define contents here. The structure of the content is described in the next step.
        $content = '{"url": '.$request->url.',"type": "URL_UPDATED"}';
    
        $response = $httpClient->post($endpoint, ['body' => $content]);
        $status_code = $response->getStatusCode();
        
            // return view('backend_extra_path.pages.googleindexing.create');
    }
}
