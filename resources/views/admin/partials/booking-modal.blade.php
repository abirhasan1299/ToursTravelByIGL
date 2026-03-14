<div id="edit-booking-modal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-uppercase">
                    Update Booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">

                <form method="post" id="booking-form">
                    @csrf
                    @method('PUT')

                    <!-- User Information -->
                    <h6 class="text-muted mb-3">User Information</h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User Name</label>
                            <input type="text" id="name" class="form-control" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" id="email" class="form-control" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="number" id="phone" class="form-control" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Chosen Date</label>
                            <input type="text" id="date" class="form-control" disabled>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea rows="2" class="form-control" id="address" disabled></textarea>
                        </div>

                    </div>

                    <hr class="my-4">

                    <!-- Booking Details -->
                    <h6 class="text-muted mb-3">Booking Details</h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" id="quantity" class="form-control" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">IP Address</label>
                            <input type="text" id="ip" class="form-control" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" id="booking_status" class="form-select">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="contacted">Contacted</option>
                            </select>
                        </div>

                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Status
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
