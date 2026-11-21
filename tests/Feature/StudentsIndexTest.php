<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentsIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_students_index_renders_the_custom_ui(): void
    {
        $this->get(route('students.index'))
            ->assertOk()
            ->assertSee('Students | Training Institute')
            ->assertSee('Training Institute')
            ->assertSee('Create Student')
            ->assertSee('No students found.');
    }
}
