<?php

namespace App\Services;

use Illuminate\Support\Str;

class SeoAnalyzer
{
    protected $content;
    protected $title;
    protected $metaDescription;
    protected $focusKeyword;
    protected $slug;
    protected $hasFeaturedImage;
    
    public function __construct($title = '', $content = '', $metaDescription = '', $focusKeyword = '', $slug = '', $hasFeaturedImage = false)
    {
        $this->title = $title;
        $this->content = $content;
        $this->metaDescription = $metaDescription;
        $this->focusKeyword = strtolower($focusKeyword);
        $this->slug = $slug;
        $this->hasFeaturedImage = $hasFeaturedImage;
    }
    
    /**
     * Analyze SEO and return score with recommendations
     */
    public function analyze()
    {
        $checks = [
            'title_length' => $this->checkTitleLength(),
            'title_keyword' => $this->checkTitleKeyword(),
            'meta_description' => $this->checkMetaDescription(),
            'meta_keyword' => $this->checkMetaKeyword(),
            'content_length' => $this->checkContentLength(),
            'keyword_density' => $this->checkKeywordDensity(),
            'headings' => $this->checkHeadings(),
            'images_alt' => $this->checkImagesAlt(),
            'internal_links' => $this->checkInternalLinks(),
            'external_links' => $this->checkExternalLinks(),
            'slug_keyword' => $this->checkSlugKeyword(),
        ];
        
        $score = $this->calculateScore($checks);
        $status = $this->getStatus($score);
        
        return [
            'score' => $score,
            'status' => $status,
            'checks' => $checks,
            'summary' => $this->getSummary($checks),
        ];
    }
    
    /**
     * Check title length (50-60 chars is optimal)
     */
    protected function checkTitleLength()
    {
        $length = strlen($this->title);
        
        if ($length >= 50 && $length <= 60) {
            return [
                'status' => 'good',
                'message' => 'Title length is perfect (' . $length . ' characters)',
                'score' => 10
            ];
        } elseif ($length >= 40 && $length < 50) {
            return [
                'status' => 'ok',
                'message' => 'Title is a bit short (' . $length . ' characters). Aim for 50-60.',
                'score' => 7
            ];
        } elseif ($length > 60 && $length <= 70) {
            return [
                'status' => 'ok',
                'message' => 'Title is a bit long (' . $length . ' characters). Aim for 50-60.',
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'Title length is ' . ($length < 40 ? 'too short' : 'too long') . ' (' . $length . ' characters)',
                'score' => 3
            ];
        }
    }
    
    /**
     * Check if focus keyword is in title
     */
    protected function checkTitleKeyword()
    {
        if (empty($this->focusKeyword)) {
            return [
                'status' => 'neutral',
                'message' => 'No focus keyword set',
                'score' => 5
            ];
        }
        
        if (stripos($this->title, $this->focusKeyword) !== false) {
            return [
                'status' => 'good',
                'message' => 'Focus keyword appears in title',
                'score' => 10
            ];
        }
        
        return [
            'status' => 'bad',
            'message' => 'Focus keyword does not appear in title',
            'score' => 0
        ];
    }
    
    /**
     * Check meta description length (120-160 chars)
     */
    protected function checkMetaDescription()
    {
        $length = strlen($this->metaDescription);
        
        if (empty($this->metaDescription)) {
            return [
                'status' => 'bad',
                'message' => 'Meta description is missing',
                'score' => 0
            ];
        }
        
        if ($length >= 120 && $length <= 160) {
            return [
                'status' => 'good',
                'message' => 'Meta description length is perfect (' . $length . ' characters)',
                'score' => 10
            ];
        } elseif ($length >= 100 && $length < 120) {
            return [
                'status' => 'ok',
                'message' => 'Meta description is a bit short (' . $length . ' characters)',
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'Meta description length is ' . ($length < 100 ? 'too short' : 'too long') . ' (' . $length . ' characters)',
                'score' => 3
            ];
        }
    }
    
