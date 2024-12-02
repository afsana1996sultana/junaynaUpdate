<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderProcess extends Command
{

    // Command signature
    protected $signature = 'process:slider-process';

    // Command description
    protected $description = 'Process and convert all Slider  to WebP format and resize them.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Remove execution time limit
        set_time_limit(0);

        // Fetch all Sliders that have a thumbnail
        $Sliders = Slider::select('id', 'slider_img')->get();

        // Path to the image directory
        $imageDirectory = public_path('upload/slider');
        $directoryImages = glob($imageDirectory . '/*');

        $imagesToProcess = [];

        // Identify images to process
        foreach ($Sliders as $Slider) {
            $storedImagePath = public_path($Slider->slider_img);
            if (in_array($storedImagePath, $directoryImages)) {
                $imagesToProcess[] = [
                    'Slider' => $Slider,
                    'old_image' => $storedImagePath
                ];
            }
        }

        // Process each image
        foreach ($imagesToProcess as $item) {
            $Slider = $item['Slider'];
            $oldImage = $item['old_image'];
            if (file_exists($oldImage)) {
                // Resize and convert image to WebP, delete old image, and update DB
                $this->processImage($Slider, $oldImage);
            }
        }

        // Display success message
        $this->info('All Slider thumbnails have been successfully processed.');
    }

    protected function processImage($Slider, $oldImage)
    {
        // Resize and convert the image to WebP
        $image = Image::make($oldImage);
        $targetSizeKB = 55;
        $quality = 100;
        $tempPath = tempnam(sys_get_temp_dir(), 'slider_img') . '.webp';

        do {
            $image->resize(2300,800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->encode('webp', $quality)->save($tempPath);

            $fileSizeKB = filesize($tempPath) / 1024;
            $quality -= 5;

        } while ($fileSizeKB > $targetSizeKB && $quality > 5);

        $newImagePath = pathinfo($oldImage, PATHINFO_DIRNAME) . '/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';
        rename($tempPath, $newImagePath);

        if (file_exists($oldImage) && $oldImage !== $newImagePath) {
            unlink($oldImage);
        }

        // Update the Slider thumbnail path in the database
        $Slider->slider_img = 'upload/slider/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';
        $Slider->save();
    }

}
