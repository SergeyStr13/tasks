<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample() {
        $response = $this->get('/');

        $response->assertStatus(200);
		//$this->seeInDatabase('users', ['email' => 'sally@example.com']);
		//$this->assertEquals(2, User::count());
		$data = [
			'name' => 'hththt',
			'user_id' => 1
		];
		//$this->expectException(Authenticate::class);
		//dd($this->actingAs($this->user));
		$this->actingAs($this->user)->postJson(route('task.store'), $data)->assertStatus(201);//->assertStatus(401);


    }
}
