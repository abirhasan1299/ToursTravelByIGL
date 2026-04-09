<!-- ===================== ENHANCED SEO MODAL ===================== -->
<div class="modal fade" id="seoModal" tabindex="-1" aria-labelledby="seoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow-xxl">

            <!-- 🔹 Header : Modern Gradient + Tabler Icons -->
            <div class="modal-header bg-light text-primary border-0 py-3 px-4">
                <h5 class="modal-title fw-bold" id="seoModalLabel">
                    <i class="ti ti-chart-pie-filled fs-3 text-primary"></i>
                    <span>SEO Management Suite</span>
                </h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body with form -->
            <div class="modal-body p-4 p-xl-5">
                <form action="{{ route('admin.seo.store') }}" method="POST" enctype="multipart/form-data" id="seoForm">
                    @csrf

                    <!-- ========== BASIC SEO SECTION ========== -->
                    <div class="mb-4">
                        <div class="form-section-title border-primary" style="border-left-color: #3b82f6 !important;">
                            <i class="ti ti-world-search text-primary"></i>
                            <span>Basic SEO Configuration</span>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-tags me-1"></i> Keywords (Select2)</label>
                                <select name="page_name" class="form-control name-select" data-toggle="select2">
                                    @foreach($url as $u)
                                        <option value="{{ $u['uri'] }}">{{ $u['uri']}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Unique identifier for the page</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-robot me-1"></i> Robots Meta</label>
                                <input type="text" name="robots" class="form-control" placeholder="index, follow, noarchive" value="index, follow">
                                <div class="form-text">Crawler directives</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label"><i class="ti ti-description me-1"></i> Meta Description</label>
                                <textarea name="description" class="form-control" rows="2" placeholder="Write a compelling description (150-160 chars optimal)"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label"><i class="ti ti-tags me-1"></i> Keywords (Select2)</label>
                                <select name="keywords[]" multiple class="form-control keyword-select" data-toggle="select2">
                                    <option value="seo">SEO</option>
                                    <option value="marketing">Digital Marketing</option>
                                    <option value="analytics">Analytics</option>
                                    <option value="performance">Performance</option>
                                    <option value="backlinks">Backlinks</option>
                                    <option value="optimization">Optimization</option>
                                    <option value="laravel">Laravel</option>
                                    <option value="bootstrap">Bootstrap</option>
                                </select>
                                <div class="form-text">Select relevant keywords for search engines</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-photo me-1"></i> Favicon (ICO/PNG)</label>
                                <input type="file" name="icon" class="form-control" accept="image/png,image/x-icon,image/jpeg">
                                <div class="form-text">Upload favicon (16x16 or 32x32 recommended)</div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- ========== OPEN GRAPH (SOCIAL) ========== -->
                    <div class="mb-4">
                        <div class="form-section-title border-success" style="border-left-color: #10b981 !important;">
                            <i class="ti ti-brand-facebook text-success"></i>
                            <span>Open Graph (Facebook, LinkedIn, etc)</span>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-type"></i> OG Type</label>
                                <input type="text" name="og_type" class="form-control" placeholder="website, article, product" value="website">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-heading"></i> OG Title</label>
                                <input type="text" name="og_title" class="form-control" placeholder="Social media title">
                            </div>
                            <div class="col-12">
                                <label class="form-label"><i class="ti ti-align-left"></i> OG Description</label>
                                <textarea name="og_description" class="form-control" rows="2" placeholder="Short description for social cards"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-image"></i> OG Image</label>
                                <input type="file" name="og_image" class="form-control" accept="image/*">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label"><i class="ti ti-ruler"></i> Image Width</label>
                                <input type="text" name="og_image_width" class="form-control" placeholder="1200">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label"><i class="ti ti-ruler-2"></i> Image Height</label>
                                <input type="text" name="og_image_height" class="form-control" placeholder="630">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- ========== TWITTER CARD SECTION ========== -->
                    <div class="mb-3">
                        <div class="form-section-title border-info" style="border-left-color: #0ea5e9 !important;">
                            <i class="ti ti-brand-twitter text-info"></i>
                            <span>Twitter Card Integration</span>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-card"></i> Twitter Card Type</label>
                                <input type="text" name="twitter_cart" class="form-control" placeholder="summary_large_image, summary" value="summary_large_image">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-typography"></i> Twitter Title</label>
                                <input type="text" name="twitter_title" class="form-control" placeholder="Title for Twitter">
                            </div>
                            <div class="col-12">
                                <label class="form-label"><i class="ti ti-message"></i> Twitter Description</label>
                                <textarea name="twitter_description" class="form-control" rows="2" placeholder="Concise tweet-sized description"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="ti ti-photo-up"></i> Twitter Image</label>
                                <input type="file" name="twitter_image" class="form-control" accept="image/*">
                                <div class="form-text">Recommended 800x418 pixels</div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional hidden tip: extra elegance -->
                    <div class="alert alert-primary bg-soft-primary border-0 rounded-3 mt-3 d-flex align-items-center gap-2" role="alert" style="background: #eef2ff;">
                        <i class="ti ti-info-circle fs-5"></i>
                        <div class="small">All fields are optional except Page Name. Save to apply advanced SEO settings across your site.</div>
                    </div>

                    <!-- Footer Buttons inside modal-body? Actually modal-footer is separate but we need to include inside form -->
                    <!-- Buttons will be placed in modal-footer but within the same form -->
                </form>
            </div>

            <!-- Modal Footer with action buttons -->
            <div class="modal-footer border-0 pt-0 pb-4 px-5 justify-content-between">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="ti ti-x"></i> Cancel
                </button>
                <button type="submit" form="seoForm" class="btn btn-dark px-5 shadow-sm">
                    <i class="ti ti-device-floppy"></i> Publish SEO
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function(){
            function initSelect2() {
                // Destroy existing instances first
                if ($('.name-select').hasClass('select2-hidden-accessible')) {
                    $('.name-select').select2('destroy');
                }
                if ($('.keyword-select').hasClass('select2-hidden-accessible')) {
                    $('.keyword-select').select2('destroy');
                }

                // Initialize with proper configuration
                $('.name-select').select2({
                    theme: 'default',
                    placeholder: 'Select or search page name',
                    allowClear: true,
                    tags: true,
                    tokenSeparators: [',', ' '],
                    dropdownParent: $('#seoModal'),
                    width: '100%'
                });

                $('.keyword-select').select2({
                    theme: 'default',
                    placeholder: 'Select or add keywords',
                    allowClear: true,
                    tags: true,
                    tokenSeparators: [',', ' '],
                    dropdownParent: $('#seoModal'),
                    width: '100%'
                });
            }

            // Initialize when modal opens
            $('#seoModal').on('shown.bs.modal', function() {
                initSelect2();
            });

            // If modal is already open, initialize immediately
            if ($('#seoModal').hasClass('show')) {
                initSelect2();
            }
        });
    </script>
@endpush
