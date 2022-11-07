<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config['inventory'] = [
            'desktop' => [
                0 => ['label' => 'Billboard/Masthead', 'inventory' => 'Billboard/Masthead', 'slot_name' => 'Topframe', 'adunit_size' => 'Out-of-page', 'creative_size' => '980x200', 'template_id' => '11994407'],
                1 => ['label' => 'Leaderboard', 'inventory' => 'Leaderboard', 'slot_name' => 'Leaderboard', 'adunit_size' => '728x90, 970x90, 970x250', 'creative_size' => '728x90, 970x90, 970x250', 'template_id' => '11813703'],
                2 => ['label' => 'Skin Ads', 'inventory' => 'Skin Ads', 'slot_name' => 'Skin Ads left, right', 'adunit_size' => 'Out-of-page', 'creative_size' => '250x750', 'template_id' => '11768460'],
                3 => ['label' => 'Half Page', 'inventory' => 'Half Page', 'slot_name' => 'Halfpage', 'adunit_size' => '160x600, 300x250, 300x600', 'creative_size' => '160x600, 300x250, 300x600', 'template_id' => '11813703'],
                4 => ['label' => 'Showcase 1', 'inventory' => 'Showcase 1', 'slot_name' => 'Showcase', 'adunit_size' => '200x200, 250x250, 300x250', 'creative_size' => '200x200, 250x250, 300x250', 'template_id' => '11813703'],
                5 => ['label' => 'Showcase 2', 'inventory' => 'Showcase 2', 'slot_name' => 'Showcase', 'adunit_size' => '200x200, 250x250, 300x250', 'creative_size' => '200x200, 250x250, 300x250', 'template_id' => '11813703'],
                6 => ['label' => 'Bottom Frame', 'inventory' => 'Bottom Frame', 'slot_name' => 'Bottomframe', 'adunit_size' => '468x60', 'creative_size' => '468x60', 'template_id' => '11894274'],
                7 => ['label' => 'Widget', 'inventory' => 'Widget', 'slot_name' => 'widget'],
                8 => ['label' => 'Before Body', 'inventory' => 'GPT', 'slot_name' => 'gpt'],
                9 => ['label' => 'After Body', 'inventory' => 'After Body', 'slot_name' => 'after_body'],
            ],
            'mobile' => [
                0 => ['label' => 'Billboard/Masthead', 'inventory' => 'Billboard/Masthead', 'slot_name' => 'Topframe', 'adunit_size' => '1x1', 'creative_size' => '480x530', 'template_id' => '12053989'],
                1 => ['label' => 'Headline', 'inventory' => 'Headline', 'slot_name' => 'Headline', 'adunit_size' => '320x100, 320x50', 'creative_size' => '320x100, 320x50', 'template_id' => '11813703'],
                2 => ['label' => 'Exposer', 'inventory' => 'Exposer', 'slot_name' => 'Exposer', 'adunit_size' => '160x600, 250x250, 300x250, 300x600', 'creative_size' => '160x600, 250x250, 300x250, 300x600', 'template_id' => '11813703'],
                3 => ['label' => 'Showcase 1', 'inventory' => 'Showcase 1', 'slot_name' => 'Showcase', 'adunit_size' => '200x200, 250x250, 300x250', 'creative_size' => '200x200, 250x250, 300x250', 'template_id' => '11813703'],
                4 => ['label' => 'Showcase 2', 'inventory' => 'Showcase 2', 'slot_name' => 'Showcase', 'adunit_size' => '200x200, 250x250, 300x250', 'creative_size' => '200x200, 250x250, 300x250', 'template_id' => '11813703'],
                5 => ['label' => 'Bottom Frame', 'inventory' => 'Bottom Frame', 'slot_name' => 'Bottomframe', 'adunit_size' => '320x100, 320x50', 'creative_size' => '320x100, 320x50', 'template_id' => '11813703'],
                6 => ['label' => 'Widget', 'inventory' => 'Widget', 'slot_name' => 'widget'],
                7 => ['label' => 'Before Body', 'inventory' => 'GPT', 'slot_name' => 'gpt'],
                8 => ['label' => 'After Body', 'inventory' => 'After Body', 'slot_name' => 'after_body'],
            ],
            'amp' => [
                0 => ['label' => 'Bottom Frame', 'inventory' => 'Bottom Frame', 'slot_name' => 'Bottomframe', 'adunit_size' => '320x50', 'creative_size' => '320x50', 'template_id' => '11813703'],
                1 => ['label' => 'Headline 1', 'inventory' => 'Headline 1', 'slot_name' => 'Headline', 'adunit_size' => '320x50, 320x100', 'creative_size' => '320x50, 320x100', 'template_id' => '11813703'],
                2 => ['label' => 'Headline 2', 'inventory' => 'Headline 2', 'slot_name' => 'Headline', 'adunit_size' => '320x50, 320x100', 'creative_size' => '320x50, 320x100', 'template_id' => '11813703'],
                3 => ['label' => 'Showcase 1', 'inventory' => 'Showcase 1', 'slot_name' => 'Showcase', 'adunit_size' => '200x200, 250x250, 300x250', 'creative_size' => '200x200, 250x250, 300x250', 'template_id' => '11813703'],
                4 => ['label' => 'Showcase 2', 'inventory' => 'Showcase 2', 'slot_name' => 'Showcase', 'adunit_size' => '200x200, 250x250, 300x250', 'creative_size' => '200x200, 250x250, 300x250', 'template_id' => '11813703'],
                5 => ['label' => 'Exposer 1', 'inventory' => 'Exposer 1', 'slot_name' => 'Exposer', 'adunit_size' => '300x600, 160x600', 'creative_size' => '300x600, 160x600', 'template_id' => '11813703'],
                6 => ['label' => 'Exposer 2', 'inventory' => 'Exposer 2', 'slot_name' => 'Exposer', 'adunit_size' => '300x600, 160x600', 'creative_size' => '300x600, 160x600', 'template_id' => '11813703'],
                7 => ['label' => 'Widget', 'inventory' => 'Widget', 'slot_name' => 'widget'],
                8 => ['label' => 'Before Body', 'inventory' => 'GPT', 'slot_name' => 'gpt'],
                9 => ['label' => 'After Body', 'inventory' => 'After Body', 'slot_name' => 'after_body'],
            ],
        ];
        // $inventory_config = config('inventory');
        // return view('tools.inventory.editable', compact('inventory_config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
