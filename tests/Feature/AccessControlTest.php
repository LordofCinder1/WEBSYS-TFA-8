<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login_from_every_protected_route(): void
    {
        $user = User::factory()->create();
        $customer = Customer::create(['full_name' => 'Guest Check', 'email' => 'guest@example.com']);

        foreach (['customers' => $customer->id, 'users' => $user->id] as $base => $id) {
            $this->get("/{$base}")->assertRedirect('/login');
            $this->get("/{$base}/create")->assertRedirect('/login');
            $this->post("/{$base}")->assertRedirect('/login');
            $this->get("/{$base}/{$id}")->assertRedirect('/login');
            $this->get("/{$base}/{$id}/edit")->assertRedirect('/login');
            $this->put("/{$base}/{$id}")->assertRedirect('/login');
            $this->delete("/{$base}/{$id}")->assertRedirect('/login');
        }

        $this->assertModelExists($user);
        $this->assertModelExists($customer);
    }
}
