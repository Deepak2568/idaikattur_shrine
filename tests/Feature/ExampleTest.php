<?php

use App\Models\Setting;

test('the application returns a successful response', function () {
    Setting::create([
        'display_text' => 'Test Event',
        'event_date' => now()->addMonth()->toDateString(),
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
});
