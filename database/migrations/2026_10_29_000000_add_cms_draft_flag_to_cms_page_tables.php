<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The updated CMS package writes `cms_draft_flag` on every save, but only
     * adds the column when a CMS page definition is edited. Backfill it on
     * every existing CMS page table.
     */
    public function up(): void
    {
        foreach ($this->cmsTables() as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'cms_draft_flag')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->integer('cms_draft_flag')->default(0)->after('id');
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->cmsTables() as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'cms_draft_flag')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('cms_draft_flag');
                });
            }
        }
    }

    private function cmsTables(): array
    {
        if (!Schema::hasTable('cms_pages')) return [];

        return DB::table('cms_pages')
            ->whereNotNull('database_table')
            ->where('database_table', '!=', '')
            ->pluck('database_table')
            ->unique()
            ->all();
    }
};
