<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\ProjectController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProjectAdminTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
    }

    public function test_admin_can_create_project_with_optional_gallery_images_and_website_link(): void
    {
        $controller = new ProjectController();

        $request = Request::create('/admin/projects', 'POST', [
            'title' => 'Studio Landing Page',
            'client_name' => 'Creative Studio',
            'category' => 'creative',
            'website_link' => 'https://example.com',
        ], [], [
            'image1' => UploadedFile::fake()->image('cover.jpg', 800, 600),
            'image2' => UploadedFile::fake()->image('screen-2.jpg', 800, 600),
            'image3' => UploadedFile::fake()->image('screen-3.jpg', 800, 600),
            'image4' => UploadedFile::fake()->image('screen-4.jpg', 800, 600),
            'image5' => UploadedFile::fake()->image('screen-5.jpg', 800, 600),
            'image6' => UploadedFile::fake()->image('screen-6.jpg', 800, 600),
        ]);

        $response = $controller->store($request);

        $this->assertTrue($response->isRedirect());
        $this->assertDatabaseHas('projects', [
            'title' => 'Studio Landing Page',
            'website_link' => 'https://example.com',
        ]);

        $project = Project::latest()->first();
        $this->assertNotNull($project);
        $this->assertNotNull($project->image4);
        $this->assertNotNull($project->image5);
        $this->assertNotNull($project->image6);
    }
}
