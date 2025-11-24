<?php

namespace App\Services;

class ReadabilityAnalyzer
{
    protected $content;
    protected $rawContent; // Keep original HTML
    
    public function __construct($content = '')
    {
        $this->rawContent = $content; // Store original HTML
        $this->content = strip_tags($content); // Stripped version for text analysis
    }
    
    /**
     * Analyze readability and return score
     */
    public function analyze()
    {
        $checks = [
            'sentence_length' => $this->checkSentenceLength(),
            'paragraph_length' => $this->checkParagraphLength(),
            'transition_words' => $this->checkTransitionWords(),
            'passive_voice' => $this->checkPassiveVoice(),
            'flesch_reading_ease' => $this->calculateFleschScore(),
            'subheadings' => $this->checkSubheadings(),
        ];
        
        $score = $this->calculateScore($checks);
        $status = $this->getStatus($score);
        
        return [
            'score' => $score,
            'status' => $status,
            'checks' => $checks,
            'reading_level' => $this->getReadingLevel($score),
        ];
    }
    
    /**
     * Check average sentence length
     */
    protected function checkSentenceLength()
    {
        $sentences = preg_split('/[.!?]+/', $this->content, -1, PREG_SPLIT_NO_EMPTY);
        $sentenceCount = count($sentences);
        
        if ($sentenceCount == 0) {
            return [
                'status' => 'neutral',
                'message' => 'No content to analyze',
                'score' => 5
            ];
        }
        
        $words = str_word_count($this->content);
        $avgLength = $words / $sentenceCount;
        
        if ($avgLength <= 20) {
            return [
                'status' => 'good',
                'message' => sprintf('Average sentence length is good (%.1f words)', $avgLength),
                'score' => 10
            ];
        } elseif ($avgLength <= 25) {
            return [
                'status' => 'ok',
                'message' => sprintf('Average sentence length is acceptable (%.1f words)', $avgLength),
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => sprintf('Sentences are too long (%.1f words average). Aim for 20 or less.', $avgLength),
                'score' => 3
            ];
        }
    }
    
    /**
     * Check paragraph length
     */
    protected function checkParagraphLength()
    {
        // USE RAW CONTENT (with HTML) for this check
        $htmlContent = $this->rawContent;
        
        // First, remove empty paragraphs (like <p><br></p> or <p></p>)
        $htmlContent = preg_replace('/<p>\s*<br\s*\/?>\s*<\/p>/i', '', $htmlContent);
        $htmlContent = preg_replace('/<p>\s*<\/p>/i', '', $htmlContent);
        
        // Now split by closing paragraph tags
        $paragraphs = preg_split('/<\/p>/i', $htmlContent, -1, PREG_SPLIT_NO_EMPTY);
        
        // Filter out empty paragraphs after splitting
        $paragraphs = array_filter($paragraphs, function($para) {
            $cleanPara = strip_tags($para);
            return trim($cleanPara) !== '';
        });
        
        $longParagraphs = 0;
        
        foreach ($paragraphs as $para) {
            // Strip HTML tags and count words
            $cleanText = strip_tags($para);
            $words = str_word_count($cleanText);
            
            if ($words > 150) {
                $longParagraphs++;
            }
        }
        
        $totalParas = count($paragraphs);
        $percentage = $totalParas > 0 ? ($longParagraphs / $totalParas) * 100 : 0;
        
        if ($totalParas == 0) {
            return [
                'status' => 'neutral',
                'message' => 'No paragraphs found',
                'score' => 5
            ];
        }
        
        if ($percentage == 0) {
            return [
                'status' => 'good',
                'message' => sprintf('All %d paragraphs are well-sized', $totalParas),
                'score' => 10
            ];
        } elseif ($percentage <= 25) {
            return [
                'status' => 'ok',
                'message' => sprintf('%d%% of paragraphs are too long (%d/%d)', round($percentage), $longParagraphs, $totalParas),
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => sprintf('%d%% of paragraphs are too long (%d/%d). Break them up.', round($percentage), $longParagraphs, $totalParas),
                'score' => 3
            ];
        }
    }

    
    /**
     * Check for transition words
     */
    protected function checkTransitionWords()
    {
        $transitionWords = [
            'however', 'therefore', 'furthermore', 'moreover', 'additionally',
            'consequently', 'nevertheless', 'meanwhile', 'similarly', 'likewise',
            'in addition', 'for example', 'for instance', 'as a result', 'in conclusion',
            'on the other hand', 'in contrast', 'specifically', 'especially', 'importantly'
        ];
        
        $sentences = preg_split('/[.!?]+/', $this->content, -1, PREG_SPLIT_NO_EMPTY);
        $withTransitions = 0;
        
        foreach ($sentences as $sentence) {
            foreach ($transitionWords as $word) {
                if (stripos($sentence, $word) !== false) {
                    $withTransitions++;
                    break;
                }
            }
        }
        
        $percentage = count($sentences) > 0 ? ($withTransitions / count($sentences)) * 100 : 0;
        
        if ($percentage >= 30) {
            return [
                'status' => 'good',
                'message' => sprintf('%.1f%% of sentences contain transition words', $percentage),
                'score' => 10
            ];
        } elseif ($percentage >= 20) {
            return [
                'status' => 'ok',
                'message' => sprintf('%.1f%% of sentences contain transition words. Aim for 30%%.', $percentage),
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => sprintf('Only %.1f%% of sentences contain transition words. Add more.', $percentage),
                'score' => 3
            ];
        }
    }
    
