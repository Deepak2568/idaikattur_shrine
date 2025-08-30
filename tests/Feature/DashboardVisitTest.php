<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class DashboardVisitTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_visit_updates_once_per_day()
    {
        // Create a test customer
        $customer = Customer::factory()->create([
            'last_dashboard_visit' => null
        ]);

        // Login as the customer
        $this->actingAs($customer, 'customer');

        // First visit - should update last_dashboard_visit
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $customer->refresh();
        $this->assertNotNull($customer->last_dashboard_visit);

        $firstVisit = $customer->last_dashboard_visit;

        // Second visit on same day - should NOT update last_dashboard_visit
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $customer->refresh();
        $this->assertEquals($firstVisit, $customer->last_dashboard_visit);

        // Travel to next day
        $this->travel(1)->day();

        // Visit on next day - should update last_dashboard_visit
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $customer->refresh();
        $this->assertNotEquals($firstVisit, $customer->last_dashboard_visit);
    }

    public function test_should_update_dashboard_visit_method()
    {
        $customer = Customer::factory()->create([
            'last_dashboard_visit' => null
        ]);

        // Should update if last_dashboard_visit is null
        $this->assertTrue($customer->shouldUpdateDashboardVisit());

        // Set last_dashboard_visit to today
        $customer->update(['last_dashboard_visit' => now()]);
        $this->assertFalse($customer->shouldUpdateDashboardVisit());

        // Set last_dashboard_visit to yesterday
        $customer->update(['last_dashboard_visit' => now()->subDay()]);
        $this->assertTrue($customer->shouldUpdateDashboardVisit());
    }
}
