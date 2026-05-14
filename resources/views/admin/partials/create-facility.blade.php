
<div id="facility-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-12 border-end border-dashed">
                        <div class="p-4">

                            <form action="{{route('admin.facility.store')}}" method="POST">
                                @csrf
                                <!-- Package Name -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Facility Title
                                    </label>
                                    <input type="text" name="title" class="form-control form-control-lg"
                                           placeholder="Enter Title" value="{{old('title')}}">
                                    @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                Save
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
