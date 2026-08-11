<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_user(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'username' => 'admin_test',
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.user.store'), [
            'name' => 'User Baru',
            'username' => 'user_baru',
            'email' => 'user@example.com',
            'role' => 'operator',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseHas('users', [
            'username' => 'user_baru',
            'role' => 'operator',
        ]);

        $user = User::where('username', 'user_baru')->firstOrFail();

        $updateResponse = $this->put(route('admin.user.update', $user), [
            'name' => 'User Diperbarui',
            'username' => 'user_baru_update',
            'email' => 'updated@example.com',
            'role' => 'operator',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $updateResponse->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'user_baru_update',
            'role' => 'operator',
        ]);

        $deleteResponse = $this->delete(route('admin.user.destroy', $user));

        $deleteResponse->assertRedirect(route('admin.user.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
