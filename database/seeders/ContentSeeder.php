<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Blog;
use App\Models\Category;
use App\Models\OurPeople;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Technology', 'description' => 'Latest tech trends and innovations'],
            ['name' => 'Business', 'description' => 'Business insights and strategies'],
            ['name' => 'Lifestyle', 'description' => 'Living your best life'],
            ['name' => 'Health', 'description' => 'Health and wellness tips'],
            ['name' => 'Travel', 'description' => 'Travel guides and adventures'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Tags
        $tags = ['AI', 'Machine Learning', 'Web Development', 'Mobile', 'Cloud', 'Cybersecurity', 
                 'Startup', 'Leadership', 'Productivity', 'Marketing', 'Design', 'Innovation'];
        
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

        // Create Authors
        $authors = [
            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'bio' => 'Tech enthusiast and software developer with 10 years of experience.',
                'twitter' => 'https://twitter.com/johnsmith',
                'linkedin' => 'https://linkedin.com/in/johnsmith',
            ],
            
        ];

        foreach ($authors as $author) {
            OurPeople::create($author);
        }

        // Create Articles
        $articleData = [
            [
                'title' => 'The Future of Artificial Intelligence in 2025',
                'excerpt' => 'Exploring the latest developments in AI and their impact on various industries.',
                'content' => "Artificial Intelligence continues to revolutionize our world in unprecedented ways. From healthcare to finance, AI is transforming how we work and live.\n\nMachine learning algorithms are becoming more sophisticated, enabling computers to learn from data and make predictions with remarkable accuracy. Deep learning, a subset of machine learning, has enabled breakthrough applications in image recognition, natural language processing, and autonomous systems.\n\nAs we look to the future, AI promises to solve some of humanity's greatest challenges while raising important questions about ethics, privacy, and the nature of work itself.\n\nThe integration of AI into everyday applications is accelerating, making technology more intuitive and accessible to users worldwide.",
                'category_id' => 1,
                'reading_time' => 8,
                'is_featured' => true,
            ],
            [
                'title' => 'Building Scalable Web Applications with Modern Frameworks',
                'excerpt' => 'A comprehensive guide to choosing the right framework for your next project.',
                'content' => "Choosing the right framework is crucial for building scalable web applications. Modern frameworks like React, Vue, and Angular offer powerful tools for creating dynamic user interfaces.\n\nEach framework has its strengths. React's component-based architecture and vast ecosystem make it a popular choice. Vue's gentle learning curve and flexibility appeal to developers of all levels. Angular's comprehensive solution suits enterprise applications.\n\nScalability considerations go beyond framework choice. Architecture patterns, database optimization, and cloud infrastructure all play critical roles in building applications that can grow with your user base.\n\nPerformance optimization techniques such as code splitting, lazy loading, and efficient state management are essential for maintaining fast load times as your application scales.",
                'category_id' => 1,
                'reading_time' => 10,
                'is_featured' => true,
            ],
            [
                'title' => 'Effective Leadership Strategies for Modern Teams',
                'excerpt' => 'Learn how to lead and inspire teams in today\'s fast-paced business environment.',
                'content' => "Leadership in the modern workplace requires a different approach than traditional management styles. Today's leaders must be adaptable, empathetic, and tech-savvy.\n\nEffective communication is the foundation of great leadership. Leaders must be able to clearly articulate vision, provide constructive feedback, and actively listen to their team members.\n\nBuilding trust is essential. Transparent decision-making, consistency in actions, and genuine concern for team members' wellbeing create a culture of trust and psychological safety.\n\nEmpowering your team through delegation and autonomy not only develops their skills but also frees up your time for strategic thinking and innovation.",
                'category_id' => 2,
                'reading_time' => 7,
                'is_featured' => false,
            ],
            [
                'title' => 'Cybersecurity Best Practices for Small Businesses',
                'excerpt' => 'Protect your business from cyber threats with these essential security measures.',
                'content' => "Small businesses are increasingly targeted by cybercriminals, making cybersecurity a critical priority. Many small businesses believe they're too small to be targets, but this misconception can be costly.\n\nImplementing strong password policies is your first line of defense. Require complex passwords and enable multi-factor authentication across all business accounts.\n\nRegular software updates and patches are essential. Outdated software contains vulnerabilities that hackers exploit. Set up automatic updates wherever possible.\n\nEmployee training is crucial. Most breaches occur due to human error. Educate your team about phishing, social engineering, and safe browsing practices.\n\nRegular backups ensure business continuity. Implement a 3-2-1 backup strategy: three copies of data, on two different media types, with one copy stored offsite.",
                'category_id' => 1,
                'reading_time' => 6,
                'is_featured' => true,
            ],
        ];

        foreach ($articleData as $data) {
            $article = Article::create($data);
            
            // Attach random authors (1-2 authors per article)
            $authorIds = OurPeople::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $article->authors()->attach($authorIds);
            
            // Attach random tags (2-4 tags per article)
            $tagIds = Tag::inRandomOrder()->take(rand(2, 4))->pluck('id');
            $article->tags()->attach($tagIds);
        }

        // Create Blogs
        $blogData = [
            [
                'title' => '10 Productivity Hacks That Actually Work',
                'excerpt' => 'Boost your productivity with these proven techniques and strategies.',
                'content' => "We all want to be more productive, but finding strategies that actually work can be challenging. After years of experimentation, here are ten productivity hacks that have stood the test of time.\n\n1. The Pomodoro Technique: Work in focused 25-minute intervals followed by short breaks. This simple method helps maintain concentration and prevents burnout.\n\n2. Time Blocking: Schedule specific blocks of time for different tasks. This prevents context switching and helps you stay focused on one thing at a time.\n\n3. The Two-Minute Rule: If a task takes less than two minutes, do it immediately. This prevents small tasks from piling up and cluttering your to-do list.\n\n4. Batch Similar Tasks: Group similar activities together to minimize context switching and improve efficiency.\n\n5. Eliminate Distractions: Turn off notifications, use website blockers, and create a dedicated workspace free from interruptions.",
                'category_id' => 3,
                'author_name' => 'Emily Williams',
                'reading_time' => 5,
                'is_featured' => true,
            ],
            [
                'title' => 'The Ultimate Guide to Remote Work Success',
                'excerpt' => 'Master the art of working from home with these essential tips.',
                'content' => "Remote work has become the new normal for millions of professionals. While it offers flexibility and freedom, it also presents unique challenges.\n\nCreating a dedicated workspace is essential. Your brain needs to associate a specific area with work mode. Even if you don't have a separate room, designate a corner or desk as your official workspace.\n\nEstablish clear boundaries between work and personal life. Set specific work hours and stick to them. It's easy to overwork when your office is just steps away.\n\nCommunication becomes even more important in remote settings. Over-communicate with your team, use video calls for important discussions, and don't hesitate to ask questions.\n\nInvest in proper equipment. A good chair, reliable internet connection, and quality headphones make a significant difference in your comfort and productivity.",
                'category_id' => 2,
                'author_name' => 'David Martinez',
                'reading_time' => 7,
                'is_featured' => true,
            ],
            [
                'title' => 'Healthy Morning Routines to Start Your Day Right',
                'excerpt' => 'Transform your mornings with these simple yet effective habits.',
                'content' => "How you start your morning sets the tone for the entire day. A well-crafted morning routine can boost your energy, improve your mood, and increase productivity.\n\nWake up at the same time every day, even on weekends. Consistency helps regulate your body's internal clock and improves sleep quality.\n\nHydrate immediately after waking up. Your body is dehydrated after hours of sleep. Drink a glass of water to kickstart your metabolism.\n\nMove your body. Whether it's yoga, stretching, or a quick workout, morning movement energizes you and clears your mind.\n\nEat a nutritious breakfast. Fuel your body with protein, healthy fats, and complex carbohydrates to sustain energy throughout the morning.\n\nPractice mindfulness or meditation. Even five minutes of quiet reflection can reduce stress and improve focus.",
                'category_id' => 4,
                'author_name' => 'Lisa Anderson',
                'reading_time' => 4,
                'is_featured' => false,
            ],
            
        ];

        foreach ($blogData as $data) {
            $blog = Blog::create($data);
            
            // Attach random tags (2-5 tags per blog)
            $tagIds = Tag::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $authorIds = OurPeople::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $blog->tags()->attach($tagIds);
            $blog->authors()->attach($authorIds);
        }
    }
}