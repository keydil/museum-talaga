<?php

namespace Tests\Feature;

use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StrukturOrgImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_structure_org_image_can_be_uploaded_without_description(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.strukturorg.update'), [
                'struktur_image' => UploadedFile::fake()->image('struktur.png', 600, 400),
            ]);

        $response->assertRedirect(route('admin.strukturorg.index'));

        $struktur = Position::where('title', 'Global')->first();

        $this->assertNotNull($struktur);
        $this->assertNotNull($struktur->image);
        Storage::disk('public')->assertExists($struktur->image);
    }
}
