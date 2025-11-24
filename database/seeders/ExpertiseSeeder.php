<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expertise;
use Illuminate\Support\Str;

class ExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expertiseData = [
            [
                'name' => 'Litigation & Dispute Resolution',
                'short_description' => 'Skilled representation in commercial litigation, arbitration, and alternative dispute resolution.',
                'overview' => 'Our litigation team represents clients in all forms of dispute resolution, including commercial litigation, arbitration, and mediation. We handle complex disputes across various sectors and have a proven track record of successful outcomes in both local and international forums.',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'Real Estate & Property Law',
                'short_description' => 'Comprehensive property legal services covering transactions, development, and leasing.',
                'overview' => 'We provide expert legal advice on all aspects of real estate transactions, property development, leasing, and property finance. Our team assists clients with due diligence, title transfers, and complex property structuring.',
                'is_featured' => false,
                'order' => 4,
            ],
        ];

        foreach ($expertiseData as $data) {
            Expertise::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'short_description' => $data['short_description'],
                'overview' => $data['overview'],
                'is_featured' => $data['is_featured'],
                'order' => $data['order'],
                'status' => 'active',
            ]);
        }

        // Create some related expertise relationships
        $this->createRelationships();
    }

    /**
     * Create relationships between related expertise
     */
    private function createRelationships(): void
    {
        $relationships = [
            'Corporate & Commercial Law' => ['Banking & Finance', 'Tax Law', 'Competition & Antitrust'],
            'Banking & Finance' => ['Corporate & Commercial Law', 'Tax Law'],
            'Litigation & Dispute Resolution' => ['Employment & Labour Law', 'Real Estate & Property Law'],
            'Real Estate & Property Law' => ['Corporate & Commercial Law', 'Litigation & Dispute Resolution'],
            'Employment & Labour Law' => ['Litigation & Dispute Resolution'],
            'Intellectual Property' => ['Competition & Antitrust', 'Cybersecurity & Data Protection'],
            'Mining & Natural Resources' => ['Corporate & Commercial Law', 'Real Estate & Property Law'],
            'Tax Law' => ['Corporate & Commercial Law', 'Banking & Finance'],
            'Competition & Antitrust' => ['Corporate & Commercial Law', 'Intellectual Property'],
            'Cybersecurity & Data Protection' => ['Intellectual Property', 'Corporate & Commercial Law'],
        ];

        foreach ($relationships as $expertiseName => $relatedNames) {
            $expertise = Expertise::where('name', $expertiseName)->first();
            if ($expertise) {
                $relatedIds = Expertise::whereIn('name', $relatedNames)->pluck('id')->toArray();
                $expertise->relatedExpertise()->sync($relatedIds);
            }
        }
    }
}