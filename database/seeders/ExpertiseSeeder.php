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
            [
                'name' => 'Employment & Labour Law',
                'short_description' => 'Strategic advice on employment contracts, labor disputes, and workplace compliance.',
                'overview' => 'Our employment practice advises employers and employees on all aspects of employment law, including contracts, terminations, workplace policies, and labor disputes. We assist clients in navigating Zimbabwe\'s complex labor regulatory environment.',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'name' => 'Intellectual Property',
                'short_description' => 'Protection and enforcement of trademarks, patents, copyrights, and trade secrets.',
                'overview' => 'We provide comprehensive intellectual property services including trademark and patent registration, copyright protection, licensing agreements, and IP dispute resolution. Our team helps clients protect their valuable intellectual assets.',
                'is_featured' => true,
                'order' => 6,
            ],
            [
                'name' => 'Mining & Natural Resources',
                'short_description' => 'Specialized legal services for mining operations, permits, and regulatory compliance.',
                'overview' => 'Our mining practice provides legal advice on mining licenses, joint ventures, compliance with mining regulations, environmental law, and dispute resolution in the natural resources sector.',
                'is_featured' => false,
                'order' => 7,
            ],
            [
                'name' => 'Tax Law',
                'short_description' => 'Expert tax planning, compliance, and dispute resolution services.',
                'overview' => 'We advise clients on all aspects of taxation including corporate tax, VAT, customs duties, tax planning, and representing clients in tax disputes with revenue authorities.',
                'is_featured' => false,
                'order' => 8,
            ],
            [
                'name' => 'Competition & Antitrust',
                'short_description' => 'Guidance on competition law compliance and merger control.',
                'overview' => 'Our competition law practice assists clients with merger notifications, competition compliance, and defending against anti-competitive conduct allegations before regulatory authorities.',
                'is_featured' => false,
                'order' => 9,
            ],
            [
                'name' => 'Family Law',
                'short_description' => 'Compassionate legal support for divorce, custody, and family matters.',
                'overview' => 'We provide sensitive and professional legal services in family law matters including divorce, child custody, maintenance, matrimonial property disputes, and estate planning.',
                'is_featured' => false,
                'order' => 10,
            ],
            [
                'name' => 'Immigration Law',
                'short_description' => 'Comprehensive immigration and work permit services.',
                'overview' => 'Our immigration practice assists individuals and corporations with work permits, residence permits, visa applications, and immigration compliance for foreign nationals working in Zimbabwe.',
                'is_featured' => false,
                'order' => 11,
            ],
            [
                'name' => 'Cybersecurity & Data Protection',
                'short_description' => 'Legal advice on data privacy, cybersecurity compliance, and digital law.',
                'overview' => 'We advise clients on data protection compliance, cybersecurity regulations, privacy policies, and handling data breaches in accordance with local and international standards.',
                'is_featured' => true,
                'order' => 12,
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