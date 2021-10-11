<?php

namespace App\Console\Commands;

use App\Repositories\AttributeValueRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UpdateVariantText extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'variant-text:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $productVariantRepository;
    protected $attrValueRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductVariantRepository $productVariantRepository, AttributeValueRepository $attrValueRepository)
    {
        parent::__construct();
        $this->productVariantRepository = $productVariantRepository;
        $this->attrValueRepository = $attrValueRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "RUNNING...\n";
        try {
            $variants = $this->productVariantRepository->getVariantsHasVariantTextIsNull();
            $variants->each(function ($variant) {
                $attributeValues = json_decode($variant->variant_value, true);
                $attrValues = $this->attrValueRepository->getAttributeValuesOfProduct($attributeValues);
                $attrValuesMap = $attrValues->sortBy('attribute_id')->pluck('name')->map(function ($value) {
                    return Str::ucfirst($value);
                })->all();
                tap($variant)->update([
                    'variant_text' => implode("-", $attrValuesMap)
                ]);
            });
            echo "FINISH!\n";
        } catch (\Exception $e) {
            echo "Has errors!\n";
            Log::error($e);
        }
    }
}