    /**
     * Check if focus keyword is in meta description
     */
    protected function checkMetaKeyword()
    {
        if (empty($this->focusKeyword)) {
            return [
                'status' => 'neutral',
                'message' => 'No focus keyword set',
                'score' => 5
            ];
        }
        
        if (stripos($this->metaDescription, $this->focusKeyword) !== false) {
            return [
                'status' => 'good',
                'message' => 'Focus keyword appears in meta description',
                'score' => 10
            ];
        }
        
        return [
            'status' => 'bad',
            'message' => 'Focus keyword does not appear in meta description',
            'score' => 0
        ];
    }
    
    /**
     * Check content length (at least 300 words)
     */
    protected function checkContentLength()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        
        if ($wordCount >= 1000) {
            return [
                'status' => 'good',
                'message' => 'Content is comprehensive (' . $wordCount . ' words)',
                'score' => 10
            ];
        } elseif ($wordCount >= 300) {
            return [
                'status' => 'ok',
                'message' => 'Content length is acceptable (' . $wordCount . ' words)',
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'Content is too short (' . $wordCount . ' words). Aim for at least 300 words.',
                'score' => 3
            ];
        }
    }
    
    /**
     * Check keyword density (0.5% - 2.5% is optimal)
     */
    protected function checkKeywordDensity()
    {
        if (empty($this->focusKeyword)) {
            return [
                'status' => 'neutral',
                'message' => 'No focus keyword set',
                'score' => 5
            ];
        }
        
        $content = strip_tags($this->content);
        $wordCount = str_word_count($content);
        $keywordCount = substr_count(strtolower($content), $this->focusKeyword);
        
        if ($wordCount == 0) {
            return [
                'status' => 'bad',
                'message' => 'No content to analyze',
                'score' => 0
            ];
        }
        
        $density = ($keywordCount / $wordCount) * 100;
        
        if ($density >= 0.5 && $density <= 2.5) {
            return [
                'status' => 'good',
                'message' => sprintf('Keyword density is optimal (%.2f%%)', $density),
                'score' => 10
            ];
        } elseif ($density > 0 && $density < 0.5) {
            return [
                'status' => 'ok',
                'message' => sprintf('Keyword appears infrequently (%.2f%%). Consider adding it more.', $density),
                'score' => 6
            ];
        } elseif ($density > 2.5 && $density <= 4) {
            return [
                'status' => 'ok',
                'message' => sprintf('Keyword density is high (%.2f%%). Consider reducing usage.', $density),
                'score' => 6
            ];
        } elseif ($density > 4) {
            return [
                'status' => 'bad',
                'message' => sprintf('Keyword is overused (%.2f%%). This may be seen as spam.', $density),
                'score' => 2
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'Focus keyword not found in content',
                'score' => 0
            ];
        }
    }
    
    /**
     * Check for proper heading structure
     */
    protected function checkHeadings()
    {
        preg_match_all('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/i', $this->content, $matches);
        $headingCount = count($matches[0]);
        
        if ($headingCount >= 3) {
            return [
                'status' => 'good',
                'message' => 'Content has good heading structure (' . $headingCount . ' headings)',
                'score' => 10
            ];
        } elseif ($headingCount >= 1) {
            return [
                'status' => 'ok',
                'message' => 'Content has some headings (' . $headingCount . '). Add more for better structure.',
                'score' => 6
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'No headings found. Add headings for better structure.',
                'score' => 0
            ];
        }
    }
    
    /**
     * Check if images have alt text
     */
    protected function checkImagesAlt()
    {
        // Check for featured image first
        if (!$this->hasFeaturedImage) {
            return [
                'status' => 'ok',
                'message' => 'No featured image uploaded. Images improve SEO and social sharing.',
                'score' => 6
            ];
        }

        // Check images in content
        preg_match_all('/<img[^>]+>/i', $this->content, $images);
        $imageCount = count($images[0]);
        
        if ($imageCount == 0) {
            return [
                'status' => 'good',
                'message' => 'Featured image is set',
                'score' => 10
            ];
        }
        
        $withAlt = 0;
        foreach ($images[0] as $img) {
            if (preg_match('/alt=["\'][^"\']*["\']/i', $img)) {
                $withAlt++;
            }
        }
        
        $percentage = ($withAlt / $imageCount) * 100;
        
        if ($percentage == 100) {
            return [
                'status' => 'good',
                'message' => 'Featured image set and all content images have alt text (' . $imageCount . ' images)',
                'score' => 10
            ];
        } elseif ($percentage >= 50) {
            return [
                'status' => 'ok',
                'message' => 'Featured image set but some content images missing alt text (' . $withAlt . '/' . $imageCount . ')',
                'score' => 6
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'Featured image set but most content images missing alt text (' . $withAlt . '/' . $imageCount . ')',
                'score' => 2
            ];
        }
    }
    
    /**
     * Check for internal links
     */
    protected function checkInternalLinks()
    {
        preg_match_all('/<a[^>]+href=["\']([^"\']+)["\']/i', $this->content, $links);
        $internalCount = 0;
        
        foreach ($links[1] as $link) {
            if (!preg_match('/^https?:\/\//i', $link) || strpos($link, request()->getHost()) !== false) {
                $internalCount++;
            }
        }
        
        if ($internalCount >= 2) {
            return [
                'status' => 'good',
                'message' => 'Content has internal links (' . $internalCount . ' links)',
                'score' => 10
            ];
        } elseif ($internalCount == 1) {
            return [
                'status' => 'ok',
                'message' => 'Content has 1 internal link. Add more for better SEO.',
                'score' => 6
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => 'No internal links found. Add links to related content.',
                'score' => 0
            ];
        }
    }
    
    /**
     * Check for external links
     */
    protected function checkExternalLinks()
    {
        preg_match_all('/<a[^>]+href=["\']https?:\/\/([^"\']+)["\']/i', $this->content, $links);
        $externalCount = 0;
        
        foreach ($links[1] as $link) {
            if (strpos($link, request()->getHost()) === false) {
                $externalCount++;
            }
        }
        
        if ($externalCount >= 1) {
            return [
                'status' => 'good',
                'message' => 'Content has external links (' . $externalCount . ' links)',
                'score' => 10
            ];
        } else {
            return [
                'status' => 'ok',
                'message' => 'No external links. Consider adding authoritative sources.',
                'score' => 7
            ];
        }
    }
    
    /**
     * Check if focus keyword is in URL slug
     */
    protected function checkSlugKeyword()
    {
        if (empty($this->focusKeyword)) {
            return [
                'status' => 'neutral',
                'message' => 'No focus keyword set',
                'score' => 5
            ];
        }
        
        if (stripos($this->slug, $this->focusKeyword) !== false) {
            return [
                'status' => 'good',
                'message' => 'Focus keyword appears in URL',
                'score' => 10
            ];
        }
        
        return [
            'status' => 'bad',
            'message' => 'Focus keyword does not appear in URL',
            'score' => 0
        ];
    }
    
    /**
     * Calculate overall score
     */
    protected function calculateScore($checks)
    {
        $totalScore = 0;
        $maxScore = 0;
        
        foreach ($checks as $check) {
            $totalScore += $check['score'];
            $maxScore += 10;
        }
        
        return $maxScore > 0 ? round(($totalScore / $maxScore) * 100) : 0;
    }
    
    /**
     * Get status based on score
     */
    protected function getStatus($score)
    {
        if ($score >= 80) {
            return 'good';
        } elseif ($score >= 50) {
            return 'ok';
        } else {
            return 'bad';
        }
    }
    
    /**
     * Get summary of issues
     */
    protected function getSummary($checks)
    {
        $good = 0;
        $ok = 0;
        $bad = 0;
        
        foreach ($checks as $check) {
            if ($check['status'] == 'good') $good++;
            elseif ($check['status'] == 'ok') $ok++;
            elseif ($check['status'] == 'bad') $bad++;
        }
        
        return [
            'good' => $good,
            'ok' => $ok,
            'bad' => $bad,
            'total' => count($checks),
        ];
    }
}