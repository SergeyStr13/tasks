<?php

namespace Tests\Feature;

use App\Http\Middleware\Authenticate;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    	Storage::fake('public');

		$file = UploadedFile::fake()->image('1.jpg', 10,10);
		$data = [
			'name' => 'hththt',
			'user_id' => 1,
			'image' => $file
		];
		$this->expectException(Authenticate::class);
		$this->actingAs($this->user)
			->postJson(route('task.store'), $data)
			->assertStatus(201);//->assertStatus(401);

		$task = Task::latest()->first();

		$imagePath = $file->hashName();
		$this->assertEquals($imagePath, $task->image);

		Storage::disk('public')->assertExists($imagePath);
    }
}
