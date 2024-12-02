<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;
use Intervention\Image\Facades\Image;

class BlogProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:blog-process';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and convert all Blog  to WebP format and resize them.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Remove execution time limit
        set_time_limit(0);

        // Fetch all blogs that have a thumbnail
        $blogs = Blog::select('id', 'blog_img')->get();

        // Path to the image directory
        $imageDirectory = public_path('upload/blog');
        $directoryImages = glob($imageDirectory . '/*');

        $imagesToProcess = [];

        // Identify images to process
        foreach ($blogs as $blog) {
            $storedImagePath = public_path($blog->blog_img);
            if (in_array($storedImagePath, $directoryImages)) {
                $imagesToProcess[] = [
                    'blog' => $blog,
                    'old_image' => $storedImagePath
                ];
            }
        }

        // Process each image
        foreach ($imagesToProcess as $item) {
            $blog = $item['blog'];
            $oldImage = $item['old_image'];
            if (file_exists($oldImage)) {
                // Resize and convert image to WebP, delete old image, and update DB
                $this->processImage($blog, $oldImage);
            }
        }

        // Display success message
        $this->info('All blog thumbnails have been successfully processed.');
    }

    protected function processImage($blog, $oldImage)
    {
        // Resize and convert the image to WebP
        $image = Image::make($oldImage);
        $targetSizeKB = 55;
        $quality = 100;
        $tempPath = tempnam(sys_get_temp_dir(), 'blog_img') . '.webp';

        do {
            $image->resize(300,300, function ($constraint) {
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

        // Update the blog thumbnail path in the database
        $blog->blog_img = 'upload/blog/' . pathinfo($oldImage, PATHINFO_FILENAME) . '.webp';
        $blog->save();
    }
}
