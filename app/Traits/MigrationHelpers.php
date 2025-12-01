<?php

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait MigrationHelpers
{
    /**
     * Safely add UUID to a table
     */
    public function safeAddUuid(string $tableName, string $afterColumn = 'id')
    {
        if (!Schema::hasColumn($tableName, 'uuid')) {
            Schema::table($tableName, function (Blueprint $table) use ($afterColumn) {
                $table->uuid('uuid')->after($afterColumn);
            });
        }
    }

    /**
     * Safely add soft deletes to a table
     */
    public function safeAddSoftDeletes(string $tableName)
    {
        if (!Schema::hasColumn($tableName, 'deleted_at')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Make UUID column unique and required
     */
    public function makeUuidUnique(string $tableName)
    {
        if (Schema::hasColumn($tableName, 'uuid')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->uuid('uuid')->nullable(false)->unique()->change();
            });
        }
    }

    /**
     * Generate UUIDs for existing records
     */
    public function generateUuidsForTable(string $tableName, string $modelClass = null)
    {
        if ($modelClass && class_exists($modelClass)) {
            $modelClass::chunk(100, function ($records) {
                foreach ($records as $record) {
                    if (empty($record->uuid)) {
                        $record->update(['uuid' => Str::uuid()]);
                    }
                }
            });
        }
    }

    /**
     * Safely remove UUID
     */
    public function safeRemoveUuid(string $tableName)
    {
        if (Schema::hasColumn($tableName, 'uuid')) {
            Schema::table($tableName, function (Blueprint $table) {
                // $table->dropUnique(['uuid']);
                $table->dropColumn('uuid');
            });
        }
    }

    /**
     * Safely remove soft deletes
     */
    public function safeRemoveSoftDeletes(string $tableName)
    {
        if (Schema::hasColumn($tableName, 'deleted_at')) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
}