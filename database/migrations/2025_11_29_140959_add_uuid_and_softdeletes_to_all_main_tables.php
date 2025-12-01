<?php

use App\Models\Article;
use App\Models\Award;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\EmployeeType;
use App\Models\Expertise;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HistoryTimeline;
use App\Models\Judgement;
use App\Models\OurPeople;
use App\Models\Statistic;
use App\Models\Tag;
use App\Models\User;
use App\Traits\MigrationHelpers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    use MigrationHelpers;

    protected $tables = [
        'articles' => Article::class,
        'awards' => Award::class,
        'blog_comments' => BlogComment::class,
        'blogs' => Blog::class,
        'categories' => Category::class,
        'contact_messages' => ContactMessage::class,
        'employee_types' => EmployeeType::class,
        'expertise' => Expertise::class,
        'faqs' => Faq::class,
        'gallery' => Gallery::class,
        'history_timelines' => HistoryTimeline::class,
        'judgements' => Judgement::class,
        'our_people' => OurPeople::class,
        'statistics' => Statistic::class,
        'tags' => Tag::class,
        'users' => User::class,
        
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $tableName => $modelClass) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            // Add UUID
            $this->safeAddUuid($tableName);
            
            // Generate UUIDs for existing records
            $this->generateUuidsForTable($tableName, $modelClass);
            
            // Make UUID unique
            // $this->makeUuidUnique($tableName);
            
            // Add soft deletes
            $this->safeAddSoftDeletes($tableName);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (array_keys($this->tables) as $tableName) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            $this->safeRemoveUuid($tableName);
            $this->safeRemoveSoftDeletes($tableName);
        }
    }
};
