<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadHelpersTest extends TestCase
{
    /**
     * @test
     */
    public function storeFileAndReturnItsPathFunctionWorksJustFine()
    {
        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $fullPath = storeFileAndReturnItsPath($avatar, "Avatar");

        // remove storage from the path as it is added to be stored in the DB
        $fullPath = str_replace('/storage/', '', $fullPath);

        Storage::disk('public')->assertExists($fullPath);

        Storage::disk('public')->delete($fullPath);
    }

    /**
     * @test
     */
    public function storeFilesAndReturnRequestDataFunctionWorksWithSingleInputFileUpload()
    {
        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $request = new Request();
        $request->merge([
            "name" => "username",
            "email" => "user@email.com",
        ]);
        $request->files->set('avatar', $avatar);

        $data = storeFilesAndReturnRequestData(['avatar'], $request, "Avatar");

        $this->assertEquals($data['name'], $request->name);
        $this->assertEquals($data['email'], $request->email);
        $this->assertIsString($data['avatar']);

        // remove storage from the path as it is added to be stored in the DB
        $fullPath = str_replace('/storage/', '', $data['avatar']);

        Storage::disk('public')->assertExists($fullPath);

        Storage::disk('public')->delete($fullPath);
    }

    /**
     * @test
     */
    public function storeFilesAndReturnRequestDataFunctionWorksWithMultipleInputFileUpload()
    {
        $avatar1 = UploadedFile::fake()->image('avatar1.jpg');
        $avatar2 = UploadedFile::fake()->image('avatar2.jpg');
        $avatar3 = UploadedFile::fake()->image('avatar3.jpg');

        $request = new Request();
        $request->merge([
            "name" => "username",
            "email" => "user@email.com",
        ]);
        $request->files->set('avatars', [$avatar1, $avatar2, $avatar3]);

        $data = storeFilesAndReturnRequestData(['avatars'], $request, "Avatar/multiple");

        $this->assertEquals($data['name'], $request->name);
        $this->assertEquals($data['email'], $request->email);
        $this->assertIsArray($data['avatars']);

        foreach ($data["avatars"] as $file) {
            // remove storage from the path as it is added to be stored in the DB
            $fullPath = str_replace('/storage/', '', $file);

            Storage::disk('public')->assertExists($fullPath);

            Storage::disk('public')->delete($fullPath);
        }
    }
}
