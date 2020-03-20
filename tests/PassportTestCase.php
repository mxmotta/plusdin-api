<?php
 
namespace Tests;

use App\User;
use Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

 
class PassportTestCase extends TestCase
{
    use DatabaseTransactions;
    
    protected $headers = [];
    protected $user;
    
    public function setUp() : void
    {
        parent::setUp();
        
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', '/api/v1'
        );
        
        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        $this->user = User::where('name', 'Administrator')->first();
        $token = $this->user->createToken('TestToken')->accessToken;
        $this->headers['Content-Type'] = 'application/json';
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer '.$token;
    }
}