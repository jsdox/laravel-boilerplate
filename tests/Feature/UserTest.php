<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    private $api_path;
    private $user;
    protected $json_headers = ['Accept' => 'application/json'];
    
    public function setUp() :void
    {        
         parent::setUp();
         $this->api_path = config('constants.API_PATH');
        //  $this->user = factory(User::class)->create();
    }
    
    public function testCreate()
    {
        $email = $this->faker->email();
        $attributes = [
            'name' =>  $this->faker->name(),
            'email' => $email,
            'password' =>  $this->faker->password()
        ];
        $this->post($this->api_path. 'users', $attributes)
            ->assertStatus(200)
            ->assertSee('data')
            ->assertSee('Data saved sucessfully')
            ->assertSee('success')
            ->assertSee('true');
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function testCreateNullEmail()
    {
        $attributes = [
            'name' =>  $this->faker->name(),
            'email' => '',
            'password' =>  $this->faker->password()
        ];
        $this->post($this->api_path. 'users', $attributes)
            ->assertExactJson([
                "message" => "Validation error",
                "success"=> false,
                "status"=> 422,
                "data"=> [
                    "email" => [
                        "The email field is required."
                    ]
                ]
            ]);
    }
}