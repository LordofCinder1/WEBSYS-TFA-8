<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AccountManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_manage_customers(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());

        $this->get('/customers')->assertOk();
        $this->get('/customers/create')->assertOk();

        $this->post('/customers', [
            'full_name' => 'Test Customer',
            'email' => 'test@example.com',
            'avatar' => UploadedFile::fake()->image('a.png', 600, 400),
        ])->assertSessionHasNoErrors()->assertRedirect('/customers');

        $customer = Customer::firstWhere('email', 'test@example.com');
        Storage::disk('public')->assertExists($customer->avatar);

        $this->get("/customers/{$customer->id}")->assertOk()->assertSee('Test Customer');
        $this->get("/customers/{$customer->id}/edit")->assertOk();

        $this->put("/customers/{$customer->id}", [
            'full_name' => 'Renamed Customer',
            'email' => 'test@example.com',
            'phone' => '555-0199',
        ])->assertSessionHasNoErrors();
        $this->assertSame('Renamed Customer', $customer->fresh()->full_name);

        $this->delete("/customers/{$customer->id}")->assertRedirect('/customers');
        $this->assertModelMissing($customer);
        Storage::disk('public')->assertMissing($customer->avatar);
    }

    public function test_logged_in_user_can_manage_users_and_passwords_are_hashed(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/users')->assertOk();
        $this->get('/users/create')->assertOk();

        $this->post('/users', [
            'username' => 'newuser',
            'full_name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'secret-pass-1',
            'password_confirmation' => 'secret-pass-1',
        ])->assertSessionHasNoErrors()->assertRedirect('/users');

        $user = User::firstWhere('username', 'newuser');
        $this->assertTrue(Hash::check('secret-pass-1', $user->password));

        $this->get("/users/{$user->id}")->assertOk()->assertSee('New User');
        $this->get("/users/{$user->id}/edit")->assertOk();

        // A blank password keeps the current one.
        $this->put("/users/{$user->id}", [
            'username' => 'newuser',
            'full_name' => 'Updated User',
            'email' => 'new@example.com',
            'password' => '',
        ])->assertSessionHasNoErrors();
        $this->assertTrue(Hash::check('secret-pass-1', $user->fresh()->password));

        $this->delete("/users/{$user->id}")->assertRedirect('/users');
        $this->assertModelMissing($user);
    }

    public function test_user_cannot_delete_their_own_account_from_the_list(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->delete("/users/{$user->id}")->assertSessionHas('error');
        $this->assertModelExists($user);
    }
}
