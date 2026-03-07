<div id="edit-package-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">
                            <h4 class="mb-1 fw-bold text-uppercase">Update Package</h4>
                            <p class="text-muted mb-4">Edit the package details below</p>

                            <form method="post" id="package-form">
                                @csrf
                                <input type="hidden" name="package_id" id="modal_package_id">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Package Name</label>
                                    <input type="text" name="p_name" id="modal_p_name" class="form-control form-control-lg">
                                    <small class="text-danger" id="error_p_name"></small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Package Details</label>
                                    <textarea name="p_detail" id="modal_p_detail" rows="3" class="form-control summernote"></textarea>
                                    <small class="text-danger" id="error_p_detail"></small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Package Benefits</label>
                                    <textarea name="p_benefit" id="modal_p_benefit" rows="3" class="form-control summernote"></textarea>
                                    <small class="text-danger" id="error_p_benefit"></small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Price</label>
                                        <input type="number" name="p_price" id="modal_p_price" class="form-control">
                                        <small class="text-danger" id="error_p_price"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Date Range</label>
                                        <input type="date" name="p_date_range" id="modal_p_date_range" data-provider="flatpickr"  data-range-date="true" class="form-control">
                                        <small class="text-danger" id="error_p_date_range"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Post Limit</label>
                                        <input type="number" name="p_post_limit" id="modal_p_post_limit" class="form-control">
                                        <small class="text-danger" id="error_p_post_limit"></small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select name="p_status" id="modal_p_status" class="form-select">
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                        <small class="text-danger" id="error_p_status"></small>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">Reset</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">Update Package</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