    /**
     * Check for passive voice (simplified)
     */
    protected function checkPassiveVoice()
    {
        $passiveIndicators = ['is being', 'are being', 'was being', 'were being', 'has been', 'have been', 'had been', 'will be', 'will have been'];
        $count = 0;
        
        foreach ($passiveIndicators as $indicator) {
            $count += substr_count(strtolower($this->content), $indicator);
        }
        
        $sentences = preg_split('/[.!?]+/', $this->content, -1, PREG_SPLIT_NO_EMPTY);
        $percentage = count($sentences) > 0 ? ($count / count($sentences)) * 100 : 0;
        
        if ($percentage <= 10) {
            return [
                'status' => 'good',
                'message' => sprintf('%.1f%% passive voice usage (good)', $percentage),
                'score' => 10
            ];
        } elseif ($percentage <= 20) {
            return [
                'status' => 'ok',
                'message' => sprintf('%.1f%% passive voice usage. Try to reduce.', $percentage),
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => sprintf('%.1f%% passive voice usage. Use active voice more.', $percentage),
                'score' => 3
            ];
        }
    }
    
    /**
     * Calculate Flesch Reading Ease score
     */
    protected function calculateFleschScore()
    {
        $sentences = preg_split('/[.!?]+/', $this->content, -1, PREG_SPLIT_NO_EMPTY);
        $words = str_word_count($this->content);
        $syllables = $this->countSyllables($this->content);
        
        if (count($sentences) == 0 || $words == 0) {
            return [
                'status' => 'neutral',
                'message' => 'Not enough content to analyze',
                'score' => 5,
                'flesch_score' => 0
            ];
        }
        
        $fleschScore = 206.835 - 1.015 * ($words / count($sentences)) - 84.6 * ($syllables / $words);
        $fleschScore = round($fleschScore, 1);
        
        if ($fleschScore >= 60) {
            $status = 'good';
            $message = sprintf('Easy to read (Flesch score: %.1f)', $fleschScore);
        } elseif ($fleschScore >= 40) {
            $status = 'ok';
            $message = sprintf('Fairly easy to read (Flesch score: %.1f)', $fleschScore);
        } else {
            $status = 'bad';
            $message = sprintf('Difficult to read (Flesch score: %.1f). Simplify sentences.', $fleschScore);
        }
        
        return [
            'status' => $status,
            'message' => $message,
            'score' => $this->fleschToScore($fleschScore),
            'flesch_score' => $fleschScore
        ];
    }
    
    /**
     * Count syllables in text (simplified)
     */
    protected function countSyllables($text)
    {
        $words = str_word_count(strtolower($text), 1);
        $syllables = 0;
        
        foreach ($words as $word) {
            $syllables += $this->countWordSyllables($word);
        }
        
        return $syllables;
    }
    
    /**
     * Count syllables in a single word
     */
    protected function countWordSyllables($word)
    {
        $word = strtolower($word);
        $vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
        $syllableCount = 0;
        $previousWasVowel = false;
        
        for ($i = 0; $i < strlen($word); $i++) {
            $isVowel = in_array($word[$i], $vowels);
            if ($isVowel && !$previousWasVowel) {
                $syllableCount++;
            }
            $previousWasVowel = $isVowel;
        }
        
        // Adjust for silent e
        if (substr($word, -1) == 'e') {
            $syllableCount--;
        }
        
        return max(1, $syllableCount);
    }
    
    /**
     * Convert Flesch score to 0-10 scale
     */
    protected function fleschToScore($flesch)
    {
        if ($flesch >= 80) return 10;
        if ($flesch >= 60) return 8;
        if ($flesch >= 40) return 6;
        if ($flesch >= 20) return 4;
        return 2;
    }
    
    /**
     * Check for subheadings distribution
     */
    protected function checkSubheadings()
    {
        // USE RAW CONTENT for HTML tag detection
        preg_match_all('/<h[2-6][^>]*>/i', $this->rawContent, $headings);
        $headingCount = count($headings[0]);
        $words = str_word_count($this->content);
        
        if ($words < 300) {
            return [
                'status' => 'neutral',
                'message' => 'Content too short to require subheadings',
                'score' => 7
            ];
        }
        
        $wordsPerHeading = $headingCount > 0 ? $words / $headingCount : $words;
        
        if ($wordsPerHeading <= 300) {
            return [
                'status' => 'good',
                'message' => sprintf('Good subheading distribution (%d headings)', $headingCount),
                'score' => 10
            ];
        } elseif ($wordsPerHeading <= 500) {
            return [
                'status' => 'ok',
                'message' => sprintf('Add more subheadings (%d found)', $headingCount),
                'score' => 7
            ];
        } else {
            return [
                'status' => 'bad',
                'message' => sprintf('Not enough subheadings (%d found). Add more structure.', $headingCount),
                'score' => 3
            ];
        }
    }
    
    /**
     * Calculate overall readability score
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
        if ($score >= 70) {
            return 'good';
        } elseif ($score >= 50) {
            return 'ok';
        } else {
            return 'bad';
        }
    }
    
    /**
     * Get reading level from Flesch score
     */
    protected function getReadingLevel($fleschScore)
    {
        if ($fleschScore >= 90) {
            return 'Very Easy';
        } elseif ($fleschScore >= 80) {
            return 'Easy';
        } elseif ($fleschScore >= 70) {
            return 'Fairly Easy';
        } elseif($fleschScore >= 60) {
            return 'Standard';
        } elseif ($fleschScore >= 50) {
            return 'Fairly Difficult ';
        } elseif ($fleschScore >= 30) {
            return 'Difficult ';
        } else {
            return 'Very Difficult ';
        }
    }
}