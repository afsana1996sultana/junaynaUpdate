<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProcessProductThumbnails extends Command
{

    // Command signature
    protected $signature = 'process:product-thumbnails';

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
        $products = Product::select('id', 'product_thumbnail')->get();

        // Path to the image directory
        $imageDirectory = public_path('upload/products/thumbnails');
        $directoryImages = glob($imageDirectory . '/*');

        $imagesToProcess = [];

        // Identify images to process
        foreach ($products as $product) {
            $storedImagePath = public_path($product->product_thumbnail);
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
        $this->info('All product thumbnails have been successfully processed.');
    }

    protected function processImage($product, $oldImage)
    {
        // Resize and convert the image to WebP
        $image = Image::make($oldImage);
        $targetSizeKB = 25;
        $quality = 100;
        $tempPath = tempnam(sys_get_temp_dir(), 'product_thumbnail') . '.webp';

        do {
            $image->resize(438, 438, function ($constraint) {
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
        $product->product_thumbnail = 'upload/products/thumbnails/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';
        $product->save();
    }

}
