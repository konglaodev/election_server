<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ApiAuthentication extends Controller
{
    public function login(){
$response = Http::asForm()->post('http://localhost:8001/oauth/token', [
    'grant_type' => 'password',
    'client_id' => '2',
    'client_secret' => 'QWupRDfKt2gG2Szpu7qzcOac3meRqTZlnQuoa62n',
    'phoneNumber' => '+8562011111111',
    'password' => 'test',
    'scope' => '',
]);
 
return $response->json();
    }
}
