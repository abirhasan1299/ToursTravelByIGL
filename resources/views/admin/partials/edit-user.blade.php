
<div id="edit-user-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">

                            <form id="edit-user-form" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- User Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        User Name
                                    </label>
                                    <input type="text" id="name" class="form-control form-control-lg"
                                            readonly>

                                </div>

                                <!-- Email Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                       Email
                                    </label>
                                    <input type="text"  class="form-control form-control-lg" id="email"
                                           readonly>

                                </div>

                               <div class="row">

                                   <div class="col-md-6 mb-3">
                                       <label class="form-label fw-semibold">Status</label>
                                       <select name="status" id="edit_user_status" class="form-select">
                                           <option value="active">Active</option>
                                           <option value="pending">Pending</option>
                                           <option value="suspended">Suspended</option>
                                       </select>
                                       @error('status')
                                       <small class="text-danger">{{$message}}</small>
                                       @enderror
                                   </div>
                                   <div class="col-md-6 mb-3">
                                       <!-- Phone Name -->
                                       <div class="mb-3">
                                           <label class="form-label fw-semibold">
                                               Phone or Mobile
                                           </label>
                                           <input type="text"  class="form-control form-control-lg" id="phone"
                                                  readonly >
                                       </div>

                                   </div>
                               </div>

                                <div class="row">
                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                              Update Status
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
</div>
