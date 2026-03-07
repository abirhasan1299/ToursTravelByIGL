
<div id="package-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">
                            <h4 class="mb-1 fw-bold text-uppercase">New Package</h4>
                            <p class="text-muted mb-4">Let’s get you new packages. For Company Buying or Subscription</p>


                            <form action="{{route('admin.package.store')}}" method="POST">
                                @csrf
                                <!-- Package Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Package Name
                                    </label>
                                    <input type="text" name="p_name" class="form-control form-control-lg"
                                           placeholder="Enter package name" value="{{old('p_name')}}">
                                    @error('p_name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <!-- Package Detail -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Package Details
                                    </label>
                                    <textarea name="p_detail" rows="3"
                                              class="form-control summernote"
                                              placeholder="Write package details">{{old('p_detail')}}</textarea>
                                    @error('p_detail')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <!-- Package Benefit -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Package Benefits
                                    </label>
                                    <textarea name="p_benefit" rows="3"
                                              class="form-control summernote"
                                              placeholder="Write package benefits">{{old('p_benefit')}}</textarea>
                                    @error('p_benefit')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="row">

                                    <!-- Price -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            Price
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">{{config('app.currency')}}</span>
                                            <input type="number" name="p_price"
                                                   class="form-control"
                                                   placeholder="500" value="{{old('p_price')}}">

                                        </div>
                                        @error('p_price')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <!-- Date Range -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            Date Range
                                        </label>
                                        <input type="date" name="p_date_range"
                                               class="form-control"
                                               data-provider="flatpickr" value="{{old('p_date_range')}}" data-range-date="true" >
                                        @error('p_date_range')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- Post Limit -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            Post Limit
                                        </label>
                                        <input type="number" name="p_post_limit"
                                               class="form-control"
                                               placeholder="10" value="{{old('p_post_limit')}}">
                                        @error('p_post_limit')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            Status
                                        </label>
                                        <select name="p_status" class="form-select">
                                            <option selected disabled>Select Status</option>
                                            <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
                                            <option value="pending" {{old('status')=='pending'?'selected':''}}>Pending</option>
                                        </select>

                                    </div>

                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="reset" class="btn btn-outline-secondary rounded-pill px-4">
                                        Reset
                                    </button>

                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        Save Package
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
