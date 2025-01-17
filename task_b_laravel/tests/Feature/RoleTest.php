<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_assign_roles()
    {

        $adminRole = Role::factory()->create(['name' => 'Admin']);
        $managerRole = Role::factory()->create(['name' => 'Manager']);

        // Create an admin user and assign the Admin role
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        // Ensure the roles relationship is loaded (optional)
        $admin->load('roles'); 

        // Create another user 
        $user = User::factory()->create();

        // Make the API request as the admin to assign the Manager role
        $response = $this->actingAs($admin)->postJson("/api/roles/assign/{$user->id}", ['role' => $managerRole->name]);

        // Assert the response status
        $response->assertStatus(200);

        // Assert the role is assigned in the database
        $this->assertDatabaseHas('role_user', [
            'user_id' => $user->id,
            'role_id' => $managerRole->id,
        ]);
        }

    public function test_non_admin_cannot_assign_roles()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'Manager']);

        $response = $this->actingAs($user)->postJson("/api/roles/assign/{$user->id}", ['role' => $role->name]);

        $response->assertStatus(403);
    }
}
