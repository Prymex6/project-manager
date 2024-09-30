<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1)->create();
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(CheckListSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(DiscussionSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(MilestoneSeeder::class);
        $this->call(NoteSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(TimesheetSeeder::class);
        $this->call(AttachmentSeeder::class);
    }
}
