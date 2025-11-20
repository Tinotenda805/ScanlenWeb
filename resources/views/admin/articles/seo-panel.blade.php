<!-- SEO & Readability Analysis Panel for Articles -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-search me-2"></i>SEO & Readability</h5>
    </div>
    <div class="card-body">
        <!-- Focus Keyword -->
        <div class="mb-3">
            <label for="focus_keyword" class="form-label">Focus Keyword</label>
            <input type="text" 
                   class="form-control @error('focus_keyword') is-invalid @enderror" 
                   id="focus_keyword" 
                   name="focus_keyword" 
                   value="{{ old('focus_keyword', $article->focus_keyword ?? '') }}"
                   placeholder="e.g., corporate law">
            <small class="text-muted">Main keyword you want to rank for</small>
            @error('focus_keyword')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Meta Description -->
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                      id="meta_description" 
                      name="meta_description" 
                      rows="3" 
                      maxlength="160"
                      placeholder="Brief description for search engines (120-160 characters)">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
            <small class="text-muted">
                <span id="meta-char-count">0</span>/160 characters
            </small>
            @error('meta_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Current Scores Display (if editing) -->
        @if(isset($article) && $article->seo_score > 0)
        <div class="alert alert-info">
            <div class="row text-center">
                <div class="col-6">
                    <strong>SEO</strong>
                    <div class="mt-1">
                        <span class="badge bg-{{ $article->getSeoStatusColor() }} fs-6">
                            {{ $article->seo_score }}%
                        </span>
                    </div>
                </div>
                <div class="col-6">
                    <strong>Readability</strong>
                    <div class="mt-1">
                        <span class="badge bg-{{ $article->getReadabilityStatusColor() }} fs-6">
                            {{ $article->readability_score }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Analyze Button -->
        <div class="text-center">
            <button type="button" class="btn btn-primary w-100" id="analyze-btn" data-bs-toggle="modal" data-bs-target="#seoAnalysisModal">
                <i class="fas fa-bolt me-2"></i>Analyze SEO & Readability
            </button>
        </div>
    </div>
</div>

<!-- SEO Analysis Results Modal -->
<div class="modal fade" id="seoAnalysisModal" tabindex="-1" aria-labelledby="seoAnalysisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="seoAnalysisModalLabel">
                    <i class="fas fa-chart-line me-2"></i>SEO & Readability Analysis
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="seo-analysis-results">
                <!-- Initial State -->
                <div class="text-center py-5" id="analysis-initial">
                    <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Click the button below to analyze your content</p>
                    <button type="button" class="btn btn-primary" id="analyze-modal-btn">
                        <i class="fas fa-bolt me-2"></i>Start Analysis
                    </button>
                </div>

                <!-- Loading State -->
                <div class="text-center py-5 d-none" id="analysis-loading">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted">Analyzing your content...</p>
                </div>

                <!-- Results Container -->
                <div id="analysis-results-container" class="d-none">
                    <!-- Results will be inserted here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="reanalyze-btn" style="display:none;">
                    <i class="fas fa-redo me-2"></i>Re-analyze
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.score-indicator {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
    margin: 0 auto;
    border: 5px solid;
}

.score-good {
    background: #d1e7dd;
    color: #0f5132;
    border-color: #198754;
}

.score-ok {
    background: #fff3cd;
    color: #664d03;
    border-color: #ffc107;
}

.score-bad {
    background: #f8d7da;
    color: #842029;
    border-color: #dc3545;
}

.check-item {
    padding: 0.75rem;
    border-left: 4px solid;
    margin-bottom: 0.5rem;
    border-radius: 4px;
    font-size: 0.9rem;
}

.check-item.good {
    border-color: #198754;
    background: #d1e7dd;
}

.check-item.ok {
    border-color: #ffc107;
    background: #fff3cd;
}

.check-item.bad {
    border-color: #dc3545;
    background: #f8d7da;
}

.check-item.neutral {
    border-color: #6c757d;
    background: #e9ecef;
}

.check-item .icon {
    font-size: 1.2rem;
    margin-right: 0.5rem;
}

.check-item.good .icon { color: #198754; }
.check-item.ok .icon { color: #ffc107; }
.check-item.bad .icon { color: #dc3545; }
.check-item.neutral .icon { color: #6c757d; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const analyzeBtn = document.getElementById('analyze-btn');
    const analyzeModalBtn = document.getElementById('analyze-modal-btn');
    const reanalyzeBtn = document.getElementById('reanalyze-btn');
    const metaDescription = document.getElementById('meta_description');
    const metaCharCount = document.getElementById('meta-char-count');

    // Update character count for meta description
    if (metaDescription) {
        metaDescription.addEventListener('input', function() {
            metaCharCount.textContent = this.value.length;
            if (this.value.length > 160) {
                metaCharCount.classList.add('text-danger');
            } else if (this.value.length >= 120) {
                metaCharCount.classList.remove('text-danger');
                metaCharCount.classList.add('text-success');
            } else {
                metaCharCount.classList.remove('text-danger', 'text-success');
            }
        });
        // Initialize count
        metaCharCount.textContent = metaDescription.value.length;
    }

    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    if (titleInput) {
        titleInput.addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            // Note: Articles don't have slug input field, but slug is auto-generated on backend
        });
    }

    // Analyze button clicks
    if (analyzeModalBtn) {
        analyzeModalBtn.addEventListener('click', function() {
            analyzeContent();
        });
    }

    if (reanalyzeBtn) {
        reanalyzeBtn.addEventListener('click', function() {
            analyzeContent();
        });
    }

    function getQuillContent() {
        // Get content from Quill editor
        if (typeof quill !== 'undefined') {
            return quill.root.innerHTML;
        }
        // Fallback to textarea if Quill not available
        return document.querySelector('#content')?.value || '';
    }

    function analyzeContent() {
        // Show loading state
        document.getElementById('analysis-initial').classList.add('d-none');
        document.getElementById('analysis-loading').classList.remove('d-none');
        document.getElementById('analysis-results-container').classList.add('d-none');
        reanalyzeBtn.style.display = 'none';

        const titleValue = document.getElementById('title')?.value || '';
        const slugValue = titleValue.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');

        const data = {
            title: titleValue,
            slug: slugValue,
            content: getQuillContent(), // Get content from Quill editor
            focus_keyword: document.getElementById('focus_keyword')?.value || '',
            meta_description: document.getElementById('meta_description')?.value || '',
            has_featured_image: document.querySelector('input[name="featured_image"]')?.files.length > 0 || {{ isset($article) && $article->featured_image ? 'true' : 'false' }},
            _token: document.querySelector('meta[name="csrf-token"]')?.content
        };

        fetch('{{ route("admin.articles.analyze") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': data._token,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            displayResults(result);
            document.getElementById('analysis-loading').classList.add('d-none');
            document.getElementById('analysis-results-container').classList.remove('d-none');
            reanalyzeBtn.style.display = 'inline-block';
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('analysis-loading').classList.add('d-none');
            document.getElementById('analysis-initial').classList.remove('d-none');
            alert('Analysis failed. Please try again.');
        });
    }

    function displayResults(result) {
        const container = document.getElementById('analysis-results-container');
        
        const html = `
            <!-- Score Overview -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="text-center p-3 border rounded">
                        <h6 class="mb-3">SEO Score</h6>
                        <div class="score-indicator score-${result.seo.status}">
                            ${result.seo.score}%
                        </div>
                        <p class="mt-3 mb-0">
                            <strong>${getStatusLabel(result.seo.status)}</strong>
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-check-circle text-success"></i> ${result.seo.summary.good} good &nbsp;
                            <i class="fas fa-exclamation-circle text-warning"></i> ${result.seo.summary.ok} ok &nbsp;
                            <i class="fas fa-times-circle text-danger"></i> ${result.seo.summary.bad} issues
                        </small>
                    </div>

                    <hr>
                    
                    <!-- SEO Checks -->
                    <div class="mb-2 ">
                        <h5 class="mb-3">
                            <i class="fas fa-search me-2"></i>SEO Analysis
                        </h5>
                        ${generateCheckList(result.seo.checks)}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center p-3 border rounded">
                        <h6 class="mb-3">Readability</h6>
                        <div class="score-indicator score-${result.readability.status}">
                            ${result.readability.score}%
                        </div>
                        <p class="mt-3 mb-0">
                            <strong>${getStatusLabel(result.readability.status)}</strong>
                        </p>
                        <small class="text-muted">${result.readability.reading_level}</small>
                    </div>

                    <hr>
                    <!-- Readability Checks -->
                    <div class="mb-2">
                        <h5 class="mb-3">
                            <i class="fas fa-book-open me-2"></i>Readability Analysis
                        </h5>
                        ${generateCheckList(result.readability.checks)}
                    </div>
                </div>
            </div>

        `;

        container.innerHTML = html;
    }

    function generateCheckList(checks) {
        let html = '';
        for (const [key, check] of Object.entries(checks)) {
            const icon = check.status === 'good' ? '✓' : 
                        check.status === 'ok' ? '⚠' : 
                        check.status === 'neutral' ? 'ℹ' : '✗';
            html += `
                <div class="check-item ${check.status}">
                    <span class="icon">${icon}</span>
                    <span>${check.message}</span>
                </div>
            `;
        }
        return html;
    }

    function getStatusLabel(status) {
        switch(status) {
            case 'good': return 'Excellent';
            case 'ok': return 'Needs Improvement';
            case 'bad': return 'Poor';
            default: return 'Unknown';
        }
    }
});
</script>