<?php

namespace App\Console\Commands;


use Carbon\Carbon;
use App\Models\Product;
use App\Models\Campaing;
use App\Models\CampaingProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class campaignCron extends Command
{

    protected $signature = 'campaign:cron';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // $now = Carbon::now();
        // $expiredCampaign = Campaing::latest()->first();
        // if($expiredCampaign){
        //     $flash_end = Carbon::parse($expiredCampaign->flash_end);
        //     if($flash_end->lt($now)){
        //         $campaignProducts = CampaingProduct::where('campaing_id', $expiredCampaign->id)->get();
        //         foreach ($campaignProducts as $campaignProduct){
        //             $root_product = Product::findOrFail($campaignProduct->product_id);
        //             $root_product->discount_price = $root_product->old_discount_price;
        //             $root_product->discount_type = $root_product->old_discount_type;
        //             $root_product->save();
        //         }
        //     }
        // }
        try{
            $now = Carbon::now();
            $expiredCampaign = Campaing::where('status', 1)->first();
            if($expiredCampaign){
                $flash_end = Carbon::parse($expiredCampaign->flash_end);
                if($flash_end->lt($now)){
                    $campaignProducts = CampaingProduct::where('campaing_id', $expiredCampaign->id)->get();
                    foreach ($campaignProducts as $campaignProduct){
                        $root_product = Product::findOrFail($campaignProduct->product_id);
                        $root_product->discount_price = $root_product->old_discount_price ?? 0.00;
                        $root_product->discount_type = $root_product->old_discount_type ?? 1;
                        $root_product->save();
                    }
                }
            }
        }
        catch (\Exception $e) {
            Log::error('Error in handle method: ' . $e->getMessage(), [
                'exception' => $e,
                'stack_trace' => $e->getTraceAsString()
            ]);
        }
        return 0;
    }

}
