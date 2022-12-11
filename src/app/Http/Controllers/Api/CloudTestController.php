<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Google\Cloud\Storage\StorageClient;

class CloudTestController extends Controller
{
    public function store(Request $request){
        $googleConfigFile = file_get_contents(env('GOOGLE_APPLICATION_CREDENTIALS'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        
        if($request->file('file')){
            $file = $request->file('file')->store('files', 'public');
        }

        $storageBucketName = config('googlecloud.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);
        $fileSource = $file;
        $googleCloudStoragePath = $file;
        /* Upload a file to the bucket.
        Using Predefined ACLs to manage object permissions, you may
        upload a file and give read access to anyone with the URL.*/
        $bucket->upload($fileSource, [
        // 'predefinedAcl' => 'publicRead',
            'name' => $googleCloudStoragePath
        ]);

        return response()->json([
            "status" => "success",
            "message" => "File saved successfully ",
            "data" => [
                "url" => url($googleCloudStoragePath),
                "google_storage_url" => 'https://storage.cloud.google.com/'.$storageBucketName.'/'.$googleCloudStoragePath
            ]
        ]);
    }

    public function destroy(Request $request){
        $googleConfigFile = file_get_contents(env('GOOGLE_APPLICATION_CREDENTIALS'));
        $storage = new StorageClient([
            'keyFile' => json_decode($googleConfigFile, true)
        ]);
        
        if($request->file('file')){
            $file = $request->file('file')->store('files', 'public');
        }

        $storageBucketName = config('googlecloud.storage_bucket');
        $bucket = $storage->bucket($storageBucketName);
        $fileSource = fopen('/Applications/MAMP/htdocs/app/bookstore-app/public/storage'.$file, 'r');
        $googleCloudStoragePath = $file;
        /* Upload a file to the bucket.
        Using Predefined ACLs to manage object permissions, you may
        upload a file and give read access to anyone with the URL.*/
        $fileSource = [];
        $bucket->delete($fileSource, [
        // 'predefinedAcl' => 'publicRead',
            'name' => $googleCloudStoragePath
        ]);

        return response()->json([
            "status" => "success",
            "message" => "File saved successfully ",
            "data" => [
                "url" => url($googleCloudStoragePath),
                "google_storage_url" => 'https://storage.cloud.google.com/'.$storageBucketName.'/'.$googleCloudStoragePath
            ]
        ]);
    }
}
