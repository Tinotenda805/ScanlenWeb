<?php

// Migration: create_our_people_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('our_people', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('designation'); // Partner, Senior Associate, Associate, etc.
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('overview'); // Brief bio/overview
            $table->json('expertise')->nullable(); // Array of expertise areas
            $table->json('education')->nullable(); // Array of educational background
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('our_people');
    }
};

// Migration: create_our_history_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('our_history', function (Blueprint $table) {
            $table->id();
            $table->string('century'); // e.g., "1900s", "Early 2000s", etc.
            $table->year('year')->nullable(); // Specific year if needed
            $table->string('title'); // Event title
            $table->text('description'); // What transpired
            $table->string('image')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('our_history');
    }
};

// Migration: create_expertise_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('expertise', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon_image')->nullable(); // Icon/small image
            $table->string('banner_image')->nullable(); // Main banner image
            $table->text('short_description'); // Brief overview
            $table->longText('full_description'); // Detailed "read more" content
            $table->json('key_services')->nullable(); // Array of key services offered
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expertise');
    }
};

// Migration: create_gallery_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('category')->nullable(); // e.g., "Events", "Office", "Team"
            $table->date('event_date')->nullable(); // If gallery item is from an event
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery');
    }
};

// Migration: create_articles_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('featured_image');
            $table->text('excerpt'); // Short preview
            $table->longText('content'); // Full article content
            $table->string('topic'); // Category/topic of the article
            $table->foreignId('author_id')->constrained('our_people')->onDelete('cascade');
            $table->integer('read_time')->nullable(); // Estimated read time in minutes
            $table->integer('views_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};

// Migration: create_article_tags_table.php (Many-to-Many relationship)
return new class extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->primary(['article_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('tags');
    }
};

// Migration: create_people_articles_table.php (For featured articles on person's profile)
return new class extends Migration
{
    public function up()
    {
        Schema::create('people_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('our_people')->onDelete('cascade');
            $table->string('title');
            $table->string('publication')->nullable(); // External publication name
            $table->string('url')->nullable();
            $table->date('published_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people_articles');
    }
};

// Model: OurPeople.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurPeople extends Model
{
    use SoftDeletes;

    protected $table = 'our_people';

    protected $fillable = [
        'full_name', 'designation', 'email', 'phone', 'profile_image',
        'overview', 'expertise', 'education', 'display_order', 'is_active'
    ];

    protected $casts = [
        'expertise' => 'array',
        'education' => 'array',
        'is_active' => 'boolean',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function featuredArticles()
    {
        return $this->hasMany(PeopleArticle::class, 'person_id');
    }
}

// Model: OurHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurHistory extends Model
{
    use SoftDeletes;

    protected $table = 'our_history';

    protected $fillable = [
        'century', 'year', 'title', 'description', 'image', 'display_order', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

// Model: Expertise.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expertise extends Model
{
    use SoftDeletes;

    protected $table = 'expertise';

    protected $fillable = [
        'title', 'slug', 'icon_image', 'banner_image', 'short_description',
        'full_description', 'key_services', 'display_order', 'is_active'
    ];

    protected $casts = [
        'key_services' => 'array',
        'is_active' => 'boolean',
    ];
}

// Model: Gallery.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $table = 'gallery';

    protected $fillable = [
        'title', 'image', 'description', 'category', 'event_date', 'display_order', 'is_active'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];
}

// Model: Article.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'featured_image', 'excerpt', 'content', 'topic',
        'author_id', 'read_time', 'views_count', 'is_featured', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(OurPeople::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

// Model: Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}

// Model: PeopleArticle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeopleArticle extends Model
{
    protected $fillable = [
        'person_id', 'title', 'publication', 'url', 'published_date'
    ];

    protected $casts = [
        'published_date' => 'date',
    ];

    public function person()
    {
        return $this->belongsTo(OurPeople::class, 'person_id');
    }
}