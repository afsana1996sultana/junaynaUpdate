<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MultiImg;
use Intervention\Image\Facades\Image;

class ProcessProductMultiImage extends Command
{

    // Command signature
    protected $signature = 'process:product-multi_img';

    // Command description
    protected $description = 'Process and convert all product thumbnails to WebP format and resize them.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Remove execution time limit
        set_time_limit(0);

        // Fetch all products that have a thumbnail
        $products = MultiImg::select('id', 'photo_name')->get();

        // Path to the image directory
        $imageDirectory = public_path('upload/products/multi-image');
        $directoryImages = glob($imageDirectory . '/*');

        $imagesToProcess = [];

        // Identify images to process
        foreach ($products as $product) {
            $storedImagePath = public_path($product->photo_name);
            if (in_array($storedImagePath, $directoryImages)) {
                $imagesToProcess[] = [
                    'product' => $product,
                    'old_image' => $storedImagePath
                ];
            }
        }

        // Process each image
        foreach ($imagesToProcess as $item) {
            $product = $item['product'];
            $oldImage = $item['old_image'];
            if (file_exists($oldImage)) {
                // Resize and convert image to WebP, delete old image, and update DB
                $this->processImage($product, $oldImage);
            }
        }

        // Display success message
        $this->info('All product multi image have been successfully processed.');
    }

    // protected function processImage($product, $oldImage)
    // {
    //     // Load the image
    //     $image = Image::make($oldImage);

    //     // Resize the image to 438x438 while maintaining the aspect ratio
    //     $image->resize(917,1000, function ($constraint) {
    //         $constraint->aspectRatio();
    //         $constraint->upsize();  // Prevent upsizing
    //     });

    //     // Encode the image to WebP format with a fixed quality to aim for ~25KB
    //     // Usually a quality between 70-80 should result in a file close to 25KB depending on the image
    //     $quality = 70; // Set this to a fixed quality
    //     $tempPath = tempnam(sys_get_temp_dir(), 'photo_name') . '.webp';

    //     // Encode the image as WebP with the fixed quality
    //     $image->encode('webp', $quality)->save($tempPath);

    //     // Define the new WebP image path
    //     $newImagePath = pathinfo($oldImage, PATHINFO_DIRNAME) . '/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';

    //     // Move the temp file to the final WebP image path
    //     rename($tempPath, $newImagePath);

    //     // Delete the old image file (only if it's not the same as the new file)
    //     if (file_exists($oldImage) && $oldImage !== $newImagePath) {
    //         unlink($oldImage); // Delete the old image
    //     }

    //     // Update the database to point to the new .webp image path
    //     $product->photo_name = 'upload/products/multi-image/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';
    //     $product->save();
    // }

    protected function processImage($product, $oldImage)
    {
        // Resize and convert the image to WebP
        $image = Image::make($oldImage);
        $targetSizeKB = 25;
        $quality = 100;
        $tempPath = tempnam(sys_get_temp_dir(), 'photo_name') . '.webp';

        do {
            $image->resize(917,1000, function ($constraint) {
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

        // Update the product thumbnail path in the database
        $product->photo_name = 'upload/products/multi-image/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';
        $product->save();
    }


}
