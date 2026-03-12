
<div id="faq-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">

                            <form action="{{route('admin.faqs.store')}}" method="POST">
                                @csrf
                                <!-- Package Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        FAQ Title
                                    </label>
                                    <input type="text" name="title" class="form-control form-control-lg"
                                           placeholder="Enter Title" value="{{old('title')}}">
                                    @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <!-- Package Detail -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        FAQ Detail
                                    </label>
                                    <textarea name="detail" rows="3"
                                              class="form-control summernote"
                                              placeholder="Write  details">{{old('detail')}}</textarea>
                                    @error('detail')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>



                                <div class="row">
                                    <!-- Status -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            Status
                                        </label>
                                        <select name="status" class="form-select">
                                            <option selected disabled>Select Status</option>
                                            <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
                                            <option value="pending" {{old('status')=='pending'?'selected':''}}>Pending</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                Save FAQ
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
