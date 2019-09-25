<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTaskTest extends TestCase
{

	/**
	 *
	 */
    public function testExample() {

    	Storage::fake('srt');
        $this->withoutExceptionHandling();
        /** @var Task $task */
        $task = factory(Task::class)->create();
        $taskNew = Task::latest()->first();
        //dump($task);
        $data = [
			'name' => 'hththt',
			'user_id' => 1,
			'image' => UploadedFile::fake()->image('image.jpg', 1, 1)
		];

        $this->actingAs($this->user)->postJson(route('task.update', $taskNew->id), $data);

        $dbTask = $task->refresh();

        $this->assertEquals($data['name'], $dbTask->name);

    }
}
