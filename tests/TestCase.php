<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // The pre-built pages pull assets in via @vite. On a fresh clone without a
        // frontend build, stub the manifest so the whole suite still renders; when
        // public/build exists, keep the real tags so browser tests and their
        // screenshots load the compiled CSS/JS.
        if (! file_exists(public_path('build/manifest.json'))) {
            $this->withoutVite();
        }
    }
}
