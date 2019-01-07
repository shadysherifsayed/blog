<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

// All Tests Work Perfectly
class HelperFunctionsTest extends TestCase
{
    
    /** @test */
    public function js_helper_function_test()
    {
        $appURL = config('app.url');

        $this->assertEquals(js('app'), "<script src={$appURL}/js/app.js></script>");
    }

    /** @test */
    public function css_helper_function_test()
    {
        $appURL = config('app.url');

        $this->assertEquals(css('app'), "<link rel='stylesheet' href={$appURL}/css/app.css>");
    }

    /** @test */
    public function img_helper_function_test()
    {
        $appURL = config('app.url');

        $this->assertEquals(img('logo'), asset('/images/logo.png'));
    }

}
