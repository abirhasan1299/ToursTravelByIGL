
<div id="forget-password-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">
                            <h4 class="mb-1 fw-bold text-uppercase">Forget Password</h4>
                            <p class="text-muted mb-4">Securely change your password with end-to-end encryption by providing your email</p>


                            <form action="{{route('auth.verify.email')}}" method="POST" autocomplete="off">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Account Email
                                    </label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                           placeholder="Enter your mail" >
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        Forget
                                    </button>
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
