<?php

namespace Tests\Feature;

use Tests\TestCase;

class SidebarCollapsibleTest extends TestCase
{
    public function test_admin_sidebar_component_includes_toggle_button(): void
    {
        $path = base_path('resources/views/components/admin/sidebar.blade.php');
        $contents = file_get_contents($path);

        $this->assertStringContainsString('sidebar-toggle', $contents);
        $this->assertStringContainsString('fa-angles-left', $contents);
    }
}
